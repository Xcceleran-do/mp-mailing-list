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

            // $email_type_slugs = array();
            // $taxonomy = 'mp_mail_promo_types'; // Replace with your custom taxonomy slug
            // $terms = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'slugs'));

            // if (!is_wp_error($terms)) {
            //     // Loop through the slugs and display or use them as needed
            //     foreach ($terms as $slug) {
            //         $email_type_slugs[] = $slug;

            //     }
            // }

            // $meta_query = array(
            //     'relation' => 'OR',
            // );

            // foreach ($email_type_slugs as $email_type_slug) {
            //     $meta_query[] = array(
            //         'key' => $email_type_slug,
            //         'value' => 'true',
            //         'compare' => '==',
            //     );
            // }

            // $subscribers = get_users(array(
            //     'meta_query' => $meta_query,
            // ));
            $emails = array('esubalew.a2009@gmail.com', 'dearfriend32@gmail.com', "ethealsintayheu@gmail.com", "tazebgetnet21@gmail.com", "heeba.khalid42@gmail.com", "sagnihundee@gmail.com", "yeabsramelaku5@gmail.com", "mundinoabete@gmail.com", "aben.ezer443@gmail.com", "bmekdes61@gmail.com", "beimnetdawit075@gmail.com", "lilaalex94@gmail.com", "alexkalalw@gmail.com", "tsion706@gmail.com", "melakebie@gmail.com", "abrhamhabtom17@gmail.com", "tsibantegize@gmail.com", "yabse.z@gmail.com", "dmengae1993@gmail.com", "tcxg68111@gmail.com", "shegerkey@gmail.com", "kiracherub866@gmail.com", "deborahmulugetagulma@gmail.com", "danielabdisa12@gmail.com", "amaniiiwzethio@gmail.com", "kalkidandereje666@gmail.com", "fikeeshetu@gmail.com", "studentethiopia21@gmail.com", "wondimnehtigist@gmail.com", "yohanneslemma700@gmail.com", "duresaeshetu2001@gmail.com", "amanueldemelash12@gmail.com", "mohdkedirmohd@gmail.com", "reemabdella702@gmail.com", "nathnaeldes@gmail.com", "mikiyasfasil2@gmail.com", "libenhailu04@gmail.com", "simruineb@gmail.com", "infoforme012@gmail.com", "babibebshu@gmail.com", "forabd24@gmail.com", "mulishtadesse2022@gmail.com", "felekebrook05@gmail.com", "saadmusema3@gmail.com", "tadiwosanegagregn@gmail.com", "michealturner200@gmail.com", "yosefzewdu07@gmail.com", "kalkidantadns@gmail.com", "ephrembedhaso@gmail.com");

            $args = array(
                'fields' => array('ID', 'user_email', 'display_name', 'user_login'),
                'number' => 0, // No limit on the number of results
            );

            $users = get_users($args);

            $subscribers = array_filter($users, function($user) use ($emails) {
                return in_array($user->user_email, $emails);
            });

            // Create an array to store the user IDs
            $userIds = array();

            // Extract the user IDs from the retrieved user objects
            foreach ($subscribers as $user) {


            // $taxonomy = 'mp_mail_promo_temp_types'; // Replace with your custom taxonomy slug
            // $terms = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids'));

            // if(count($terms))
            // {
            //     $templete_id = $terms[0];

            //     $before_content = get_term_meta($templete_id, 'mp_mail_template_before_content', true);
            //     $after_content = get_term_meta($templete_id, 'mp_mail_template_after_content', true);
       
            //     $tracker = '<img src="'.get_rest_url( null, 'mp_mails/v1/view-tracker/'.$user->user_login.'/'.$post->ID ).'" width="1" height="1" alt="Tracking Pixel" style="display: none;">';
            //     $email_content = $before_content . $tracker . $post->post_content . $after_content.'</body></html>';

            //     $headers = array('Content-Type: text/html; charset=UTF-8');
            //     $is_sent = wp_mail($user->user_email, $post->post_title, $email_content, $headers);
            //     // $is_sent = 1;

            //     $userIds[] = array("id"=>$user->ID, "email"=>$user->user_email, 'username' => $user->user_login, 'status' => $is_sent, 'has_opened' => 0, 'opened_at' => null);
            // }

            $tracker = '<img src="'.get_rest_url( null, 'mp_mails/v1/view-tracker/'.$user->user_login.'/'.$post->ID ).'" width="1" height="1" alt="Tracking Pixel" style="display: none;">';
            $email_content = $tracker . $post->post_content;


      include_once mp_mails_PLAGIN_DIR . '/email_templete/templetes.php';
      $Mp_mails_templetes = new Mp_mails_templetes();
      $bodyReplacements['body1'] = $user->user_login;
    //   $Mp_mails_templetes->template2($user->user_email, 'promotional-email-template', [], $bodyReplacements);


      $is_sent = $Mp_mails_templetes->template2($user->user_email, 'giveaway-campaign-winner', [], $bodyReplacements);
    
echo "is sent is " . $is_sent;

            $userIds[] = array("id"=>$user->ID, "email"=>$user->user_email, 'username' => $user->user_login, 'status' => $is_sent, 'has_opened' => 0, 'opened_at' => null);


            }
            
            $success = count($userIds); // temporary for now
            $sentEmails = array("success" => $success, 'all' => $userIds);
            
            update_post_meta( $post->ID, 'sent_promo_email', $sentEmails );
        }
    }
  }


}
