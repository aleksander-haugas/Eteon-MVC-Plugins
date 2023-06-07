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

  /* Security measure */
  if (!defined('IN_CMS')) { exit(); } 

	AuthUser::load();
	// Check if the iuser is logged in
	if (!AuthUser::isLoggedIn()) {
		// Redirect to the login page
		redirect(get_url('login'));
  
	// check if the user have permissions to edit admin section
	} else if (!AuthUser::hasPermission('admin_edit')) {
		Flash::set('error', __('You do not have permission to activate or use this plugin!'));
		Plugin::deactivate('maintenance');
		redirect(get_url());
	} else {
		// Success message
		Flash::set('success', __('Successfully activated :name plugin!', array(':name' => 'maintenance')));
		

    /* exceptions */
    $PDO = Record::getConnection();
    $driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));
    $PDO->exec("ALTER TABLE ".TABLE_PREFIX."page ADD maintenance integer NOT NULL DEFAULT 0");

    /* settings */
    $settings = array('ver' => '0.0.9',
      'users_array' => '1',
      'status' => 'off',
      'redirect_page' => 'url',
      'url_page' => 'http://www.example.com/',
      'backdoor_key' => '876hTgd-gGfd8757',
      'backdoor_key_session' => 'off',
      'global_ip' => '0.0.0.0'
    );

		Plugin::setAllSettings($settings, 'maintenance');
	}
	exit();