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

	AuthUser::load();
	// Check if the user is logged in
	if (!AuthUser::isLoggedIn()) {
		// Redirect to the login page
		redirect(get_url('login'));
  
	// check if the user have permissions to edit admin section
	} else if (!AuthUser::hasPermission('admin_edit')) {
		Flash::set('error', __('You do not have permission to activate or use this plugin!'));
		Plugin::deactivate('archive');
		redirect(get_url());
	} else {
		// Success message
		Flash::set('success', __('Successfully activated :name plugin!', array(':name' => __('Archived pages'))));
		
		// Store settings new style
		$settings = array('use_dates' => '1');
		Plugin::setAllSettings($settings, 'archive');
	}
	exit();