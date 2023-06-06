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
<div class="w3-col l4">		
	<div class="w3-theme-d1 w3-margin">
		<ul class="w3-card w3-ul w3-hoverable"> 
			<li class="w3-padding-16 zoom w3-hover-theme">
				<i class="fa fa-gear w3-xlarge w3-left w3-margin-right" alt="<?php echo __('Settings'); ?>"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/archive/settings'); ?>"> <?php echo __('Settings'); ?></a></span>
			</li>
		</ul>
	</div>
</div>