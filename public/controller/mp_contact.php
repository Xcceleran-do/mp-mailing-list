<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_mails
 * @subpackage Mp_mails/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_contact
 * @subpackage Mp_contact/admin
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Mp_contact
{

    public function __construct()
    {
    }

    public function Mp_mails_contact_editors_code()
    {
        include_once mp_mails_PLAGIN_DIR . 'public/partials/contact/contact_editors.php';
    }

    public function wp_ajax_mp_mails_insert_contact()
    {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        if(isset($firstName) && !empty($firstName) &&
        isset($lastName) && !empty($lastName) &&
        isset($email) && !empty($email) &&
        isset($message) && !empty($message)
        ){
		global $table_prefix, $wpdb;
			$wp_mp_table = $table_prefix . "mp_mailing_contact";
            $wpdb->insert($wp_mp_table, array(
                'fname' => $firstName,
                'lname' => $lastName,
                'email_address' => $email,
                'message' => $message,
                'user_id' => get_current_user_id()
            ));
        }
        die();
    }

    public function mp_gl_contact(){

        if(isset($_POST['visitor_name'])
         && isset($_POST['visitor_email']) 
         && isset($_POST['visitor_message'])){
  
          $visitor_name = esc_attr($_POST['visitor_name']);
          $visitor_email = esc_attr($_POST['visitor_email']);
          $visitor_message = esc_attr($_POST['visitor_message']);
  
          $postarr = array(
            'post_author' => $visitor_email,
            'post_title' => $visitor_name,
            'post_content' => $visitor_message,
            'post_type' => 'mp_mails_contact'
          );

          $new_post_id = wp_insert_post( $postarr );
        }
  
      }
}
