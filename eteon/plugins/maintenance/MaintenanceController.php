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

class MaintenanceController extends PluginController {

    const PLUGIN_ID = 'maintenance';

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
	
	public function documentation() {
		$content = Parsedown::instance()->parse(file_get_contents(PLUGINS_ROOT.DS.'maintenance'.DS.'README.md'));
       		$this->display('maintenance/views/documentation', array('content'=>$content));
    	}
	
	public function _changeStatus() {
		$settings['status'] = $_GET['status'];
		Plugin::setAllSettings($settings, 'maintenance');

		if($_POST['status'] == 'on') {
			Observer::notify('log_event', __('Maintenance mode has been enabled by :username.'), __('Maintenance Mode'), DASHBOARD_LOG_NOTICE);
			Flash::set('success', __('Maintenance mode has been enabled.'));
		} elseif ($_POST['status'] == 'off'){
			Observer::notify('log_event', __('Maintenance mode has been disabled by :username.'), __('Maintenance Mode'), DASHBOARD_LOG_NOTICE);
			Flash::set('success', __('Maintenance mode has been disabled.'));
		}
		if($_SERVER['HTTP_REFERER'] != '') {
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Forward back
        }else {
            $url = get_url('plugin/maintenance/');
            header('Location: ' . $url); // Forward home
        }
	}
	
	public function _save() {
		if ( ( $_POST['redirect_page'] == 'url') && (!preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i',$_POST['url_page'])) ):
			Flash::set('error', __('Url is not valid'));
		else:
			$settings = array('users_array' => implode(',',$_POST['users_array']),
				'redirect_page' => $_POST['redirect_page'],
				'url_page' => $_POST['url_page'],
				'backdoor_key'=> $_POST['backdoor_key']
			);
			if (!array_key_exists('backdoor_key_session', $_POST))
				$settings['backdoor_key_session'] = 'off';
			else
				$settings['backdoor_key_session'] = 'on';
			$ip = explode(',',$_POST['global_ip']);
			// remove duplicates
			$ip = array_unique($ip);
			// remove empty entries
			$ip = array_diff($ip, array(''));
			if (count($ip)==0)
				$settings['global_ip'] = '0.0.0.0';
			else
				$settings['global_ip'] = implode(',',$ip);
			if (Plugin::setAllSettings($settings, 'maintenance'))
				Flash::set('success', __('Plugin settings saved.'));
			else
				Flash::set('error', __('Plugin settings not saved!'));
		endif;
		redirect(get_url('plugin/maintenance/settings'));
	}
	
	function settings() {
		$page = Page::find(array('where' => '`behavior_id` = \'maintenance\'', 'limit' => 1));
		$this->display('maintenance/views/settings', array(
			'status' => Plugin::getSetting('status', 'maintenance'),
			'has_page' => is_object($page),
			'users_array' => Plugin::getSetting('users_array', 'maintenance'),
			'redirect_page' => Plugin::getSetting('redirect_page', 'maintenance'),
			'url_page' => Plugin::getSetting('url_page', 'maintenance'),
			'backdoor_key' => Plugin::getSetting('backdoor_key', 'maintenance'),
			'backdoor_key_session' => Plugin::getSetting('backdoor_key_session', 'maintenance'),
			'global_ip' => Plugin::getSetting('global_ip', 'maintenance')
		));
	}
}