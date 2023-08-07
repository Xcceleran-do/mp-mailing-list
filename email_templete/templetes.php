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
class Mp_mails_templetes
{

    public function password_reset_template($user_id)
    {

        $user = get_user_by('id', $user_id);
        $firstname = $user->first_name;
        $email = $user->user_email;
        $adt_rp_key = get_password_reset_key($user);
        $user_login = $user->user_login;
        $rp_link = '<a href="' . home_url("/mindplex_resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login)) . '">' . home_url("/mindplex_resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login)) . '</a>';
   
        

        $args = array(
            'name' => 'reset-password-template',
            'post_type' => array('mp_mail_formats'),
            'post_status' => 'publish',
            'showposts' => 1,
            'ignore_sticky_posts' => 1,
        );
        $my_posts = get_posts($args);

        if ($my_posts){
            $subject = $my_posts[0]->post_title;
            $content_title = $my_posts[0]->post_title;

            $body = $my_posts[0]->post_content;
        // $email_address = 'dawit.mekonnen@singularitynet.io';
        // $email_address = 'esubalew.amenu@singularitynet.io';

        $body = str_replace("{{--username--}}", $user_login, $body);
        $body = str_replace("{{--email--}}", $email, $body);
        $body = str_replace("{{--reset_link--}}", $rp_link, $body);


        $file_path = mp_mails_PLAGIN_DIR . 'email_templete/template1.php';
        $email_content = file_get_contents($file_path);

        $email_content = str_replace("{{--subject--}}", $subject, $email_content);
        $email_content = str_replace("{{--content_title--}}", $content_title, $email_content);
        $email_content = str_replace("{{--body--}}", $body, $email_content);

        $header = array('Content-Type: text/html; charset=UTF-8');

        return wp_mail($email, $subject, $email_content, $header);
        }
        return 0;
    }

    public function template1($subject, $content_title, $body)
    {

        // $email_address = 'dawit.mekonnen@singularitynet.io';
        $email_address = 'esubalew.amenu@singularitynet.io';

        $file_path = mp_mails_PLAGIN_DIR . 'email_templete/template1.php';
        $email_content = file_get_contents($file_path);

        $email_content = str_replace("{{--subject--}}", $subject, $email_content);
        $email_content = str_replace("{{--content_title--}}", $content_title, $email_content);
        $email_content = str_replace("{{--body--}}", $body, $email_content);

        $header = array('Content-Type: text/html; charset=UTF-8');

        return wp_mail($email_address, $subject, $email_content, $header);
    }
}
