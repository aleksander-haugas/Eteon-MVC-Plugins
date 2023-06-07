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

class SmartCachePage extends Record {
    const TABLE_NAME = 'smart_cache_page';
    const NONE = 0;
    const OPEN = 1;
    const CLOSED = 2;

    public $url;
    public $created_on;
    public $page;


    public function getColumns() {
        return array('url', 'created_on');
    }


    public function publicUrl() {
        $folder = Setting::get('smart_cache_folder').'/';
        $folder = preg_replace('#//*#', '/', $folder);
        $folder = preg_replace('#^/#', '', $folder);
        return str_replace($folder, '', $this->url);
    }


    public function beforeSave() {
        $this->created_on = date('Y-m-d H:i:s');
        /* If directories do not exist create them. */
        $parts = explode('/', $this->path());
        $file = array_pop($parts);

        /* If deep link create directories when needed. */
        $dir = '';
        foreach ($parts as $part) {
            if (!is_dir($dir .= "/$part")) {
                mkdir($dir);
            }
        }
        /* Fix case when articles.html is created before articles/ */
        /* TODO This still creates on extra directory in the end.  */
        if (('archive' == $this->page->behavior_id) || ($this->page instanceof PageArchive)) {
            $dir .= '/'.basename($file, smart_cache_suffix());
            if (!is_dir($dir)) {
                mkdir($dir);
            }
        }
        return file_put_contents($this->path(), $this->content(), LOCK_EX);
    }


    public function beforeDelete() {
        return @unlink($this->path());
    }


    public function path() {
        return realpath(CMS_ROOT).$this->url;
    }


    public function content() {
        ob_start();
        $this->page->_executeLayout();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}

