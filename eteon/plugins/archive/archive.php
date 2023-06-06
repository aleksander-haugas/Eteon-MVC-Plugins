<?php
/**
 * Eteon MVC plugin "archive" main file, responsible for initiating the plugin.
 *
 * @package archive
 * @author AirZox Technologies (Eteon MVC)
 * @version 1.1.0
 *
 * Plugin Name: archive
 * Plugin URI: https://eteon.airzox.com/plugins/archive
 * Description: Provides an Archive pagetype behaving similar to a blog or news archive.
 * Version: 1.1.0
 * Requires at least: 0.9.4+
 * Requires PHP: 7.4
 * Author: AirZox Technologies (Eteon MVC)
 * Author URI: https://eteon.airzox.com/
 * Author email: info@eteon.airzox.com
 * License: GPL 2
 * Donate URI: https://eteon.airzox.com/donate/
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * The Archive class...
 */
class Archive {

    public function __construct(&$page, $params) {
        $this->page = & $page;
        $this->params = $params;

        switch (count($params)) {
            case 0: break;
            case 1:
                if (strlen((int) $params[0]) == 4)
                    $this->_archiveBy('year', $params);
                else
                    $this->_displayPage($params[0]);
                break;

            case 2:
                $this->_archiveBy('month', $params);
                break;

            case 3:
                $this->_archiveBy('day', $params);
                break;

            case 4:
                $this->_displayPage($params[3]);
                break;

            default:
                pageNotFound();
        }
    }

    private function _archiveBy($interval, $params) {
        $this->interval = $interval;

        $page = $this->page->children(array(
                    'where' => "behavior_id = 'archive_{$interval}_index'",
                    'limit' => 1
                        ), array(), true);

        if ($page instanceof Page) {
            $this->page = $page;
            $month = isset($params[1]) ? (int) $params[1] : 1;
            $day = isset($params[2]) ? (int) $params[2] : 1;

            $this->page->time = mktime(0, 0, 0, $month, $day, (int) $params[0]);
        } else {
            pageNotFound();
        }
    }

    private function _displayPage($slug) {
        if (!$this->page = Page::findBySlug($slug, $this->page, true))
            pageNotFound($slug);
    }

    function get() {
        // Make sure params are numeric
        foreach ($this->params as $param) {
            if (!is_numeric($param)) {
                // TODO replace by decent error message
                pageNotFound();
            }
        }
        
        $date = join('-', $this->params);

        $pages = $this->page->parent()->children(array(
                    'where' => 'page.created_on LIKE :date',
                    'order' => 'page.created_on DESC'
                ), array(':date' => ''.$date.'%'));

        return $pages;
    }

    function archivesByYear() {
      $tablename = TABLE_PREFIX.'page';

      $out = array();

      $res = Record::find(array(
                  'select' => "DISTINCT(DATE_FORMAT(created_on, '%Y')) AS date",
                  'from' => $tablename,
                  'where' => 'parent_id = :parent_id AND status_id != :status',
                  'order_by' => 'created_on DESC',
                  'values' => array(':parent_id' => $this->page->id, ':status' => Page::STATUS_HIDDEN )
                ));

      foreach($res as $r) {
        $out[] = $r->date;
      }

      return $out;
    }

    function archivesByMonth($year='all') {
        $tablename = TABLE_PREFIX.'page';

        $out = array();

        $res = Record::find(array(
                    'select' => "DISTINCT(DATE_FORMAT(created_on, '%Y/%m')) AS date",
                    'from' => $tablename,
                    'where' => 'parent_id = :parent_id AND status_id != :status',
                    'order_by' => 'created_on DESC',
                    'values' => array(':parent_id' => $this->page->id, ':status' => Page::STATUS_HIDDEN )
                  ));

        foreach($res as $r) {
          $out[] = $r->date;
        }

        return $out;
    }

    function archivesByDay($year='all') {
      $tablename = TABLE_PREFIX.'page';

      $out = array();

      $res = Record::find(array(
                  'select' => "DISTINCT(DATE_FORMAT(created_on, '%Y/%m/%d')) AS date",
                  'from' => $tablename,
                  'where' => 'parent_id = :parent_id AND status_id != :status',
                  'order_by' => 'created_on DESC',
                  'values' => array(':parent_id' => $this->page->id, ':status' => Page::STATUS_HIDDEN )
                ));

      foreach($res as $r) {
        $out[] = $r->date;
      }

      return $out;
    }

}

class PageArchive extends Page {

    /**
     * Returns the current PageArchive object's url.
     *
     * Note: overrides the Page::url() method.
     *
     * @return string   A fully qualified url.
     */
    public function url($suffix=false) {
        $use_date = Plugin::getSetting('use_dates', 'archive');
        if ($use_date === '1') {
            return BASE_URL . trim($this->parent()->path() . date('/Y/m/d/', strtotime($this->created_on)) . $this->slug, '/') . ($this->path() != '' ? URL_SUFFIX : '');
        }
        elseif ($use_date === '0') {
            return BASE_URL . trim($this->parent()->path() . '/' . $this->slug, '/') . ($this->path() != '' ? URL_SUFFIX : '');
        }
    }

    public function title() {
        return isset($this->time) ? strftime($this->title, $this->time) : $this->title;
    }

    public function breadcrumb() {
        return isset($this->time) ? strftime($this->breadcrumb, $this->time) : $this->breadcrumb;
    }

}