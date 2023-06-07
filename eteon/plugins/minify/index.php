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

	if (!defined('IN_CMS')) { exit(); }

	Plugin::setInfos(array(
		'id'          => 'minify',
		'title'       => __('Minify'),
		'description' => __('Minifies and combines JavaScript and CSS'), 
		'version'     => '0.0.1',
		'license'     => 'MIT',
		'author'      => 'AirZox Technologies (Eteon MVC)',
		'website'     => 'https://eteon.airzox.com/',
		'update_url'  => 'https://www.airzox.com/airzox-plugins.xml'
	));

	AutoLoader::addFolder(dirname(__FILE__) . '/lib');

	Plugin::addController('minify', 'Minify', '', false);