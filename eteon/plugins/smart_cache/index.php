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
        'id' 					=> 'smart_cache',
        'title' 				=> 'Smart Cache',
        'description' 			=> 'Enables smart caching, making your site ultra fast.',
        'version' 				=> '0.4.1',
        'license' 				=> 'MIT',
        'author' 				=> 'Eteon Core Team',
        'require_eteon_version' 	=> '0.9.4+',
        'website'               => 'http://eteon.airzox.com/',
        'update_url'			=> 'https://airzox.com/airzox-plugins.xml'
    ));

    AutoLoader::addFolder(PLUGINS_ROOT.'/smart_cache/models');

    /* Stuff for backend. */
    if (defined('CMS_BACKEND')) {

        AutoLoader::addFolder(dirname(__FILE__).'/lib');
        Plugin::addController('smart_cache', __('Cache'), "admin_edit", true);

        #Observer::observe('page_edit_after_save',   'smart_cache_delete_one');
        Observer::observe('page_edit_after_save', 'smart_cache_delete_all');
        Observer::observe('page_add_after_save', 'smart_cache_delete_all');
        Observer::observe('page_delete', 'smart_cache_delete_all');
        Observer::observe('view_page_edit_plugins', 'smart_cache_display_dropdown');

        Observer::observe('comment_after_add', 'smart_cache_delete_all');
        Observer::observe('comment_after_edit', 'smart_cache_delete_all');
        Observer::observe('comment_after_delete', 'smart_cache_delete_all');
        Observer::observe('comment_after_approve', 'smart_cache_delete_all');
        Observer::observe('comment_after_unapprove', 'smart_cache_delete_all');

        Observer::observe('layout_after_edit', 'smart_cache_delete_all');
        Observer::observe('snippet_after_edit', 'smart_cache_delete_all');

        /* TODO Fix this to work with configurable cache folder. */
        function smart_cache_on_page_saved($page) {
            $status = SmartCachePage::NONE;
            $input = $_POST['page'];

            if (isset($input['smart_cache_enabled']) && is_int((int)$input['smart_cache_enabled']))
            $status = $input['smart_cache_enabled'];

            Record::update('Page', array('smart_cache_enabled' => $status), 'id = ?', array($page->id));
        }

        function smart_cache_delete_one($page) {
            $data['url'] = '/'.$page->getUri().URL_SUFFIX;
            if (($cache = SmartCachePage::findOneFrom('SmartCachePage', 'url=?', array($data['url'])))) {
                $cache->delete();
            }
        }

        function smart_cache_delete_all() {
            $cache = SmartCachePage::findAllFrom('SmartCachePage');
            foreach ($cache as $page) {
                $page->delete();
            }
            $message = sprintf('Cache was automatically cleared.');
            Observer::notify('log_event', $message, 'smart_cache', 7);
        }

        /**
        * Allows for a dropdown box with smart cache status on the edit page view in the backend.
        *
        * @param Page $page The object instance for the page that is being edited.
        */
        function smart_cache_display_dropdown(&$page) {
            echo '<p><label for="page_smart_cache_enabled" class="w3-text-grey">'.__('Should cache').'</label><select id="page_smart_cache_enabled" name="page[smart_cache_enabled]" class="w3-input w3-border w3-hover-light-gray">';
            echo '<option value="'.SmartCachePage::NONE.'"'.($page->smart_cache_enabled == SmartCachePage::NONE ? ' selected="selected"': '').'>&#8212; '.__('none').' &#8212;</option>';
            echo '<option value="'.SmartCachePage::OPEN.'"'.($page->smart_cache_enabled == SmartCachePage::OPEN ? ' selected="selected"': '').'>'.__('No').'</option>';
            echo '<option value="'.SmartCachePage::CLOSED.'"'.($page->smart_cache_enabled == SmartCachePage::CLOSED ? ' selected="selected"': '').'>'.__('Yes').'</option>';
            echo '</select></p>';
        }

    } else {
        /* Stuff for frontend. */

        Observer::observe('page_found', 'smart_cache_create');
        //Observer::observe('page_requested', 'smart_cache_debug');


        function smart_cache_debug($page) {
            if (DEBUG) {
                print "Cache miss... ";
            }
        }


        function smart_cache_create($page) {
            if ($page->smart_cache_enabled) {
                $data['url'] = BASE_URI.CURRENT_URI.URL_SUFFIX;

                // Correct URL for frontpage - should become index.html
                if ($data['url'] == BASE_URI.URL_SUFFIX) {
                    $data['url'] = BASE_URI.'index'.smart_cache_suffix();
                }
                
                $data['url'] = smart_cache_folder().$data['url'];
                $data['url'] = preg_replace('#//#', '/', $data['url']);
                $data['page'] = $page;

                if (!($cache = SmartCachePage::findOneFrom('SmartCachePage', 'url=?', array($data['url'])))) {
                    $cache = new SmartCachePage($data);
                }
                
                $cache->page = $page;
                $cache->save();
            }
        }

    }

    function smart_cache_suffix() {
        return Plugin::getSetting('smart_cache_suffix', 'smart_cache');
    }

    function smart_cache_by_default() {
        return Plugin::getSetting('smart_cache_by_default', 'smart_cache');
    }

    function smart_cache_folder() {
        $folder = '/'.Plugin::getSetting('smart_cache_folder', 'smart_cache').'/';
        $folder = preg_replace('#//*#', '/', $folder);
        return $folder;
    }

    function smart_cache_folder_is_root() {
        return '/' == smart_cache_folder();
    }
