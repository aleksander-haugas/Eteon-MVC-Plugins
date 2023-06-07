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

	if (Plugin::deleteAllSettings('comment') === false) {
		Flash::set('error', __('Unable to delete plugin settings.'));
		redirect(get_url('setting'));
	}

	$PDO = Record::getConnection();

	if ($PDO->exec('DROP TABLE IF EXISTS '.TABLE_PREFIX.'comment') === false) {
		Flash::set('error', __('Unable to drop table :tablename', array(':tablename' => TABLE_PREFIX.'comment')));
		redirect(get_url('setting'));
	}

	$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));
	$ret = true;

	if ($driver == 'mysql' || $driver == 'pgsql') {
		$ret = $PDO->exec('ALTER TABLE '.TABLE_PREFIX.'page DROP comment_status');
	}
	else if ($driver == 'sqlite') {
		// Removing the indexes
		$ret = $PDO->exec('DROP INDEX IF EXISTS '.TABLE_PREFIX.'comment.comment_page_id');
		if ($ret === false) break;
		$ret = $PDO->exec('DROP INDEX IF EXISTS '.TABLE_PREFIX.'comment.comment_created_on');
		if ($ret === false) break;

		/*
		* Unfortunately, SQLite does not support removing colums from a table.
		* http://sqlite.org/lang_altertable.html
		*
		$ret = $PDO->exec('ALTER TABLE '.TABLE_PREFIX.'page DROP comment_status');
		if ($ret === false) break;
		*
		*/

		// Lastly, clean up database space by issueing the VACUUM command
		$ret = $PDO->exec('VACUUM');
	}

	if ($ret === false) {
		Flash::set('error', __('Unable to clean up table alterations.'));
		redirect(get_url('setting'));
	}
	else {
		Flash::set('success', __('Successfully uninstalled plugin.'));
		redirect(get_url('setting'));
	}