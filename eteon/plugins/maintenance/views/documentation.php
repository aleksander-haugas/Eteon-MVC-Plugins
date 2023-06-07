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
			<i class="fa fa-gears"></i>  <?php echo __('Maintenance'); ?> | <?php echo __('Documentation'); ?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->
<!-- Start dashboard Settings -->
<div  class="w3-col l8 s12">
	<div class="w3-white w3-margin w3-content">
		<div class="w3-responsive">
			<div class="w3-container">
				<h3><?php echo __('Maintenance'); ?></h3>
				<p>The Maintenance plugin for Eteon MVC is a tool that allows website administrators to easily take their site offline for maintenance or updates.</p>
				<p>The plugin sends the correct HTTP headers to notify search engines and browsers that the site is temporarily unavailable, and provides several options for redirecting users to a custom URL or behavior page.</p>
				<p>The plugin also includes a backdoor key for site administrators to bypass the maintenance mode, and can be configured to allow access for specific IP addresses. Additionally, the plugin provides the option to exclude specific pages or content from the maintenance mode, allowing users to access important information or resources while the site is offline.</p>

				<h2>FUNCTIONALITY</h2>
				<p>The "Backdoor key" is a randomly generated string of characters that allows access to specific pages on a website. This key is used as a security measure to restrict access to sensitive pages and is typically only known by authorized personnel.</p>
				<p>To ensure the safety and privacy of the Backdoor key, it is recommended to use a session to remember the key instead of storing it permanently. This means that the key will be forgotten once the session has ended, reducing the risk of unauthorized access.</p>
				<p>If you need to generate a new Backdoor key, simply click on the "click to generate random key" button, and a new key will be generated for you.</p>
				<p>For example, if you want to access the "about us" page on a website, you would add the Backdoor key to the URL as a parameter, like so: "http://website.com/about-us.html?backdoor=WTW039ar". This will grant you access to the page without having to enter any additional login credentials.</p>
				<ul>
					<li>redirect page to url or behavior page</li>
					<li>access via backdoor key</li>
					<li>access via global IPs</li>
					<li>available exceptions for selected pages</li>
				</ul>
			</div>
		</div>
	</div>
</div>