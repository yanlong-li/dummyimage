<?php
/**
 * 参数说明：
 *  text     文本内容（支持多行，以换行符分隔）
 *  font     字体文件路径（TTF格式）
 *  fontsize 起始字号（脚本会自动增大字号直至文字恰好适应图片）
 *  size     图片尺寸，格式如 300*300 （宽*高）
 *  type     图片类型：jpg/png/svg/avif/webp
 *  fc       文字颜色（16进制颜色，如 FF0000）
 *  bc       背景颜色（16进制颜色，不传表示透明背景）
 */


header('Cache-Control: public, max-age=86400, must-revalidate');
// 设置资源的过期时间
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

// 获取传参（可以通过 URL 传入，如 ?text=Hello&font=/path/to/font.ttf&fontsize=10&size=300*300&type=png&fc=000000&bc=FFFFFF）
$text = $_GET['text'] ?? 'Hello, World!';

$font = $_GET['font'] ?? 'HYDiShengYingXiongTiW.ttf';

$fonts = array_map('basename', glob(__DIR__ . '/fonts/*.ttf'));
if (!in_array($font, $fonts)) {
    $font = 'HYDiShengYingXiongTiW.ttf';
}
$font = __DIR__ . '/fonts/' . $font;


// 参数获取
$fontsize_param = isset($_GET['fontsize']) ? intval($_GET['fontsize']) : 10;
$size_str       = $_GET['size'] ?? '300*300';


if (strpos($size_str, '*')) {
    list($width, $height) = explode('*', $size_str);
    $width  = max(1, intval($width));
    $height = max(1, intval($height));
} elseif (ctype_digit($size_str)) {
    $width = $height = $size_str;
}

$type = isset($_GET['type']) ? strtolower($_GET['type']) : 'png';
$fc   = $_GET['fc'] ?? '000000';
$bc   = $_GET['bc'] ?? null;
// 新增 padding 参数，支持传入 "10" 或 "10px"
$padding = $_GET['padding'] ?? min($width, $height) * 0.1;
$padding = intval(preg_replace('/\D/', '', $padding)); // 去除非数字字符


// 计算可用区域尺寸（排除边距）
$availWidth  = $width - 2 * $padding;
$availHeight = $height - 2 * $padding;

// 辅助函数：16进制颜色转RGB
function hex2rgb($hex)
{
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
        $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
        $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return array($r, $g, $b);
}

// 如果类型为 SVG，则采用 SVG 方式生成
if ($type == 'svg') {
    header("Content-Type: image/svg+xml");
    $lines = explode("\n", $text);
    // 这里直接使用传入的 fontsize 参数作为初始文字大小
    $maxFontSize = $fontsize_param;
    $lineHeight  = $maxFontSize;
    // 总文字块高度
    $totalHeight = count($lines) * $lineHeight;
    // 起始 y 坐标在可用区域内垂直居中
    $startY = $padding + ($availHeight - $totalHeight) / 2 + $maxFontSize;
    $bgFill = $bc ? '#' . $bc : 'none';
    $svg    = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg width="{$width}" height="{$height}" xmlns="http://www.w3.org/2000/svg">
  <rect width="100%" height="100%" fill="{$bgFill}" />
  <text x="50%" y="{$startY}" fill="#{$fc}" font-family="{$font}" font-size="{$maxFontSize}" text-anchor="middle">
SVG;
    foreach ($lines as $i => $line) {
        if ($i == 0) {
            $svg .= htmlspecialchars($line);
        } else {
            $dy  = $maxFontSize;
            $svg .= "<tspan x=\"50%\" dy=\"{$dy}\">" . htmlspecialchars($line) . "</tspan>";
        }
    }
    $svg .= "</text></svg>";
    echo $svg;
    ob_end_flush();
    exit;
}

// 基于 GD 库生成位图
$image = imagecreatetruecolor($width, $height);

// 判断当前图片格式是否支持透明（png、webp、avif 支持）
$supports_transparency = in_array($type, array('png', 'webp', 'avif'));
if (!$bc && $supports_transparency) {
    imagesavealpha($image, true);
    $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagefill($image, 0, 0, $transparent);
} else {
    if ($bc) {
        list($br, $bg, $bb) = hex2rgb($bc);
    } else {
        $br = $bg = $bb = 255; // 默认白色背景
    }
    $bgColor = imagecolorallocate($image, $br, $bg, $bb);
    imagefill($image, 0, 0, $bgColor);
}

list($tr, $tg, $tb) = hex2rgb($fc);
$textColor = imagecolorallocate($image, $tr, $tg, $tb);
$lines     = explode("\n", $text);

/**
 * 检查在给定字号下，多行文字是否适合可用区域
 * 要求：每行宽度不超过可用宽度，总高度不超过可用高度
 */
function textFits($fontsize, $lines, $font, $availWidth, $availHeight)
{
    $totalHeight = 0;
    foreach ($lines as $line) {
        $bbox       = imagettfbbox($fontsize, 0, $font, $line);
        $lineWidth  = abs($bbox[2] - $bbox[0]);
        $lineHeight = abs($bbox[7] - $bbox[1]);
        if ($lineWidth > $availWidth) {
            return false;
        }
        $totalHeight += $lineHeight;
    }
    // 这里使用 (int) 转换，避免四舍五入带来的过大值
    $lineSpacing = (int)($fontsize * 0.2);
    $totalHeight += $lineSpacing * (count($lines) - 1);
    return $totalHeight <= $availHeight;
}

// 从提供的起始字号开始，逐步增大字号，直至超出可用区域尺寸
$fontsize = $fontsize_param > 0 ? $fontsize_param : 10;
while (textFits($fontsize + 1, $lines, $font, $availWidth, $availHeight)) {
    $fontsize++;
}

// 计算每行文字高度及总高度（包括行间距）
$lineHeights     = [];
$totalTextHeight = 0;
foreach ($lines as $line) {
    $bbox            = imagettfbbox($fontsize, 0, $font, $line);
    $lineHeight      = abs($bbox[7] - $bbox[1]);
    $lineHeights[]   = $lineHeight;
    $totalTextHeight += $lineHeight;
}
$lineSpacing     = (int)($fontsize * 0.2);
$totalTextHeight += $lineSpacing * (count($lines) - 1);

// 计算整体文字块在可用区域内垂直居中的起始 y 坐标
$startY = (int)($padding + ($availHeight - $totalTextHeight) / 2);

// 分行绘制文字，每行水平居中
foreach ($lines as $index => $line) {
    $bbox      = imagettfbbox($fontsize, 0, $font, $line);
    $lineWidth = abs($bbox[2] - $bbox[0]);
    // 每行起始 x 坐标：在可用区域内水平居中
    $x = (int)($padding + ($availWidth - $lineWidth) / 2);
    // 由于 imagettftext 以基线为准，因此先移动至本行高度
    $startY += $lineHeights[$index];
    imagettftext($image, $fontsize, 0, $x, $startY, $textColor, $font, $line);
    $startY += $lineSpacing;
}


// 输出图片
switch ($type) {
    case 'jpg':
    case 'jpeg':
        header("Content-Type: image/jpeg");
        imagejpeg($image);
        break;
    case 'webp':
        header("Content-Type: image/webp");
        imagewebp($image);
        break;
    case 'avif':
        if (function_exists('imageavif')) {
            header("Content-Type: image/avif");
            imageavif($image);
        } else {
            header("Content-Type: image/png");
            imagepng($image);
        }
        break;
    case 'png':
    default:
        header("Content-Type: image/png");
        imagepng($image);
        break;
}

imagedestroy($image);
ob_end_flush();