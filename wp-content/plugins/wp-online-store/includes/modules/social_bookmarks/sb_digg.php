<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class sb_digg {
    var $code = 'sb_digg';
    var $title;
    var $description;
    var $sort_order;
    var $icon = 'digg.png';
    var $enabled = false;

    function sb_digg() {
      $this->title = MODULE_SOCIAL_BOOKMARKS_DIGG_TITLE;
      $this->public_title = MODULE_SOCIAL_BOOKMARKS_DIGG_PUBLIC_TITLE;
      $this->description = MODULE_SOCIAL_BOOKMARKS_DIGG_DESCRIPTION;

      if ( defined('MODULE_SOCIAL_BOOKMARKS_DIGG_STATUS') ) {
        $this->sort_order = MODULE_SOCIAL_BOOKMARKS_DIGG_SORT_ORDER;
        $this->enabled = (MODULE_SOCIAL_BOOKMARKS_DIGG_STATUS == 'True');
      }
    }

    function getOutput() {
      global $HTTP_GET_VARS;

      return '<a href="http://digg.com/submit?url=' . urlencode(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL', false)) . '" target="_blank"><img src="'.HTTP_SERVER.DIR_WS_HTTP_CATALOG.'images/social_bookmarks/' . $this->icon . '" border="0" title="' . tep_output_string_protected($this->public_title) . '" alt="' . tep_output_string_protected($this->public_title) . '"/></a>';
    }

    function isEnabled() {
      return $this->enabled;
    }

    function getIcon() {
      return $this->icon;
    }

    function getPublicTitle() {
      return $this->public_title;
    }

    function check() {
      return defined('MODULE_SOCIAL_BOOKMARKS_DIGG_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Digg Module', 'MODULE_SOCIAL_BOOKMARKS_DIGG_STATUS', 'True', 'Do you want to allow products to be shared through Digg?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_DIGG_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SOCIAL_BOOKMARKS_DIGG_STATUS', 'MODULE_SOCIAL_BOOKMARKS_DIGG_SORT_ORDER');
    }
  }
?>
