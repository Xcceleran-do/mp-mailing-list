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
class Mp_mail_sent_report_Admin
{


  // Add custom column to dashboard for custom post type
function mp_mail_promotions_sent_to_column($columns) {
    // Add your custom column
    $columns['sent_to_column'] = 'Sent To';
    return $columns;
}

// Populate custom column with data
function mp_mail_promotions_sent_to_column_content($column, $post_id) {
    // Display data for the custom column
    if ($column === 'sent_to_column') {
        // Add your custom code here to populate the column with data
        // echo 'Custom Column Content';

        $sent_to = get_post_meta( $post_id, 'sent_promo_email', true);

        $reports_url = admin_url('edit.php?post_type=mp_mail_promotions&page=mp_mail_promotions_report&post='.$post_id);
        echo $sent_to ? '<a href="' . esc_url($reports_url) . '">'.count($sent_to) . " Subscribers</a>" : "Not Sent";

    }
}

    // Add submenu page
    function posts_catalog_report_page() {
        add_menu_page(
            'Reports', // Page Title
            'Reports', // Menu Title
            'manage_options', // Capability required to access the page
            'mp_mail_promotions_report', // Unique Menu Slug
            array($this, 'mp_mail_promotions_reports_callback'), // Callback function to display the page content
            'dashicons-chart-bar', // Icon (optional)
            25 // Position in the menu (optional)
        );
      }
      
      // Callback function for submenu page
      function mp_mail_promotions_reports_callback() {
    
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;

    $sent_to = get_post_meta( $post_id, 'sent_promo_email', true);

        // Prepare pagination
        $per_page = 10; // Number of reports to display per page
        $total_items = count($sent_to);
        $total_pages = ceil($total_items / $per_page);
    
        $current_page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
        $start = ($current_page - 1) * $per_page;
        $end = $start + $per_page;
        $reports_slice = array_slice($sent_to, $start, $per_page);
    
          include_once mp_mails_PLAGIN_DIR . 'admin/partials/promotion/reports.php';
            
    }



}
