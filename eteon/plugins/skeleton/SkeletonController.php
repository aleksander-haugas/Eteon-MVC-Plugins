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

/**
 * Use this SkeletonController and this skeleton plugin as the basis for your
 * new plugins if you want.
 */
class SkeletonController extends PluginController {

    public function __construct() {
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/skeleton/views/sidebar'));
    }

    public function index() {
        $this->documentation();
    }

    public function documentation() {
        $this->display('skeleton/views/documentation');
    }

    function settings() {
        /** You can do this...
        $tmp = Plugin::getAllSettings('skeleton');
        $settings = array('my_setting1' => $tmp['setting1'],
                          'setting2' => $tmp['setting2'],
                          'a_setting3' => $tmp['setting3']
                         );
        $this->display('comment/views/settings', $settings);
         *
         * Or even this...
         */

        $this->display('skeleton/views/settings', Plugin::getAllSettings('skeleton'));
    }
}