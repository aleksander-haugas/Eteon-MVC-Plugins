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

// Security measure.
if ( !defined('IN_CMS') ) { exit();}

// Store settings.
$settings = Plugin::getAllSettings('suneditor');

$settings = array('file_manager' => isset($settings['file_manager']) ? $settings['file_manager'] : '0', );

Plugin::setAllSettings($settings, 'suneditor');
//flash message
if (Plugin::setAllSettings($settings, 'suneditor')) {
    Flash::set('success', 'suneditor - '.__('plugin settings initialized.'));
}
else {
    Flash::set('error', 'suneditor - '.__('unable to store plugin settings!'));
}
