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
    $encoded = rawurlencode($user->user_login);
    $url = home_url("/mindplex_resetpass/?key=$adt_rp_key&login=$encoded");
    // $rp_link = '<a href="' . home_url("/mindplex_resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login)) . '">' . home_url("/mindplex_resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login)) . '</a>';
    $rp_link = "<a href='$url'>$url</a>";
    


    $args = array(
      
      'name' => 'promotional-reset-email',
      'post_type' => array('mp_mail_formats'),
      'post_status' => 'publish',
      'showposts' => 1,
      'ignore_sticky_posts' => 1,
    );
    $my_posts = get_posts($args);

    if ($my_posts) {
      $subject = $my_posts[0]->post_title;
      $content_title = $my_posts[0]->post_title;
      $body = $my_posts[0]->post_content;

      $body = preg_replace("/{{--username--}}/", $user_login, $body);
      $body = preg_replace("/{{--email--}}/", $email, $body);
      $body = preg_replace("/{{--reset_link--}}/", $rp_link, $body);


       
      $header = array('Content-Type: text/html; charset=UTF-8');

      return wp_mail($email, $content_title, $body, $header);
    }
    return 0;
  }

  public function to_email($email, $slug, $bodyReplacements)
  {
    $args = array(
      'name' => $slug,
      'post_type' => array('mp_mail_formats'),
      'post_status' => 'publish',
      'showposts' => 1,
      'ignore_sticky_posts' => 1,
    );
    $my_posts = get_posts($args);

    if ($my_posts) {
      $subject = $my_posts[0]->post_title;
      $content_title = $my_posts[0]->post_title;

      $body = $my_posts[0]->post_content;

      foreach ($bodyReplacements as $key => $value) {
        $body = str_replace("{{--" . $key . "--}}", $value, $body);
      }

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

  public function account_activate_email_template($email, $slug, $bodyReplacements)
  {
    $args = array(
      'name' => $slug,
      'post_type' => array('mp_mail_formats'),
      'post_status' => 'publish',
      'showposts' => 1,
      'ignore_sticky_posts' => 1,
    );
    $my_posts = get_posts($args);

    if ($my_posts) {
      $subject = $my_posts[0]->post_title;
      $content_title = $my_posts[0]->post_title;

      $body = $my_posts[0]->post_content;

      foreach ($bodyReplacements as $key => $value) {
        $subject = str_replace("{{--" . $key . "--}}", $value, $subject);
        $content_title = str_replace("{{--" . $key . "--}}", $value, $content_title);
        $body = str_replace("{{--" . $key . "--}}", $value, $body);
      }


      // $file_path = mp_mails_PLAGIN_DIR . 'email_templete/template1.php';
      // $email_content = file_get_contents($file_path);

      // $email_content = str_replace("{{--subject--}}", $subject, $email_content);
      // $email_content = str_replace("{{--content_title--}}", "<p style='margin-top: -10px;margin-left: 48px;color: #49FFB3;font-size:15px !important'>Where the future gets [sur]real", $email_content);
      // $email_content = str_replace("{{--body--}}", $body, $email_content);

      // $email_content = str_replace("{{--home_url--}}", home_url(), $email_content);

      $header = array('Content-Type: text/html; charset=UTF-8');

      return wp_mail($email, $subject, $body, $header);
    }
    return 0;
  }


  public function template2($email, $slug, $post_ids, $bodyReplacements)
  {
    $args = array(
      'name' => $slug,
      'post_type' => array('mp_mail_formats'),
      'post_status' => 'publish',
      'showposts' => 1,
      'ignore_sticky_posts' => 1,
    );
    $my_posts = get_posts($args);

    if ($my_posts) {
      $subject = $my_posts[0]->post_title;
      $content_title = $my_posts[0]->post_title;

      $body = $my_posts[0]->post_content;

      foreach ($bodyReplacements as $key => $value) {
        $subject = str_replace("{{--" . $key . "--}}", $value, html_entity_decode($subject));
        $content_title = str_replace("{{--" . $key . "--}}", $value, $content_title);
        $body = str_replace("{{--" . $key . "--}}", $value, $body);
      }

      if (strpos($body, '{{--posts--}}') !== false) {

        include_once mp_mails_PLAGIN_DIR . '/email_templete/posts_div.php';

        $Mp_mails_templetes_posts_div = new Mp_mails_templetes_posts_div();

        $body = str_replace("{{--posts--}}", $Mp_mails_templetes_posts_div->posts_div($post_ids), $body);
        // $body = str_replace("{{--posts--}}", self::posts_div($post_ids), $body);
      }

      // $file_path = mp_mails_PLAGIN_DIR . 'email_templete/template1.php';
      // $email_content = file_get_contents($file_path);

      // $email_content = str_replace("{{--subject--}}", $subject, $email_content);
      // $email_content = str_replace("{{--content_title--}}", "<p style='margin-top: -10px;margin-left: 48px;color: #49FFB3;font-size:15px !important'>Where the future gets [sur]real", $email_content);
      // $email_content = str_replace("{{--body--}}", $body, $email_content);

      // $email_content = str_replace("{{--home_url--}}", home_url(), $email_content);

      $header = array('Content-Type: text/html; charset=UTF-8');

      return wp_mail($email, $subject, $body, $header);
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

  public function posts_div($post_ids)
  {
    $posts_div_file_path = mp_mails_PLAGIN_DIR . 'email_templete/posts_div.php';

    $full_posts = "";
    foreach ($post_ids as $post_id) {

      $posts_div_email_content = file_get_contents($posts_div_file_path);


      $full_posts .= $posts_div_email_content;
    }
    return $full_posts;
  }
  public function contact_our_team_template($email, $slug, $bodyReplacements, $sender_data)
  {
    $args = array(
      'name' => $slug,
      'post_type' => array('mp_mail_formats'),
      'post_status' => 'publish',
      'showposts' => 1,
      'ignore_sticky_posts' => 1,
    );
    $my_posts = get_posts($args);

    if ($my_posts) {
      $subject = $my_posts[0]->post_title;
      $content_title = $my_posts[0]->post_title;

      $body = $my_posts[0]->post_content;

      foreach ($bodyReplacements as $key => $value) {
        $subject = str_replace("{{--" . $key . "--}}", $value, $subject);
        $content_title = str_replace("{{--" . $key . "--}}", $value, $content_title);
        $body = str_replace("{{--" . $key . "--}}", $value, $body);
      }


      $file_path = mp_mails_PLAGIN_DIR . 'email_templete/normal_email.php';
      $email_content = file_get_contents($file_path);

      $email_content = str_replace("{{--subject--}}", $subject, $email_content);
      $email_content = str_replace("{{--content_title--}}", "<p style='margin-top: -10px;margin-left: 48px;color: #49FFB3;font-size:15px !important'>Where the future gets [sur]real", $email_content);
      $email_content = str_replace("{{--body--}}", $body, $email_content);

      $email_content = str_replace("{{--home_url--}}", home_url(), $email_content);

      // $header[] = array();
      $header = array('Content-Type: text/html; charset=UTF-8','From: '.$sender_data['sender_name']. ' <'. $sender_data['sender_email'].'>');

      return wp_mail($email, $subject, '{{ignore_9mail}}'.$email_content, $header);
    }
    return 0;
  }
}
