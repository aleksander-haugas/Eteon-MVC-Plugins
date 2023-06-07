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
<div class="w3-col l4">		
	<div class="w3-white w3-margin">
		<ul class="w3-card w3-ul w3-hoverable w3-white"> 
			<li class="w3-padding-16 zoom">
				<i class="fa fa-gear w3-xlarge w3-left w3-margin-right" alt="<?php echo __('Settings'); ?>"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/maintenance/settings'); ?>"> <?php echo __('Settings'); ?></a></span>
			</li>
			<li class="w3-padding-16 zoom">
				<i class="fa fa-book w3-xlarge w3-left w3-margin-right" alt="<?php echo __('Settings'); ?>"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/maintenance/documentation/'); ?>"> <?php echo __('Documentation'); ?></a></span>
			</li>
		</ul>
	</div>
</div>
<div class="w3-col l4">		
	<div class="w3-theme-light w3-margin">
		<ul class="w3-card w3-ul"> 
			<div class="w3-container w3-padding w3-theme-d4">
				<h4>Bypass con acceso a la pagina</h4>
			</div>
			<p class="w3-padding">Sólo debes agregar la llave de acceso (backdoor) al final de la url, ejemplo:</p>
			<pre><code class="language-url hljs">http://website.com/?backdoor=s0wdYJAt17EHskiSCxdJVgDn</code></pre>
		</ul>
	</div>
</div>