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

if (!defined('IN_CMS')) { exit(); }

Flash::set('info', __('Successfully deactivated :name plugin!', array(':name' => __('Archived pages'))));
exit();