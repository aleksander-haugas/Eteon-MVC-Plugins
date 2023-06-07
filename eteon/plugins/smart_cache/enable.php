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


	$settings = Plugin::getAllSettings('smart_cache');

	$settings = array(
	    'smart_cache_by_default' => 1,
	    'smart_cache_suffix' => '.html',
	    'smart_cache_folder' => '/cache/'
	);

	Plugin::setAllSettings($settings, 'smart_cache');
	//flash message
	if (Plugin::setAllSettings($settings, 'smart_cache')) {
		Flash::set('success', 'smart_cache - '.__('plugin settings initialized.'));
	}
	else {
		Flash::set('error', 'smart_cache - '.__('unable to store plugin settings!'));
	}
 
	$PDO = Record::getConnection();                    
	$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));

	$table = TABLE_PREFIX . "page";

	if (("mysql" == $driver) || ("sqlite" == $driver)) { $PDO->exec("ALTER TABLE $table ADD smart_cache_enabled tinyint(1) NOT NULL default 1"); }
	if ("pgsql" == $driver) { $PDO->exec("ALTER TABLE $table ADD smart_cache_enabled boolean NOT NULL default true"); }

	$table = TABLE_PREFIX . "smart_cache_page";

	if ("mysql" == $driver) {
	    $PDO->exec("CREATE TABLE $table (
		        id int(11) NOT NULL auto_increment,
		        url varchar(255) default NULL,
		        created_on datetime default NULL,
		        PRIMARY KEY (id),
		        UNIQUE (url)
		        ) DEFAULT CHARSET=utf8");  }

	if ("sqlite" == $driver) {
	    $PDO->exec("CREATE TABLE $table (
		        id INTEGER NOT NULL PRIMARY KEY,
		        url varchar(255) default NULL,
		        created_on datetime default NULL,
		        UNIQUE (url)
		        )");    
	}

	if ("pgsql" == $driver) {
	    $PDO->exec("CREATE TABLE $table (
		        id SERIAL PRIMARY KEY,
		        url varchar(255) default NULL,
		        created_on timestamp default NULL,
		        UNIQUE (url)
		        )");
	}
