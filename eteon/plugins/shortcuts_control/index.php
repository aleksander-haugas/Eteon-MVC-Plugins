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

	Plugin::setInfos(array(
	    'id'          			=> 'shortcuts_control',
	    'title'       			=> __('Keyboard shortcuts'),
	    'description' 			=> __('Supports "Ctrl-S" keystroke to save form and continue editing.'),
	   	'version'     			=> '1.0.0',
		'license' 				=> 'GPLv3',
		'author' 				=> 'AirZox Technologies (Eteon MVC)',
		'require_eteon_version' => '0.9.4+',
		'website'               => 'https://eteon.airzox.com/',
		'update_url'			=> 'https://airzox.com/airzox-plugins.xml',
		'type'					=> 'backend'
	));

	// Check if the plugin is enabled
	if ( Plugin::isEnabled('shortcuts_control') ) {

		// Add the plugin's tab and controller
		Plugin::addController('shortcuts_control', '', 'admin_view', false);
	}