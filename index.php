<?php
if (isset($_GET['text'])) {
    require_once 'code.php';
    exit;
}

// 获取字体文件
$fontDir     = __DIR__ . '/fonts/';
$fonts       = array_filter(glob($fontDir . '*.ttf'), 'is_file');
$fontOptions = array_map('basename', $fonts);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>图片生成器</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }

        #container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .form {
            /*max-width: 50%;*/
            /*padding: 50px;*/
        }

        .image-preview {
            /*max-width: 50%;*/
            /*padding: 50px;*/
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select, textarea {
            width: -webkit-fill-available;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .image-preview {
            margin-top: 20px;
            /*display: none;*/
        }

        .image-preview img {
            max-width: 50vw;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0);
        }
    </style>
</head>
<body>

<h1>图片生成器</h1>

<div id="container">
    <div class="form">
        <form id="form">
            <label for="text">文本内容：</label>
            <textarea id="text" name="text" rows="4" required>示例文本
ABC
123</textarea>

            <label for="font">字体文件路径：</label>
            <select id="font" name="font" required>
                <option value=""></option>
                <?php foreach ($fontOptions as $font): ?>
                    <option value="<?= htmlspecialchars($font, ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($font, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fontsize">字体大小：</label>
            <input type="number" id="fontsize" name="fontsize" placeholder="Auto" required>

            <label for="size">图片尺寸（宽*高）：</label>
            <input type="text" id="size" name="size" placeholder="300*300" required>

            <label for="type">图片格式：</label>
            <select id="type" name="type" required>
                <option value=""></option>
                <?php foreach (['jpg', 'png', 'svg', 'webp'] as $format): ?>
                    <option value="<?= $format ?>"><?= strtoupper($format) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="fc">文字颜色（十六进制）：</label>
            <input type="text" id="fc" name="fc" placeholder="000000" required>

            <label for="bc">背景颜色（十六进制，可选）：</label>
            <input type="text" id="bc" name="bc" placeholder="透明或ffffff">

            <label for="padding">边距（px）：</label>
            <input type="number" id="padding" name="padding" placeholder="宽高最小值的10%" required>
        </form>
    </div>
    <div class="image-preview" id="image-preview">
        <div>
            <img src="" id="preview"/>
        </div>

        <div>
            <textarea id="code" rows="4"></textarea>
        </div>
        <div>
            图片大小: <span id="fileSize"></span>
        </div>
    </div>
</div>

<hr>
字体预览：所有字体来源于网络，仅供预览，请勿用于商业用途。
<br>
<div id="font-prev" style="display: flex;flex-wrap: wrap">
    <?php foreach ($fontOptions as $font): ?>
        <fieldset>
            <legend><?= $font ?>:</legend>
            <img src="https://dummyimage.yanlongli.com/?font=<?= $font ?>&text=字体预览ABC123&size=200*100" width="200"
                 height="100">
        </fieldset>
    <?php endforeach; ?>
</div>


<script defer>
    const form = document.getElementById('form');
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('image-preview');
    const fileSizeDisplay = document.getElementById('fileSize');


    function getFilteredFormData(form) {
        const formData = new FormData(form);
        return Object.fromEntries([...formData.entries()].filter(([_, value]) => value.trim() !== ''));
    }

    function formatSize(bytes) {
        if (bytes < 1024) {
            return bytes + ' B'; // 字节
        } else if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(2) + ' KB'; // 千字节
        } else if (bytes < 1024 * 1024 * 1024) {
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB'; // 兆字节
        } else {
            return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB'; // 千兆字节
        }
    }

    let padding = false;

    let t = null

    function changeImageUrl() {
        if (!padding) {
            padding = true;
        } else {
            clearTimeout(t);
        }
        t = setTimeout(function () {
            request();
            padding = false;
        }, 500);
    }

    function request() {
        const url = window.location + '?' + new URLSearchParams(getFilteredFormData(form)).toString();
        fetch(url).then(res => {
            return res.blob()
        }).then(blob => {
            preview.src = URL.createObjectURL(blob);
            fileSizeDisplay.innerHTML = formatSize(blob.size);
        }).finally(() => {
            padding = true;
        })
        document.getElementById('code').value = url;
    }


    form.addEventListener('input', changeImageUrl);
    window.addEventListener('load', request);
</script>

</body>
</html>
