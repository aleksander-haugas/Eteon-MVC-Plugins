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
 
class CodemirrorController extends PluginController {

    public function __construct() {
		parent::__construct();
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/codemirror/views/sidebar'));
    }

    public function index() {
		$this->settings();
    }

    public function settings() {
        $this->display('codemirror/views/settings', Plugin::getAllSettings('codemirror'));
    }
    
    public function save() {
        if (!array_key_exists('cmintegrate', $_POST))
			$cmintegrate = '0';
		else
			$cmintegrate = '1';            
            
		$settings = array('file_manager' => $cmintegrate);
		if (Plugin::setAllSettings($settings, 'codemirror'))
			Flash::set('success', 'CodeMirror - '.__('plugin settings saved.'));
		else
			Flash::set('error', 'CodeMirror - '.__('plugin settings not saved!'));
		
		redirect(get_url('plugin/codemirror/settings'));        
	}
	
	public function cm_integrate()
	{
		if (Plugin::getSetting('file_manager','codemirror') === '1')
		{
			echo '1';
		} else {
			echo '0';
		}
	}

}
