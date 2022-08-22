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
	    'id'          			=> 'syntax_highlighting',
	    'title'       			=> __('Syntax highlighting'),
	    'description' 			=> __('Accepts the code to highlight (string) and a list of options (object).'),
	   	'version'     			=> '1.0.0',
		'license' 				=> 'BSDv3',
		'author' 				=> 'AirZox Technologies (Eteon MVC)',
		'require_eteon_version' => '0.9.4+',
		'website'               => 'https://eteon.airzox.com/',
		'update_url'			=> 'https://airzox.com/airzox-plugins.xml'
	));

	// Check if the plugin is enabled
	if ( Plugin::isEnabled('syntax_highlighting') ) {
		// Add the plugin's tab and controller
		Plugin::addController('syntax_highlighting', '', 'admin_view', false);
		Plugin::addJavascript('syntax_highlighting', 'highlightingInit.js');
		//Plugin::addStylesheet('syntax_highlighting', 'styles/base16/zenburn.min.css');
	}
