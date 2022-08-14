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
	    'id'          			=> 'archive',
	    'title'       			=> __('Archive'),
	    'description' 			=> __('Provides an Archive pagetype behaving similar to a blog or news archive.'),
	   	'version'     			=> '1.1.0',
		'license' 				=> 'GPLv3',
		'author' 				=> 'AirZox Technologies (Eteon MVC)',
		'require_eteon_version' => '0.9.4+',
		'website'               => 'https://eteon.airzox.com/',
		'update_url'			=> 'https://airzox.com/airzox-plugins.xml'
	));

	// Add the plugin's tab and controller
	Plugin::addController('archive', '', 'admin_view', false);

	Behavior::add('archive', 'archive/archive.php');
	Behavior::add('archive_day_index', 'archive/archive.php');
	Behavior::add('archive_month_index', 'archive/archive.php');
	Behavior::add('archive_year_index', 'archive/archive.php');
