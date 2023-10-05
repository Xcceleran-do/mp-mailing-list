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
class Mp_mails_about_contact
{

  public function __construct()
  {
  }

  public function mp_mails_contact_us_code()
  {
    include_once mp_mails_PLAGIN_DIR . 'public/partials/contact/contact_us.php';
  }
  public function mp_mails_contact_team_code()
  {
    include_once mp_mails_PLAGIN_DIR . 'public/partials/contact/contact_team.php';
  }

  public function wp_ajax_mp_mail_email_team()
  {


    if (isset($_POST['user_email']) && isset($_POST['user_message'])) {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $user_email = $_POST['user_email'];
      $user_message = $_POST['user_message'];

      $email_type = $_POST['type'];
      if($email_type == 'team') $email = 'email@mindplex.ai';
      else if($email_type == 'editors') $email = 'editors@mindplex.ai';
      $data = array(
        "name" => esc_attr($first_name . ' ' . $last_name),
        "email" => esc_attr($user_email),
        "message" => esc_attr(stripslashes($user_message)),
      );

      $email_team_post = array(
        'post_title' => 'Contact Us message',
        'post_content' => json_encode($data),
        'post_type' => 'mp_mails_contact',
      );

      $insert_user_message = wp_insert_post($email_team_post);
      echo json_encode(array('status' => 'success'));
      include_once mp_mails_PLAGIN_DIR . '/email_templete/templetes.php';

      $mp_mails_templetes = new Mp_mails_templetes();
      $bodyReplacements['title'] = $email_type;
      $bodyReplacements['full-name'] = $first_name . ' ' . $last_name;
      $bodyReplacements['user-email'] = $user_email;
      $bodyReplacements['user-message'] = stripslashes($user_message);
      $mp_mails_templetes->contact_our_team_template($email , 'user-feedback-from-contact-page', $bodyReplacements);

    } else echo json_encode(array('status' => 'error', 'message' => 'email or message is empty'));
    die();
  }

  public function wp_ajax_mp_mail_insert_contact()
  {


    if (
      isset($_POST['firstName'])
      && isset($_POST['email'])
      && isset($_POST['message'])
    ) {

      $first_name = $_POST['firstName'];
      $last_name = isset($_POST['lastName']) ? $_POST['lastName'] : '';
      $name = $first_name . ' ' . $last_name;
      $email = $_POST['email'];
      $message = $_POST['message'];
      $data = array(
        "name" => esc_attr($name),
        "email" => esc_attr($email),
        "message" => esc_attr($message),
      );

      $postarr = array(
        'post_title' => 'Contact Us message',
        'post_content' => json_encode($data),
        'post_type' => 'mp_mails_contact',
      );

      $new_post_id = wp_insert_post($postarr);
      echo $new_post_id;

      $emailContent = '<!DOCTYPE html>
      <html lang="en">
      <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
          href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap"
          rel="stylesheet"
      />
      <title>Mindplex</title>
      <style>
      *{
          padding: 0;
          margin: 0;
          box-sizing: border-box;
          font-family: "Barlow", sans-serif;
      }
      
      .email-wrapper{
          padding: 1rem;
          line-height: 1.7rem;
      }
      .email-heading {
          font-size: 30px;
          margin-bottom: 2rem;
      }
      .email-wrapper p{
          color: #787777;
          font-size: 20px;
          font-weight: 400;
      }
      .instructions-heading{
          border-bottom:1px solid #c0c0c0;
          padding-bottom: 1rem;
      }
      .instruction-description{
          padding-top: 1rem;
      }
      .activation-btn{
              background-color: #3C48A5;
              border: none;
              color: #fff;
              border-radius: 0.3rem;
              padding: 0.5rem 2rem;
              cursor: pointer;
              font-size: 20px;
              margin: 1rem 0;
              font-weight: 400;
              text-transform: capitalize;
      }</style>
      </head>
      <body>
      <div class="email-wrapper">
          <h1 class="email-heading">Mail from Mindplex contact us page</h1>
          <p class="instructions-heading">
          Below is a user message from Mindplex contact us page.
          </p>
          <p class="instruction-description">
          <b>Name: </b>' . $name . ',<br>
          <b>Email: </b>' . $email . ',<br>
          <b>Message: </b>' . stripslashes($message) . '
          </p>
      </div>
      </body>
      </html>';

      $headers = array('Content-Type: text/html; charset=UTF-8');
      echo wp_mail("khalinoid@gmail.com", 'Mindplex New Moderators', $emailContent, $headers);
      // echo wp_mail("editor@mindplex.ai", 'Mindplex New Moderators', $emailContent, $headers);
      die();
    }
  }
}
