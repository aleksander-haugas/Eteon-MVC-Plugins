<?php
	/*
		Version: 		0.9.4
		WebSite: 		http://eteon.airzox.com
		Licensed:		AirZox Technologies
		License-key:	KJXS-NMAL-004D-V15A
		Developed by: 	Aleksander Haugas (Eteon MVC)
		
		Copyright (C) 2021, AirZox All rights reserved.
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
	*/

	/* Security measure */
	if (!defined('IN_CMS')) { exit(); }
?>
<!-- Empieza Header -->
<header class="w3-container" style="padding-top:22px">
	<h5>
		<strong>
			<i class="fa fa-group"></i> <?php echo __('Minify'); ?> | <?php echo __('Documentation'); ?>
		</strong>
	</h5>
</header>

<div id="admin-area" class="w3-row">
	<div class="w3-container w3-theme-light w3-margin">
    <h1>About</h1>
    <p>
    'Minify' is a plugin to minify JavaScript and/or CSS code and combine it 
    into one file on the fly. This will increase performance of website.<br />
    So you don't need to do dozens HTTP request for every JavaScript or CSS file. Minify plugin is more
    useful and faster with Smart cache plugin.
    </p>
  </div>
  <div class="w3-container w3-theme-light w3-margin">
    <h1>Install</h1>
    <p>
    Install the minify plugin to your Eteon MVC plugins directory:
    </p>
    <pre>
    <code class="language-shell hljs">
$cd /path/to/eteon/plugins/
$git clone git://github.com/aleksander-haugas/Eteon-MVC-Plugins/minify.git
    </code>
    </pre>

<h3>Activate minify plugin</h3>
<p>
<img src="/eteon/plugins/minify/views/minify.png" alt="" />
  </p>

<h3>Set the settings in the</h3>
<p>
So next step you need to create 'cache' directory in your document root and make it
writable. Due to security settings most webservers doesn't allow you to create 
directories dynamically, so you need to create it manually. Create it in your DOCUMENT_ROOT/cache/
and set writtable permissions.
</p>
<pre>
<code class="language-shell hljs">
$mkdir /website/root/cache/
$chmod 0666 /website/root/cache/
</code>
</pre>
<p>
Status:
<?php
$cacheDir =  $_SERVER['DOCUMENT_ROOT'] . '/cache/';
if( !is_dir($cacheDir)) {
    $color = 'red';
    $text  = '/cache/ dir does not exists';
} elseif( !is_writable($cacheDir) && is_dir($cacheDir)) {
   $color = 'orange';
   $text  = '/cache/ directory exists but not writable';
} else {
   $color = 'green';
   $text  = '/cache/ directory exist and ready to use';
}
echo "<span style='color:$color;font-weight:bold;'>$text!</span>";
?>
</p>
</div>
<div class="w3-container w3-theme-light w3-margin">
<h3>Usage in Eteon MVC</h3>

<pre>
<code class="language-php hljs">
&lt;?php
$jsFiles = array(
    '/public/javascripts/jquery-3.6.1.min.js',
    '/public/javascripts/jquery.validate.min.js',
    '/public/javascripts/jquery.form.js',
    '/public/javascripts/eteon.js'
);
$cssFiles = array(
    'path/to/master.css',
    'path/to/subpage.css',
    'path/to/ie-fix.css'
);

$js_minify  = Minify::factory('js');
$css_minify = Minify::factory('css');
?&gt;
</code>
</pre>
<pre>
<code class="language-php hljs">
&lt;link href="&lt;?php echo $css_minify->minify($cssFiles, true); ?&gt;" rel="stylesheet" type="text/css" /&gt;
&lt;script type="text/javascript" src="&lt;?php echo $js_minify->minify($files, true); ?&gt;">&lt;/script&gt;
</code>
</pre>

<p>
    The 'minify' method can pass 3 parameters:
</p>
<table class="w3-table-all w3-hoverable w3-striped w3-margin-bottom">
  <tr class="w3-theme">
    <th>name</th>
    <th>description</th>
    <th>type</th>
    <th>default</th>
  </tr>
  <tr>
    <td>files</td>
    <td>File to be minified</td>
    <td>array [required]</td>
    <td>array()</td>
  </tr>
  <tr>
    <td>output</td>
    <td>Output to file or raw output into string</td>
    <td>boolean [optinal]</td>
    <td>false</td>
  </tr>
  <tr>
    <td>fileName</td>
    <td>Name of output file</td>
    <td>string [optinal]</td>
    <td>'min.js' or 'min.css'</td>
  </tr>
</table>
  </div>
  </div>