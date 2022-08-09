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
}
