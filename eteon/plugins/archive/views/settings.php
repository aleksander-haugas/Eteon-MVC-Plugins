<?php
    /**
     * Eteon MVC plugin "archive" main file, responsible for initiating the plugin.
     *
     * @package archive
     * @author AirZox Technologies (Eteon MVC)
     * @version 1.1.0
     *
     * Plugin Name: archive
     * Plugin URI: https://eteon.airzox.com/plugins/archive
     * Description: Provides an Archive pagetype behaving similar to a blog or news archive.
     * Version: 1.1.0
     * Requires at least: 0.9.4+
     * Requires PHP: 7.4
     * Author: AirZox Technologies (Eteon MVC)
     * Author URI: https://eteon.airzox.com/
     * Author email: info@eteon.airzox.com
     * License: GPL 2
     * Donate URI: https://eteon.airzox.com/donate/
     */

    /* Security measure */
    if (!defined('IN_CMS')) { exit(); }
?>
<header class="w3-container" style="padding-top:22px">
<h5>
	<strong><i class="fa fa-hdd-o"></i> <?php echo __('Archived pages'); ?> | <?php echo __('Settings'); ?></strong>
</h5>
</header>
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
		<form action="<?php echo get_url('plugin/archive/save'); ?>" method="post">
			<div class="w3-row w3-section w3-theme-light w3-padding">
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