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

	Plugin::setInfos(array(
	'id'          	=> 'maintenance',
	'title'       	=> __('Maintenance'),
	'description' 	=> __('Helps you to take your site offline for a short time sending correct HTTP header.'),
	'version'     	=> '0.82',
	'author'      	=> 'AirZox Technologies (Eteon MVC)',
	'website'     	=> 'https://eteon.airzox.com/',
	'update_url'  	=> 'https://airzox.com/airzox-plugins.xml'
	));

	/**
	 * Root location where maintenance plugin lives.
	 */
	define('MAINTENANCE_ROOT', PATH_PUBLIC.'eteon/plugins/maintenance');

	// Load class into the system.
	AutoLoader::addFolder(dirname(__FILE__) . '/models');

	Behavior::add('maintenance', '');
	Observer::observe('page_requested', 'maintenance_page_requested');
	Observer::observe('view_page_edit_plugins', 'maintenance_display_dropdown');
	Observer::observe('page_add_after_save',  'maintenance_on_page_saved');
	Observer::observe('page_edit_after_save', 'maintenance_on_page_saved');

	function maintenance_on_page_saved($page) {
		$status = 0;
		$input = $_POST['page'];

		if (isset($input['maintenance']) && is_int((int)$input['maintenance']))
		$status = $input['maintenance'];

		Record::update('Page', array('maintenance' => $status), 'id = ?', array($page->id));
	}

	function maintenance_display_dropdown(&$page)
	{
		echo '<p><label for="page_maintenance_status" class="w3-text-grey">'.__('Maintenance').'</label>';
		echo '<select id="page_maintenance_status" name="page[maintenance]" class="w3-input w3-border w3-hover-light-gray">';
		echo '<option value="1"'.($page->maintenance == 1 ? ' selected="selected"': '').'>'.__('exception').'</option>';
		echo '<option value="0"'.($page->maintenance == 0 ? ' selected="selected"': '').'>'.__('no exception').'</option>';
		echo '</select></p>';	
	}

	Plugin::addController('maintenance', __('Maintenance'),"admin_edit",true);

	function maintenance_page_requested($uri) {
		global $__CMS_CONN__;
		AuthUser::load();
		$users_array = explode(',',Plugin::getSetting('users_array', 'maintenance'));
		$entrance = 0;
		if( (AuthUser::isLoggedIn()) and (in_array(AuthUser::getId(),$users_array)) ) $entrance++;
		/* backodor */
		if(Plugin::getSetting('backdoor_key_session', 'maintenance')== 'off') $_SESSION['maintenance'] = '0';
		if( (isset($_REQUEST['backdoor'])) && ($_REQUEST['backdoor']==Plugin::getSetting('backdoor_key', 'maintenance')) ): 
			$entrance++; 
			$_SESSION['maintenance'] = '1'; 
		endif;
		if ( (isset($_SESSION['maintenance'])) && ($_SESSION['maintenance'] == '1') && (Plugin::getSetting('backdoor_key_session', 'maintenance') == 'on') ) $entrance++;
		if (in_array($_SERVER['REMOTE_ADDR'], explode(',',Plugin::getSetting('global_ip', 'maintenance')))) $entrance++;
		/* exception */
		$pageobject = Page::find('/'.$uri); if (is_object($pageobject) && $pageobject->maintenance == '1') $entrance++;
		/* display */
		if( (Plugin::getSetting('status', 'maintenance') == 'on') and ($entrance == 0) ){
			// Load Page
			$page = Page::find(array('where' => '`behavior_id` = \'maintenance\'', 'limit' => 1));
			if( (is_object($page)) and (Plugin::getSetting('redirect_page', 'maintenance')=='behavior_page') ) {
				$page_id = $page->id;
				while((int) $page->layout_id == 0) {
					$stmt = $__CMS_CONN__->query('SELECT parent_id, layout_id FROM '.TABLE_PREFIX.'page WHERE `id` = '.$page_id);
					$obj = $stmt->fetchObject();
					$page_id = $obj->parent_id;
					$page->layout_id = $obj->layout_id;
				}
				header('HTTP/1.0 503 Service unavailable');
				header('Status: 503 Service unavailable');
				$page->_executeLayout();
				exit();
			}elseif(Plugin::getSetting('redirect_page', 'maintenance')=='url'){
				header('Location: '.Plugin::getSetting('url_page', 'maintenance'));
			}else{
				header('HTTP/1.0 503 Service unavailable');
				header('Status: 503 Service unavailable');
				$page->_executeLayout();
				exit();
			}
		}else{
			return CURRENT_URI;
		}
	}