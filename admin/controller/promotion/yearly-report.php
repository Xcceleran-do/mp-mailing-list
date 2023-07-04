<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_mail_metas
 * @subpackage Mp_mail_metas/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_mail_metas
 * @subpackage Mp_mail_metas/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_mail_yearly_report_list_Admin
{

    // Add submenu page
function yearly_report_submenu_page() {
    add_submenu_page(
      'edit.php?post_type=mp_mail_promotions',
      'Yearly report',
      'Yearly report',
      'manage_options',
      'Yearly report',
      array($this, 'yearly_report_submenu_callback')
    );
  }
  
  // Callback function for submenu page
  function yearly_report_submenu_callback() {

    $currentYear = date('Y');
    
    
      include_once mp_mails_PLAGIN_DIR . 'admin/partials/promotion/yearly_report.php';
        
}
  
}
