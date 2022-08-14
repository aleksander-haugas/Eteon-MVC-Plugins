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
<header class="w3-container" style="padding-top:22px">
<h5>
	<strong><i class="fa fa-hdd-o"></i> <?php echo __('Archive'); ?> Plugin | <?php echo __('Settings'); ?></strong>
</h5>
</header>
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
		<form action="<?php echo get_url('plugin/archive/save'); ?>" method="post">
			<div class="w3-row w3-section w3-white w3-padding">
				<p>
					<label for="setting_use_dates" class="w3-text-grey"><?php echo __('Generate dates'); ?>: </label>
					<select name="settings[use_dates]" id="setting_use_dates" class="w3-input w3-border w3-hover-light-gray">
						<option value="1" <?php if ($settings['use_dates'] == "1") echo 'selected ="";' ?>><?php echo __('Yes'); ?></option>
						<option value="0" <?php if ($settings['use_dates'] == "0") echo 'selected ="";' ?>><?php echo __('No'); ?></option>
					</select>
					<small class="help"><?php echo __('Do you want to generate dates for the URLs?'); ?></small>
				</p>
				<p class="buttons">
					<input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>">
				</p>
			</div>
		</form>
		</div>
	</div>
</div>
