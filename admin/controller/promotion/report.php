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
        echo $sent_to ? count($sent_to) : 0;

    }
}



}
