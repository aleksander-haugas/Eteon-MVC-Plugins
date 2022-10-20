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

class SmartCacheController extends PluginController {


    function __construct() {
        AuthUser::load();
        if (!(AuthUser::isLoggedIn())) {
            redirect(get_url('login'));
        }
        
        if (!AuthUser::hasPermission('admin_view')) {
            redirect(URL_PUBLIC);
        }

        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/smart_cache/views/sidebar'));
    }


    function index() {
        $this->display('smart_cache/views/index', array(
            'pages' => SmartCachePage::findAllFrom('SmartCachePage', '1=1 ORDER BY created_on ASC')
        ));
    }


    function documentation() {
        $this->display('smart_cache/views/documentation');
    }


    function delete($id) {
        $cached_page = SmartCachePage::findByIdFrom('SmartCachePage', $id);
        if ($cached_page->delete()) {
            Flash::set('success', 'Page was deleted from cache.');
        }
        else {
            Flash::set('error', 'The cached page could not be deleted. Try manually from the commandline.');
        }
        $message = sprintf('Single cache entry was deleted by :username.');
        Observer::notify('log_event', $message, 'smart_cache', 5);
        redirect(get_url('plugin/smart_cache/'));
    }


    function clear() {
        $error = false;
        // We need to delete them one by one to make sure the filesystem is cleaned too.
        $pages = Record::findAllFrom('SmartCachePage');
        foreach ($pages as $page) {
            if (!$page->delete()) {
                $error = true;
            }
        }
        
        if ($error === false) {
            Flash::set('success', 'Cache cleared successfully.');
        }
        else {
            Flash::set('error', 'One or more cached pages could not be deleted. Try manually from the commandline.');
        }
        $message = sprintf('Cache was cleared by :username.');
        Observer::notify('log_event', $message, 'smart_cache', 5);
        redirect(get_url('plugin/smart_cache/'));
    }


    function settings() {
        $settings = Plugin::getAllSettings('smart_cache');

        $this->display('smart_cache/views/settings', array(
            'smart_cache_by_default' => $settings['smart_cache_by_default'],
            'smart_cache_suffix' => $settings['smart_cache_suffix'],
            'smart_cache_folder' => $settings['smart_cache_folder']
        ));
    }


    function save() {
        $settings = array();
        $settings['smart_cache_by_default'] = $_POST['smart_cache_by_default'];
        $settings['smart_cache_suffix'] = $_POST['smart_cache_suffix'];
        $settings['smart_cache_folder'] = $_POST['smart_cache_folder'];
        
        if (Plugin::setAllSettings($settings, 'smart_cache')) {
            Flash::set('success', __('The cache settings have been updated.'));
            $message = sprintf('The cache settings were updated by :username.');
            Observer::notify('log_event', $message, 'smart_cache', 5);
        }
        else {
            Flash::set('error', 'The cache settings could not be updated due to an error.');
            $message = sprintf('An attempt by :username to update the cache settings failed.');
            Observer::notify('log_event', $message, 'smart_cache', 2);
        }
        redirect(get_url('plugin/smart_cache/settings'));
    }

}
