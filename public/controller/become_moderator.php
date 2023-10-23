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
class Mp_mails_moderator
{

  public function __construct()
  {
  }
  public function mp_mails_digest_shortcode()
  {
    include_once mp_mails_PLAGIN_DIR . 'public/partials/digest/index.php';
  }
  public function mp_mails_become_moderator_code()
  {
    include_once mp_mails_PLAGIN_DIR . 'public/partials/moderator/form.php';
  }

  public function wp_ajax_mp_mails_become_moderator()
  {

    if (
      isset($_POST['firstName'])
      && isset($_POST['lastName'])
      && isset($_POST['email'])
      && isset($_POST['letter'])
    ) {

      $firstName = esc_attr($_POST['firstName']);
      $email = esc_attr($_POST['email']);
      $lastName = esc_attr($_POST['lastName']);
      $letter = esc_attr($_POST['letter']);
      $data = array(
        "firstName" =>  $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "letter" => $letter,
      );

      $postarr = array(
        'post_title' => 'Become Mindplex Moderator',
        'post_content' => json_encode($data),
        'post_type' => 'mp_mails_moderator',
      );

      $new_post_id = wp_insert_post($postarr);
      //   echo $new_post_id;


      include_once mp_mails_PLAGIN_DIR . '/email_templete/templetes.php';
      $Mp_mails_templetes = new Mp_mails_templetes();
      $bodyReplacements['body1'] = json_encode($data);
      $Mp_mails_templetes->to_email("moderator@mindplex.ai", 'moderator-application-template', $bodyReplacements);

      //   $emailContent = '<!DOCTYPE html>
      //   <html lang="en">
      //   <head>
      //   <meta charset="UTF-8" />
      //   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      //   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      //   <link rel="stylesheet" href="style.css" />
      //   <link rel="preconnect" href="https://fonts.googleapis.com" />
      //   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      //   <link
      //       href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap"
      //       rel="stylesheet"
      //   />
      //   <title>Mindplex</title>
      //   <style>
      //   *{
      //       padding: 0;
      //       margin: 0;
      //       box-sizing: border-box;
      //       font-family: "Barlow", sans-serif;
      //   }

      //   .email-wrapper{
      //       padding: 1rem;
      //       line-height: 1.7rem;
      //   }
      //   .email-heading {
      //       font-size: 30px;
      //       margin-bottom: 2rem;
      //   }
      //   .email-wrapper p{
      //       color: #787777;
      //       font-size: 20px;
      //       font-weight: 400;
      //   }
      //   .instructions-heading{
      //       border-bottom:1px solid #c0c0c0;
      //       padding-bottom: 1rem;
      //   }
      //   .instruction-description{
      //       padding-top: 1rem;
      //   }
      //   .activation-btn{
      //           background-color: #3C48A5;
      //           border: none;
      //           color: #fff;
      //           border-radius: 0.3rem;
      //           padding: 0.5rem 2rem;
      //           cursor: pointer;
      //           font-size: 20px;
      //           margin: 1rem 0;
      //           font-weight: 400;
      //           text-transform: capitalize;
      //   }</style>
      //   </head>
      //   <body>
      //   <div class="email-wrapper">
      //       <h1 class="email-heading">Mail from Mindplex moderator page</h1>
      //       <p class="instructions-heading">
      //       Below is a user message to become a Mindplex moderator.
      //       </p>
      //       <p class="instruction-description">
      //       <b>Name: </b>'.$firstName.',<br>
      //       <b>Letter: </b><br>'.$letter.'
      //       </p>
      //   </div>
      //   </body>
      //   </html>';

      //   $headers = array('Content-Type: text/html; charset=UTF-8');
      //   echo wp_mail("moderators@mindplex.ai", 'Mindplex New Moderators', $emailContent, $headers);
      die();
    }
  }
}
