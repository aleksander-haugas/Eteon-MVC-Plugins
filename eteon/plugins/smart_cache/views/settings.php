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
			<i class="fa fa-hdd-o"></i> <?php echo __('Smart Cache Plugin'); ?> | <?php echo __('Cache settings'); ?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->
<!-- Start edit smart cache settings -->
<div  class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
			<form action="<?php echo get_url('plugin/smart_cache/save'); ?>" method="post">
				<div class="w3-row w3-section w3-white w3-padding">
					<p>
						<label for="smart_cache_by_default" class="w3-text-grey"><?php echo __('Cache by default'); ?>: </label>						
						<select name="smart_cache_by_default" class="w3-input w3-border w3-hover-light-gray">
							<option value="1" <?php if ($smart_cache_by_default == "1") echo 'selected ="";' ?>><?php echo __('Yes'); ?></option>
							<option value="0" <?php if ($smart_cache_by_default == "0") echo 'selected ="";' ?>><?php echo __('No'); ?></option>
						</select>							
						<small class="help"><?php echo __('Choose yes if you want your pages to be cached by default. Otherwise you must set caching for each page manually.'); ?></small>
					</p>
					<p>
						<label for="smart_cache_suffix" class="w3-text-grey"><?php echo __('Cache file suffix'); ?>: </label>
						<input type="text" name="smart_cache_suffix" value="<?php print $smart_cache_suffix ?>" class="w3-input w3-border w3-hover-light-gray">
						<small class="help"><?php echo __('Suffix for cache files written to disk. If you use other than .html you also need to update your mod_rewrite rules.'); ?></small>
					</p>
					<p>
						<label for="smart_cache_folder" class="w3-text-grey"><?php echo __('Cache folder'); ?>: </label>
						<input type="text" name="smart_cache_folder" value="<?php print $smart_cache_folder ?>" class="w3-input w3-border w3-hover-light-gray">
						<small class="help"><?php echo __('Folder where static cache files are written. Relative to document root. When you change this you also need to update your mod_rewrite rules.'); ?></small>
					</p>
					<p class="buttons">
						<input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
					</p>
				</div>
			</form>
		</div>
	</div>
</div>