<?php
$fonts = array_diff(scandir(__DIR__.'/fonts/'), ['.', '..']);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="monetization" content="$coil.xrptipbot.com/nvumKRswQjW3cEAkGE4b3A">
<title>Dynamic Dummy Image Generator - DummyImage.com</title>
<link href="css/reset.css" rel="stylesheet" media="all">
<link href="css/dummyimage.css" rel="stylesheet" media="all">
<link href="css/colorpicker.css" rel="stylesheet" media="all">
<link rel="shortcut icon" href="/favicon.ico">
<script type="text/javascript">
if ( top != self ) { top.location.href = 'https://dummyimage.com/'; }

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-50793-5']);
  _gaq.push(['_trackPageview']);

  (function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9571026409625337" crossorigin="anonymous"></script>-->
</head>
<body>
<h1>Dynamic Dummy Image Generator</h1>
<cite>by <a href="#about">Russell Heimlich</a> (<a href="https://twitter.com/kingkool68">@kingkool68</a>)</cite>
<a id="preview" href="600x400/000/fff" target="_blank">
	<img src="600x400/000/fff">
</a>
<form id="demo">
  <h2><a href="600x400/000/fff" target="_blank">600x400/000/fff</a></h2>
  <label for="size">Size
	<input type="text" class="text" name="size" id="size" value="600x400" size="8">
  </label>
  <span class="slash seperator">/</span>
  <label for="bgColor">Background Color
	<input type="text" class="text" name="bgColor" id="bgColor" value="000" size="6" maxlength="6">
  </label>
  <span class="slash seperator">/</span>
  <label for="fgColor">Foreground Color
	<input type="text" class="text" name="fgColor" id="fgColor" value="fff" size="6" maxlength="6">
  </label>
  <span class="period seperator">.</span>
  <label for="format">Format
	<select name="format" id="format">
	  <option value="" selected></option>
	  <option value=".png">png</option>
	  <option value=".gif">gif</option>
	  <option value=".jpg">jpg</option>
	  <option value=".webp">webp</option>
	</select>
  </label>
  <span class="ampersand seperator">&amp;</span>
  <label for="text">Text
	<input type="text" name="text" id="text" value="" size="30">
  </label>
  <span class="ampersand seperator">&</span>
    <label for="font">font
        <select name="font" id="font">
            <option value="" selected></option>
            <?php foreach($fonts as $font): ?>
                <option value="<?=$font?>"><?=$font?></option>
            <?php endforeach;?>
        </select>
    </label>
</form>
<h3 id="documentation">Documentation</h3>
<h4 id="size">Size</h4>
<p>width x height</p>
<ul>
  <li>Height is optional, if no height is specified the image will be a square. Example: <a href="300" class="example correct">https://dummyimage.com/300</a></li>
  <li><strong>Must</strong> be the first option in the url</li>
  <li>You can specify one dimension and a ratio and dummyimage will calculate the right value. Example: <a href="/640x4:3/" class="example correct">https://dummyimage.com/640x4:3</a> or <a href="/16:9x1080/" class="example correct">https://dummyimage.com/16:9x1080</a></li>
</ul>
<h4 id="color">Colors</h4>
<p>background color / text color</p>
<ul>
  <li>Colors are represented as hex codes (#ffffff is white)</li>
  <li>Colors always follow the dimensions, <a href="250/ffffff/000000" target="_blank" class="example correct">https://dummyimage.com/250/ffffff/000000</a> not <a href="ffffff/250/000000" target="_blank" class="example incorrect">https://dummyimage.com/ffffff/250/000000</a></li>
  <li>The first color is always the background color and the second color is the text color.</li>
  <li>The background color is optional and defaults to gray (#cccccc)</li>
  <li>The text color is optional and defaults to black (#000000)</li>
  <li>There are shortcuts for colors
	<ul>
	  <li>3 digits will be expanded to 6, <span class="example">09f</span> becomes <span class="example">0099ff</span></li>
	  <li>2 digits will be expanded to 6, <span class="example">ef</span> becomes <span class="example">efefef</span></li>
	  <li>1 digit will be repeated 6 times, <span class="example">c</span> becomes <span class="example">cccccc</span> Note: a single 0 will not work, use 00 instead.</li>
	</ul>
  </li>
  <li>Standard image sizes are also available. See the <a href="#standards">complete list</a>.
	<ul>
	  <li><a href="qvga" target="_blank" class="example correct">https://dummyimage.com/qvga</a></li>
	  <li><a href="skyscraper/f0f/f" target="_blank" class="example correct">https://dummyimage.com/skyscraper/f0f/f</a></li>
	</ul>
  </li>
</ul>
<h4 id="format">Image Formats</h4>
<p>.gif, .jpg, .png</p>
<ul>
  <li>Adding an image file extension will render the image in the proper format</li>
  <li>Image format is optional and the default is a gif</li>
  <li>jpg and jpeg are the same</li>
  <li>The image extension can go at the end of any option in the url
	<ul>
	  <li><a href="300.png/09f/fff" target="_blank" class="example correct">https://dummyimage.com/300.png/09f/fff</a></li>
	  <li><a href="300/09f.png/fff" target="_blank" class="example correct">https://dummyimage.com/300/09f.png/fff</a></li>
	  <li><a href="300/09f/fff.png" target="_blank" class="example correct">https://dummyimage.com/300/09f/fff.png</a></li>
	</ul>
  </li>
</ul>
<h4 id="text">Custom Text</h4>
<p>&amp;text=Hello+World</p>
<ul>
  <li>Custom text can be entered using a query string at the very end of the url.</li>
  <li>This is optional, default is the image dimensions (<span class="example">300&times;250</span>)</li>
  <li>a-z (upper and lowercase), numbers, and most symbols will work just fine.</li>
  <li>Spaces become +
	<ul>
	  <li><a href="200x300&text=dummyimage.com+rocks!" target="_blank" class="example correct">https://dummyimage.com/200x300&amp;text=dummyimage.com+rocks!</a></li>
	</ul>
  </li>
  <li>The font used is from the freely available <a href="http://mplus-fonts.sourceforge.jp" target="_blank">M+ Font Project</a></li>
</ul>
<p>The following characters need to be encoded using the UTF-8 Hex version in order to be rendered properly.</p>
<table id="special-characters">
	<thead>
		<tr>
			<th>Character</th>
			<th>UTF-8 Hex Equivalent</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>+</td>
			<td><a href="480&text=Plus+Sign=0x2B">0x2B</a></td>
		</tr>
		<tr>
			<td>#</td>
			<td><a href="480&text=Number+sign+(Octothorp)=0x23">0x23</a></td>
		</tr>
		<tr>
			<td>%</td>
			<td><a href="480&text=Percent+symbol=0x25">0x25</a></td>
		</tr>
		<tr>
			<td>&amp;</td>
			<td><a href="480&text=Ampersand=0x26">0x26</a></td>
		</tr>
	</tbody>
</table>
<p>You'll run into problems trying to manually enter a dimension as text if the numbers use the UTf-8 Hex values above, like <a href="480&text=400x250">&amp;text=400x250</a>. Use a multiplication symbol, &#215; instead (not an x character) to get around this, <a href="480&text=400×250">&amp;text=400&#215;250</a>.</p>
<p>If you need to use other unicode characters, look up their UTF-8 Hex version at <a href="http://www.fileformat.info/info/unicode/char/search.htm" target="_blank">http://www.fileformat.info/info/unicode/char/search.htm</a></p>
<h4 id="standards">Standard Image Sizes</h4>
<p>Several standard dimensions are included in dummyimage.com including <a href="http://www.iab.net/iab_products_and_industry_services/1421/1443/1452">ad sizes</a> and <a href="http://en.wikipedia.org/wiki/File:Vector_Video_Standards2.svg">screen resolution sizes</a>.</p>
<h5 id="ad">Ad Sizes</h5>
<table>
  <thead>
	<tr>
	  <th>Keyword</th>
	  <th>Shortcuts</th>
	  <th>Dimensions</th>
	  <th>Regular Expression</th>
	</tr>
  </thead>
  <tbody>
	<tr>
	  <td><a href="mediumrectangle">mediumrectangle</a></td>
	  <td><a href="medrect">medrect</a></td>
	  <td>300&times;250</td>
	  <td>^(med)\w+(rec\w+)</td>
	</tr>
	<tr>
	  <td><a href="squarepopup">squarepopup</a></td>
	  <td><a href="sqrpop">sqrpop</a></td>
	  <td>250&times;250</td>
	  <td>^(s\w+pop)</td>
	</tr>
	<tr>
	  <td><a href="verticalrectangle">verticalrectangle</a></td>
	  <td><a href="vertrec">vertrec</a></td>
	  <td>240&times;400</td>
	  <td>^(ver)\w+(rec)</td>
	</tr>
	<tr>
	  <td><a href="largerectangle">largerectangle</a></td>
	  <td><a href="lrgrec">lrgrec</a></td>
	  <td>336&times;280</td>
	  <td>^(large|lrg)(rec)</td>
	</tr>
	<tr>
	  <td><a href="rectangle">rectangle</a></td>
	  <td><a href="rec">rec</a></td>
	  <td>180&times;150</td>
	  <td> ^(rec)</td>
	</tr>
	<tr>
	  <td><a href="popunder">popunder</a></td>
	  <td><a href="pop">pop</a></td>
	  <td>720&times;300</td>
	  <td>^(pop)</td>
	</tr>
	<tr>
	  <td><a href="fullbanner">fullbanner</a></td>
	  <td><a href="fullban">fullban</a></td>
	  <td>468&times;60</td>
	  <td>^(f\w+ban)</td>
	</tr>
	<tr>
	  <td><a href="halfbanner">halfbanner</a></td>
	  <td><a href="halfban">halfban</a></td>
	  <td>234&times;60</td>
	  <td>^(h\w+ban)</td>
	</tr>
	<tr>
	  <td><a href="microbar">microbar</a></td>
	  <td><a href="mibar">mibar</a></td>
	  <td>88&times;31</td>
	  <td>^(m\w+bar)</td>
	</tr>
	<tr>
	  <td><a href="button1">button1</a></td>
	  <td><a href="but1">but1</a></td>
	  <td>120&times;90</td>
	  <td>^(b\w+1)</td>
	</tr>
	<tr>
	  <td><a href="button2">button2</a></td>
	  <td><a href="but2">but2</a></td>
	  <td>120&times;60</td>
	  <td>^(b\w+2)</td>
	</tr>
	<tr>
	  <td><a href="verticalbanner">verticalbanner</a></td>
	  <td><a href="vertban">vertban</a></td>
	  <td>120&times;240</td>
	  <td>^(ver\w+ban)</td>
	</tr>
	<tr>
	  <td><a href="squarebutton">squarebutton</a></td>
	  <td><a href="sqrbut">sqrbut</a></td>
	  <td>125&times;125</td>
	  <td>^(s\w+but)</td>
	</tr>
	<tr>
	  <td><a href="leaderboard">leaderboard</a></td>
	  <td><a href="leadbrd">leadbrd</a></td>
	  <td>728&times;90</td>
	  <td>^(lea\w+rd)</td>
	</tr>
	<tr>
	  <td><a href="wideskyscraper">wideskyscraper</a></td>
	  <td><a href="wiskyscrpr">wiskyscrpr</a></td>
	  <td>160&times;600</td>
	  <td>^(w\w+sk\w+r)</td>
	</tr>
	<tr>
	  <td><a href="skyscraper">skyscraper</a></td>
	  <td><a href="skyscrpr">skyscrpr</a></td>
	  <td>120&times;600</td>
	  <td>^(sk\w+r)</td>
	</tr>
	<tr>
	  <td><a href="halfpage">halfpage</a></td>
	  <td><a href="hpge">hpge</a></td>
	  <td>300&times;600</td>
	  <td>^(h\w+g)</td>
	</tr>
  </tbody>
</table>
<h5 id="screen">Screen Standards</h5>
<table>
  <thead>
	<tr>
	  <th>Keyword</th>
	  <th>Dimensions</th>
	</tr>
  </thead>
  <tbody>
	<tr>
	  <td><a href="cga">cga</a></td>
	  <td>320x200</td>
	</tr>
	<tr>
	  <td><a href="qvga">qvga</a></td>
	  <td>320x240</td>
	</tr>
	<tr>
	  <td><a href="vga">vga</a></td>
	  <td>640x480</td>
	</tr>
	<tr>
	  <td><a href="wvga">wvga</a></td>
	  <td>800x480</td>
	</tr>
	<tr>
	  <td><a href="svga">svga</a></td>
	  <td>800x480</td>
	</tr>
	<tr>
	  <td><a href="wsvga">wsvga</a></td>
	  <td>1024x600</td>
	</tr>
	<tr>
	  <td><a href="xga">xga</a></td>
	  <td>1024x768</td>
	</tr>
	<tr>
	  <td><a href="wxga">wxga</a></td>
	  <td>1280x800</td>
	</tr>
	<tr>
	  <td><a href="wsxga">wsxga</a></td>
	  <td>1440x900</td>
	</tr>
	<tr>
	  <td><a href="wuxga">wuxga</a></td>
	  <td>1920x1200</td>
	</tr>
	<tr>
	  <td><a href="wqxga">wqxga</a></td>
	  <td>2560x1600</td>
	</tr>
  </tbody>
</table>
<h5 id="video">Video Standards</h5>
<table>
  <thead>
	<tr>
	  <th>Keyword</th>
	  <th>Dimensions</th>
	</tr>
  </thead>
  <tbody>
	<tr>
	  <td><a href="ntsc">ntsc</a></td>
	  <td>720x480</td>
	</tr>
	<tr>
	  <td><a href="pal">pal</a></td>
	  <td>768x576</td>
	</tr>
	<tr>
	  <td><a href="hd720">hd720</a></td>
	  <td>1280x720</td>
	</tr>
	<tr>
	  <td><a href="hd1080">hd1080</a></td>
	  <td>1920x1080</td>
	</tr>
  </tbody>
</table>
<h4 id="flash">Flash Support</h4>
<p>Dummyimage.com works with Flash applications.</p>
<ul>
  <li>Images are served with a specified <a href="http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.13" class="example">Content-Length</a> so they can be used in preloaders</li>
  <li>Dummyimage.com uses a <a href="crossdomain.xml" class="example">crossdomain.xml</a> file</li>
</ul>
<h3 id="download">Source Code on GitHub</h3>
<h4><a href="https://github.com/kingkool68/dummyimage">https://github.com/kingkool68/dummyimage</a></h4>
<p id="license">Dummy Image is written in PHP and distributed freely under a <a rel="license" href="http://creativecommons.org/licenses/MIT/">MIT License</a>.</p>
<h4 id="other-downloads">Other Versions</h4>
<dl>
  <dt><a href="http://github.com/xxx/fakeimage" target="_blank">Fakeimage</a></dt>
  <dd class="language">Ruby</dd>
  <dd class="author">Michael Dungan</dd>
  <dt><a href="http://code.google.com/p/aspnet-dummyimage/" target="_blank">ASP.net Dummy Image</a></dt>
  <dd class="language">ASP.net</dd>
  <dd class="author">Jess Tedder</dd>
  <dt><a href="https://github.com/darkrho/django-dummyimage" target="_blank">Dynamic Dummy Image Generator for Django</a></dt>
  <dd class="language">Django/Python</dd>
  <dd class="author">Rolando Espinoza La fuente</dd>
  <dt><a href="http://rndimg.com" target="_blank">Random Image Generator</a></dt>
  <dd class="author">Johan Thomsen</dd>
  <dt><a href="http://expressionengine.com/forums/viewthread/145773/" target="_blank">Dummy Image Generator Expression Engine Plugin</a></dt>
  <dd class="language">PHP/Expression Engine</dd>
  <dd class="author">tsiger</dd>
  <dt><a href="http://www.robertgomez.org/blog/2010/03/03/dummy-image-bookmarklet" target="_blank">Dummy Image Bookmarklet</a></dt>
  <dd class="language">JavaScript</dd>
  <dd class="author">Robert Gomez</dd>
  <dt><a href="http://ipsumimage.appspot.com/" target="_blank">Ipsum Image</a></dt>
  <dd class="language">Python/Google App Engine</dd>
  <dd class="author">Dan Moore</dd>
  <dt><a href="http://tumble.dasmith.co.uk/post/519622101/textmate-snippet-for-inserting-dummy-images" target="_blank">Textmate Snippet</a></dt>
  <dd class="language">Textmate</dd>
  <dd class="author">Danny Smith</dd>
  <dt><a href="http://github.com/kennethreitz/DummyImage.tmBundle" target="_blank">Forked Textmate Bundle</a> (<a href="http://github.com/AzizLight/DummyImage.tmBundle" target="_blank">Forked version</a> by Aziz Light)</dt>
  <dd class="language">Textmate</dd>
  <dd class="author">Kenneth Reitz</dd>
  <dt><a href="http://github.com/derekahmedzai/dummyimages/" target="_blank">Dummyimages Drupal Module</a></dt>
  <dd class="language">PHP/Drupal</dd>
  <dd class="author">Derek Ahmedzai</dd>
  <dt><a href="http://modxcms.com/extras/package/754" target="_blank">DIG (Dynamic Image Generator)</a></dt>
  <dd class="language">PHP/MODx CMS</dd>
  <dd class="author">Brian Wente</dd>
  <dt><a href="http://drupal.org/project/dummyimage" target="_blank">Dummy image</a></dt>
  <dd class="language">PHP/Drupal</dd>
  <dd class="author">naxoc</dd>
  <dt><a href="http://soderlind.no/archives/2010/11/17/lorem-shortcode/" target="_blank">[lorem] shortcode</a></dt>
  <dd class="language">PHP/WordPress</dd>
  <dd class="author">Per Soderlind</dd>
  <dt><a href="http://typo3.org/extensions/repository/view/fr_dummy_image/current/" target="_blank">Dummy Image ( fr_dummy_image )</a></dt>
  <dd class="language">PHP/TYPO3</dd>
  <dd class="author">Robert Ferencek</dd>
</dl>
<h3 id="about">About Russell Heimlich</h3>
<p>I am <a href="http://www.russellheimlich.com/blog">Russell Heimlich</a> (<a href="http://twitter.com/kingkool68">@kingkool68</a>) and I like to <a href="http://spiritedmedia.com">design web pages</a>, <a href="http://www.russellheimlich.com/blog">blog</a>, and doodle around in <a href="http://www.russellheimlich.com/blog/tags/coding/">JavaScript and PHP</a>.</p>
<h4 id="contact">Contact</h4>
<p>Still have questions or suggestions? <a href="http://www.russellheimlich.com/contact.html">Contact me</a>.</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="js/colorpicker.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#demo input, #demo select').change(function() {
		updateDemo();
	});

	$('#bgColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$el = $(el);
			$el.val(hex);
			$el.ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			$('#bgColor').val(hex);
		},
		onHide: function (picker) {
			var bgColor = $('.colorpicker_hex input', picker).val();
			$('#bgColor').val(bgColor);
			updateDemo();
		},
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});

	$('#fgColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$el = $(el);
			$el.val(hex);
			$el.ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			$('#fgColor').val(hex);
		},
		onHide: function (picker) {
			var fgColor = $('.colorpicker_hex input', picker).val();
			$('#fgColor').val( fgColor );
			updateDemo();
		},
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});

	function updateDemo() {
		var url = window.location.href;
		$('#demo input, #demo select').each(function(count) {
			$this = $(this);
			val = $this.val();
			if( val ) {
				switch(count) {
					case 1:
						url += '/' + val;
					break;
					case 2:
						url += '/' + val;
					break;
					case 4:
						var text = val;
						text = text.replace(/#/ig, "0x23");
						text = text.replace(/%/ig, "0x25");
						text = text.replace(/&/ig, "0x26");
						text = text.replace(/\+/ig, "0x2B");
						text = text.replace(/\s/ig, '+');
						url += '&text=' + text;
					break;
                    case 5:
                        url += '&font=' + val;
                        break;
					default:
						url += val;
				}
			}
		});
		$('#preview img').attr('src',url);
		$('#preview').attr('href', url);
		$('#demo a').attr('href',url).text(url);
	}

	updateDemo();
});
</script>
</body>
</html>
