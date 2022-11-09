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
class Mp_mails_cta_page
{

    public function __construct()
    {
    }

    public function mp_mails_cta_page()
    {
        wp_enqueue_style( 'mailing-style',mp_gl_PLAGIN_URL . 'public/css/terms.css', false, '1.0', 'all' );  
        
        include_once mp_mails_PLAGIN_DIR . 'public/partials/cta_page/index.php';
    }

    public function mp_mails_be_moderator(){
        wp_enqueue_style( 'contact-style',mp_mails_PLAGIN_URL . 'public/css/soon.css', false, '1.0', 'all' );  

        include_once mp_mails_PLAGIN_DIR . 'public/partials/cta_page/be_moderator.php';
    }

    public function wp_ajax_mp_mails_save_moderator(){
        
        if(
        isset($_POST['message']) && !empty($_POST['message'])
        ){
            $message = esc_attr($_POST['message']);
            $user_id = esc_attr($_POST['userId']);
		    
            $id = update_user_meta($user_id,'mp_mails_moderator',$message);
            echo $id;
            
        }
        die();
    }
}
