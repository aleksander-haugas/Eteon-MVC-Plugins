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

	Plugin::setInfos(array(
	    'id'          			=> 'archive',
	    'title'       			=> __('Archived pages'),
	    'description' 			=> __('Provides an Archive pagetype behaving similar to a blog or news archive.'),
	   	'version'     			=> '1.1.0',
		'license' 				=> 'GPLv2',
		'author' 				=> 'AirZox Technologies (Eteon MVC)',
		'require_eteon_version' => '0.9.4+',
		'website'               => 'https://eteon.airzox.com/',
		'update_url'			=> 'https://airzox.com/airzox-plugins.xml',
		'type'					=> 'both'
	));

	// Check if the plugin is enabled
	if ( Plugin::isEnabled('archive') ) {

		// Add the plugin's tab and controller
		Plugin::addController('archive', '', 'admin_view', false);

		Behavior::add('archive', 'archive/archive.php');
		Behavior::add('archive_day_index', 'archive/archive.php');
		Behavior::add('archive_month_index', 'archive/archive.php');
		Behavior::add('archive_year_index', 'archive/archive.php');
	}