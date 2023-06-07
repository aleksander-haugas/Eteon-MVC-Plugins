<?php
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
		'id'          			=> 'codemirror',
		'title'       			=> __('CodeMirror syntax highlighter'),
		'description' 			=> __('Provides syntax highlighter using CodeMirror for backend.'),
		'version'     			=> '1.0.4',
		'license' 				=> 'MIT',
		'author' 				=> 'AirZox Technologies (Eteon MVC)',
		'website'               => 'https://airzox.com/',
		'update_url'			=> 'https://airzox.com/airzox-plugins.xml',
		'require_eteon_version' => '0.9.4+'
	));

	Plugin::addController('codemirror', 'codemirror', 'administrator,developer', false);
	Filter::add('codemirror', 'codemirror/filter_codemirror.php');

	// compression using https://github.com/mishoo/UglifyJS
	// codemirror.js, xml.js, javascript.js, css.js, htmlmixed.js,  clike.js, php,js, markdown.js
	Plugin::addJavascript('codemirror', 'codemirror/lib/codemirror.js');
	Plugin::addJavascript('codemirror', 'codemirror/addon/edit/matchbrackets.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/selection/active-line.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/hint/show-hint.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/hint/anyword-hint.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/hint/jshint.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/lint/lint.js');
    //Plugin::addJavascript('codemirror', 'codemirror/addon/lint/php-lint.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/lint/javascript-lint.js');
    Plugin::addJavascript('codemirror', 'codemirror/addon/lint/javascript-hint.js');
	Plugin::addJavascript('codemirror', 'codemirror/mode/javascript/javascript.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/htmlmixed/htmlmixed.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/css/css.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/xml/xml.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/php/php.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/markdown/markdown.js');
    Plugin::addJavascript('codemirror', 'codemirror/mode/clike/clike.js');

