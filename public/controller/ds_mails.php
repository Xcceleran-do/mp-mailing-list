<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Ds_mails
 * @subpackage Ds_mails/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ds_mails
 * @subpackage Ds_mails/admin
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Ds_mails
{

    public function __construct()
    {
    }

    public function ds_mails_list_code()
    {
        include_once ds_mails_PLAGIN_DIR . 'public/partials/mails/form.php';
    }
    public function wp_ajax_mp_gl_save_new_email()
    {

        $email = $_POST['email'];

        if(isset($email)){
		global $table_prefix, $wpdb;
			$wp_mp_table = $table_prefix . "ds_mailing_lists";
            $wpdb->insert($wp_mp_table, array(
                'email' => $email,
            ));
            echo "done";
        }else{
            echo "failed";
        }

        die();
    }
}
