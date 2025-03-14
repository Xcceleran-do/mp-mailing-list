<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    MP_mails
 * @subpackage MP_mails/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_mails
 * @subpackage MP_mails/admin
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Mp_mails
{

    public function __construct()
    {
    }

    public function mp_mails_list_code()
    {
        include_once mp_mails_PLAGIN_DIR . 'public/partials/mails/form.php';
    }
    public function mp_mails_soon_code($data)
    {
        if(isset($data['title']))
        $title = $data['title'];
        else $title = "";
        include_once mp_mails_PLAGIN_DIR . 'public/partials/mails/soon.php';
    }
    public function wp_ajax_mp_gl_save_new_email()
    {

        $email = $_POST['email'];

        if(isset($email)){
		global $table_prefix, $wpdb;
			$wp_mp_table = $table_prefix . "mp_mailing_lists";
            $wpdb->insert($wp_mp_table, array(
                'email_address' => $email,
            ));
            echo "done";
        }else{
            echo "failed";
        }

        die();
    }

    public function mp_mails_newsletter_subscribe(){
        if(!is_user_logged_in()){
            wp_enqueue_style( 'mp-mails-newsletter-style',mp_mails_PLAGIN_URL . 'public/css/mp-mailing-newsletter.css', false, '1.0', 'all' ); 
            include_once mp_mails_PLAGIN_DIR . 'public/partials/mails/newsletter.php';
        }
    }

    public function wp_ajax_mp_mails_save_newsletter(){
        $response = self::mp_add_new_newsletter_email($_POST['emailValue']);

        echo json_encode($response);

        die();
    }

    public function mp_add_new_newsletter_email($eamil_address){
        global $table_prefix, $wpdb;
        $subscriber_email = sanitize_email($eamil_address);
        
        if(empty($subscriber_email))
            return array('status' =>'error', 'message' => 'Email required!');

		$mp_mailing_list_table = $table_prefix . "mp_mailing_lists";
		$is_email_exist = $wpdb->query($wpdb->prepare("SELECT id from $mp_mailing_list_table WHERE `email_address`=%s and mail_type= %s and deleted_at IS NULL", $subscriber_email, 'newsletter'));

        if($is_email_exist > 0  || email_exists( $subscriber_email )){
            return array('status' =>'error', 'message' => 'Email already exist!');
        }
        else { 
		    $insert_email = $wpdb->query($wpdb->prepare("INSERT INTO  $mp_mailing_list_table  (email_address, mail_type) values ('%s','%s')", $subscriber_email, 'newsletter'));

            return array('status' =>'success', 'message' => $subscriber_email);
        }
    }

    
  function wp_rest_add_email_to_newsletter_endpoints()
  {
    register_rest_route('mp_mails' . '/v1', 'newsletter-email/add', array(
      'methods' => 'POST',
      'callback' => array($this, 'add_new_email_to_newsletter_list'),
      'permission_callback' => function () {
        return true;
      }
    ));
  }

  function add_new_email_to_newsletter_list($request = null)
  {
    $email = $request->get_param('email');
    
    $response = self::mp_add_new_newsletter_email($email);
    
    if( $response['status'] == "error"){
        return new WP_Error(
            $response['status'],
            __($response['message'], 'wp-rest-courses'),
            array('status' => 400)
        );
    }

    return new WP_REST_Response($response, 123);
  }
}
