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
 * CodeMirror plugin for Eteon MVC
 *
 * @package Plugins
 * @subpackage codemirror
 *
 */

Plugin::setInfos(array(
    'id'          			=> 'simplemde',
    'title'       			=> __('SimpleMDE - Markdown Editor'),
    'description' 			=> __('A simple, beautiful, and embeddable JavaScript Markdown editor. Delightful editing for beginners and experts alike. Features built-in autosaving and spell checking.'),
    'version'     			=> '0.1.1',
    'license' 				=> 'MIT',
    'author' 				=> 'AirZox Technologies (Eteon MVC)',
    'website'               => 'https://airzox.com/',
    'update_url'			=> 'https://airzox.com/airzox-plugins.xml',
    'require_eteon_version' => '0.9.4+'
));

if ( Plugin::isEnabled('simplemde') ) {

    Plugin::addController('simplemde', null, 'admin_view', false);
    Filter::add('simplemde', 'simplemde/filter_simplemde.php');

    $uri = $_SERVER['QUERY_STRING'];
    if ( preg_match('/(\/plugin\/simplemde|page\/edit|snippet\/edit|layout\/edit|page\/add|snippet\/add|layout\/add)/', $uri, $match) ) {
        Plugin::addJavascript('simplemde', 'simplemde/dist/simplemde.min.js');
    }
}