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

	/* Security measure */
	if (!defined('IN_CMS')) { exit(); }

$PDO = Record::getConnection();

$cache = Record::findAllFrom('SmartCachePage');
foreach ($cache as $page) {
    $page->delete();
}

Plugin::deleteAllSettings('smart_cache');

$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));

$table = TABLE_PREFIX . "page";

if (("mysql" == $driver) || ("sqlite" == $driver)) {
    $PDO->exec("ALTER TABLE $table
                DROP COLUMN 'smart_cache_enabled'");
}

if ("pgsql" == $driver) {
    $PDO->exec("ALTER TABLE $table
                DROP COLUMN smart_cache_enabled");
}

$table = TABLE_PREFIX . "smart_cache_page";
$PDO->exec("DROP TABLE $table");
