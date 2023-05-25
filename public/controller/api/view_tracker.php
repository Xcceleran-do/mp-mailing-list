<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_mail_api
 * @subpackage Mp_mail_api/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_mail_api
 * @subpackage Mp_mail_api/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_mail_get_view_tracks_api_public
{
  /**
   * Get view_tracks
   *
   * @param  WP_REST_Request $request Full details about the request.
   * @return array $args.
   **/
  function wp_rest_view_tracks_endpoints($request)
  {
    /**
     * Handle Get view_tracks request.
     */
    register_rest_route('mp_mails' . '/v1', 'view-tracker/(?P<username>[a-zA-Z0-9-_]+)/(?P<email_id>[0-9]+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_view_tracks'),
      'permission_callback' => function () {
        return true;
      }
    ));
  }
  function get_view_tracks($request = null)
  {
    $username = esc_sql($request->get_param('username'));
    $email_id = absint($request->get_param('email_id'));

    $user = get_user_by('login', $username);
    $post = get_post( $email_id );

    $response['message'] = "Not recorded, Thank you!";

    if($user && $post)
    {
      $sent_promo_emails = get_post_meta($post->ID, "sent_promo_email", true);

      for ($i = 0; $i < count($sent_promo_emails['all']); $i++) {

        if($sent_promo_emails['all'][$i]['username'] === $username){

          if ( $sent_promo_emails['all'][$i]["has_opened"] != 1){

            $sent_promo_emails['all'][$i]["has_opened"] = 1;
            $sent_promo_emails['all'][$i]["opened_at"] = current_datetime()->format('Y-m-d H:i:s');
        
            update_post_meta($post->ID, "sent_promo_email", $sent_promo_emails);
            $response['message'] = "Email status recorded, Thank you!";
          }else{
            $response['message'] = "Already recorded, Thank you!";
          }
          break;
        }
      
      }

    }


    $response['code'] = "thank_you";

    return new WP_REST_Response($response, 123);
  }
}
