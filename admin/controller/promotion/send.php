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

            $email_type_slugs = array();
            $taxonomy = 'mp_mail_promo_types'; // Replace with your custom taxonomy slug
            $terms = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'slugs'));

            if (!is_wp_error($terms)) {
                // Loop through the slugs and display or use them as needed
                foreach ($terms as $slug) {
                    $email_type_slugs[] = $slug;

                }
            }

            $meta_query = array(
                'relation' => 'OR',
            );

            foreach ($email_type_slugs as $email_type_slug) {
                $meta_query[] = array(
                    'key' => $email_type_slug,
                    'value' => 'true',
                    'compare' => '==',
                );
            }

            $subscribers = get_users(array(
                'meta_query' => $meta_query,
            ));

            self::ses_send_email("test subject", "Test body", $subscribers, "editor@mindplex.ai", "EmailTracking", 1);
            

            // Create an array to store the user IDs
            $userIds = array();

    //         // Extract the user IDs from the retrieved user objects
    //         foreach ($subscribers as $user) {


    //         // $taxonomy = 'mp_mail_promo_temp_types'; // Replace with your custom taxonomy slug
    //         // $terms = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    //         // if(count($terms))
    //         // {
    //         //     $templete_id = $terms[0];

    //         //     $before_content = get_term_meta($templete_id, 'mp_mail_template_before_content', true);
    //         //     $after_content = get_term_meta($templete_id, 'mp_mail_template_after_content', true);
       
    //         //     $tracker = '<img src="'.get_rest_url( null, 'mp_mails/v1/view-tracker/'.$user->user_login.'/'.$post->ID ).'" width="1" height="1" alt="Tracking Pixel" style="display: none;">';
    //         //     $email_content = $before_content . $tracker . $post->post_content . $after_content.'</body></html>';

    //         //     $headers = array('Content-Type: text/html; charset=UTF-8');
    //         //     $is_sent = wp_mail($user->user_email, $post->post_title, $email_content, $headers);
    //         //     // $is_sent = 1;

    //         //     $userIds[] = array("id"=>$user->ID, "email"=>$user->user_email, 'username' => $user->user_login, 'status' => $is_sent, 'has_opened' => 0, 'opened_at' => null);
    //         // }

    //         $tracker = '<img src="'.get_rest_url( null, 'mp_mails/v1/view-tracker/'.$user->user_login.'/'.$post->ID ).'" width="1" height="1" alt="Tracking Pixel" style="display: none;">';
    //         $email_content = $tracker . $post->post_content;


    //   include_once mp_mails_PLAGIN_DIR . '/email_templete/templetes.php';
    //   $Mp_mails_templetes = new Mp_mails_templetes();
    //   $bodyReplacements['body1'] = $post->post_title;
    //   $bodyReplacements['body2'] = $user->user_login;
    //   $bodyReplacements['body3'] = $email_content;
    //   $Mp_mails_templetes->template2($user->user_email, 'promotional-email-template', [], $bodyReplacements);


    //         $userIds[] = array("id"=>$user->ID, "email"=>$user->user_email, 'username' => $user->user_login, 'status' => $is_sent, 'has_opened' => 0, 'opened_at' => null);


    //         }
            
            $success = count($userIds); // temporary for now
            $sentEmails = array("success" => $success, 'all' => $userIds);
            
            update_post_meta( $post->ID, 'sent_promo_email', $sentEmails );
        }
    }
  }

  function ses_send_email($subject, $body, $subscribers, $sender, $configuration_set_name, $mailing_group_id)
  {

	  $aws_push_notification_api = "https://2uoezpjgxtjyvpw7rxytoi4rtu0tvaob.lambda-url.us-east-1.on.aws/";

    //   "post_author" => get_user_meta($post_author_id, 'first_name', true),
    //   "interacter" => get_user_meta($interacter_id, 'first_name', true),
	  $json_data = array( 
		"sender" => $sender,
		"configuration_set_name" => $configuration_set_name,
		"subject" => $subject,
		"body" => $body,
		"mailing_group_id" => $mailing_group_id,
		"subscribers" => $subscribers
		  );
  
	  wp_remote_post(
		$aws_push_notification_api,
		array(
		  'timeout' => 10,
		  'headers' => array(
			'x-api-key' => get_option('mp_aws_api_getway_api_key'),
			'Content-Type' => 'application/json'
		  ),
		  'body' => json_encode($json_data)
		)
	  );
  }

}
