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

	if (!defined('IN_CMS')) { exit(); }

    AuthUser::load();
    // Check if the user is logged in
    if (!AuthUser::isLoggedIn()) {
        // Redirect to the login page
        redirect(get_url('login'));

        // check if the user have permissions to edit admin section
    } else if (!AuthUser::hasPermission('admin_edit')) {
        Flash::set('error', __('You do not have permission to activate or use this plugin!'));
        Plugin::deactivate('codemirror');
        redirect(get_url());
    } else {
        // Success message
        Flash::set('success', __('Successfully activated :name plugin!', array(':name' => __('CodeMirror syntax highlighter'))));

        $settings = Plugin::getAllSettings('codemirror');
        // Store settings new style
        $settings = array('file_manager' => $settings['file_manager'] ?? '0', );
        Plugin::setAllSettings($settings, 'codemirror');
    }
    exit();