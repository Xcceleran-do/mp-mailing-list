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

        $headers = array('Content-Type: text/html; charset=UTF-8');
        $emailContent = 
        '</br>First name :- ' . esc_attr($firstName) .
        '</br>Last name :- ' . esc_attr($lastName) .
        '</br>Email Address :- ' . esc_attr($email) .
        '</br></br>Message :- ' . esc_attr($message); 

        wp_mail("editor@mindplex.ai", 'New Message to the Editor', $emailContent, $headers);

        }
        die();
    }
}
