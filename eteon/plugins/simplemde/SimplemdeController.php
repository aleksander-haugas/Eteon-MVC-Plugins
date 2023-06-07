<?php

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * The main controller for the Markdown plugin.
 */
class SimplemdeController extends PluginController {

    public function __construct() { }

    public function preview() {
        require_once('classSimplemde.php');
        $markdown = new Markdown_Parser();
        echo xssClean($markdown->transform($_POST['data']));
    }
}
