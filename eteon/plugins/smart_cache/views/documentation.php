<?php
	/*
		Version: 			0.9.4
		WebSite: 		http://eteon.airzox.com
		Licensed:		AirZox Technologies
		License-key:		KJXS-NMAL-004D-V15A
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
			<i class="fa fa-hdd-o"></i> <?php echo __('Smart Cache - Example rewrite rules');?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->

<div  class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-responsive">
			<div class="w3-row w3-white w3-padding">
				<h2><?php echo __('Introduction');?></h2>
				<p>
				<?php echo __('The Smart Cache plugin works by using mod_rewrite or equivalent rewrite functionality. Below you will find generated examples for the most used HTTP servers.');?>
				<?php echo __('Please be aware the author of this plugin cannot guarantee the accuracy of these examples and does not know all rewrite systems.');?>
				</p>
				<p>
				<?php echo __('Always check the plugin settings after enabling it!');?>
				</p>

				<h2>Apache</h2>
				<p>
				Caching relies on correctly set mod_rewrite rules. The section below is the set of mod_rewrite rules you should place in your
				.htaccess file. It was generated based on your settings.
				</p>
				<p>
				You should place these rules <strong>before</strong> the standard Eteon CMS rules and <strong>after</strong> the RewriteBase line.
				</p>
				<div class="notranslate">
					<pre><code class="language-apache hljs">
# Check for cached index page from static cache folder.
RewriteCond %{REQUEST_METHOD} ^GET$
RewriteCond %{DOCUMENT_ROOT}<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?><?php echo URI_PUBLIC; ?>index<?php echo smart_cache_suffix(); ?> -s
RewriteRule ^$ %{DOCUMENT_ROOT}<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?><?php echo URI_PUBLIC; ?>index<?php echo smart_cache_suffix(); ?> [L]

# Check for other cached pages from static cache folder.
RewriteCond %{REQUEST_METHOD} ^GET$
RewriteCond %{DOCUMENT_ROOT}<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?>%{REQUEST_URI} -s
RewriteRule (.*) %{DOCUMENT_ROOT}<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?>%{REQUEST_URI} [L]
					</code></pre>
				</div>

				<h2>Nginx</h2>
				<p>
				Caching relies on correctly set HttpRewriteModule rules. The section below is the set of HttpRewriteModule rules you should place in your
				config file. It was generated based on your settings.
				</p>
				<p>
				You should place these rules <strong>before</strong> the standard Eteon CMS rules.
				</p>
				<div class="notranslate">
					<pre><code class="language-nginx hljs">
# Check for cached index page from static cache folder.
if (-f $document_root<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?><?php echo URI_PUBLIC; ?>index<?php echo smart_cache_suffix(); ?>) {
rewrite ^/$ <?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?><?php echo URI_PUBLIC; ?>index<?php echo smart_cache_suffix(); ?> last;
}

# Check for other cached pages from static cache folder.
if (-f $document_root<?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?>$request_uri) {
rewrite (.*) <?php echo URI_PUBLIC; ?><?php echo trim(smart_cache_folder(), '/'); ?>$request_uri last;
}
</code></pre>
</div>

				<p>
				<?php echo __('If you have translated the rewrite rules to another platform, please let the maintainer of this plugin know.');?>
				</p>
			</div>
		</div>
	</div>
</div>
