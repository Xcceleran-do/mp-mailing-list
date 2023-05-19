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
class Mp_mail_send_Admin
{

  // Add status change event to custom post type
  function mp_mail_promotions_status_change_event($new_status, $old_status, $post)
  {
    // Check if the post type is "mp_mail_promotions"
    if ($post->post_type === 'mp_mail_promotions') {
        // Perform actions based on the status change
        if ($new_status === 'publish' && $old_status !== 'publish') {
        // Status changed to "publish" from any other status
        // Add your custom code here

        $subscribers = get_users(array(
            'meta_query' => array(
            array(
                'key' => 'mp_gl_notify_weekly',
                'value' => "true",
                'compare' => '=='
            )
            )
        ));
                
            // Create an array to store the user IDs
            $userIds = array();

            // Extract the user IDs from the retrieved user objects
            foreach ($subscribers as $user) {
                $userIds[] = array("id"=>$user->ID, "email"=>$user->user_email, 'status' => 1);
            }
            
            $success = count($userIds); // temporary for now
            $sentEmails = array("success" => $success, 'all' => $userIds);
            
            update_post_meta( $post->ID, 'sent_promo_email', $sentEmails );
        }
    }
  }


}
