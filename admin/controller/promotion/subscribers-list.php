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
class Mp_mail_subscribers_list_Admin
{

    // Add submenu page
function posts_catalog_submenu_page() {
    add_submenu_page(
      'edit.php?post_type=mp_mail_promotions',
      'Subscribers',
      'Subscribers',
      'manage_options',
      'subscribers',
      array($this, 'posts_catalog_submenu_callback')
    );
  }
  
  // Callback function for submenu page
  function posts_catalog_submenu_callback() {

    // Handle search form submission
    if (isset($_POST['submit'])) {
        $filter_by = isset($_POST['filter_by']) ? sanitize_text_field($_POST['filter_by']) : '';
    } else {
        $filter_by = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : 'mp_gl_notify_weekly';
    }
    $subscribers = get_users( array(
        'meta_query' => array(
            array(
                'key' => $filter_by,
                'value' => "true",
                'compare' => '=='
            )
        )
            ));
        
    // mp_gl_notify_mp_updates, mp_gl_notify_weekly


    // // Filter subscribers based on search term
    // $filtered_subscribers = array_filter($subscribers, function ($subscriber) use ($search) {
    //     return empty($search) || stripos($subscriber->email, $search) !== false;
    // });

    // Prepare pagination
    $per_page = 10; // Number of subscribers to display per page
    $total_items = count($subscribers);
    $total_pages = ceil($total_items / $per_page);

    $current_page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    $start = ($current_page - 1) * $per_page;
    $end = $start + $per_page;
    $subscribers_slice = array_slice($subscribers, $start, $per_page);

    $mail_promo_types = get_terms(array(
        'taxonomy' => 'mp_mail_promo_types',
        'hide_empty' => false,
    ));
    
    
      include_once mp_mails_PLAGIN_DIR . 'admin/partials/promotion/subscribers.php';
        
}
  
}
