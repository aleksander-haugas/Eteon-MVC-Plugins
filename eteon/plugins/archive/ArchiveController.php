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

/**
 * 
 */
class ArchiveController extends PluginController {

    const PLUGIN_ID = 'archive';

    public function __construct() {
        if (defined('CMS_BACKEND')) {
            AuthUser::load();
            if (!AuthUser::isLoggedIn()) {
                redirect(get_url('login'));
            }
            else if (!AuthUser::hasPermission('admin_edit')) {
                Flash::set('error', __('You do not have permission to access the requested page!'));
                redirect(get_url());
            }

			$this->setLayout('backend');
            $this->assignToLayout('sidebar', new View( PLUGINS_ROOT.DS.self::PLUGIN_ID.DS.'views/sidebar'));
		}
    }

    public function index() {
        $this->settings();
    }

    /*
    public function documentation() {
        $this->display('skeleton/views/documentation');
    }
     * 
     */

    function settings() {
        $this->display('archive/views/settings', array('settings' => Plugin::getAllSettings('archive')));
    }
    
    function save() {
        if (isset($_POST['settings'])) {
            if (Plugin::setAllSettings($_POST['settings'], 'archive')) {
                Flash::set('success', __('The settings have been saved.'));
            }
            else {
                Flash::set('error', __('An error occured trying to save the settings.'));
            }
        }
        else {
            Flash::set('error', __('Could not save settings, no settings found.'));
        }

        redirect(get_url('plugin/archive/settings'));
    }
}