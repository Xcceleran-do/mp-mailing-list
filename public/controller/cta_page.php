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
        
        if(isset($_POST['message']) && !empty($_POST['message'])){
            $message = esc_attr($_POST['message']);
		    
            $id = update_user_meta(get_current_user_id(),'mp_mails_moderator',$message);

            $first_name = get_user_meta(get_current_user_id(),'first_name',true);

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
                <title>Mindplex New Moderators</title>
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
                    <h1 class="email-heading">New Account Activation</h1>
                    <p class="instructions-heading">
                    ' . $fullname . ' has submitted request to be Mindplex Moderator.</p>
                    <p class="instruction-description">
                    '.$message.'
                    </p>
                </div>
                </body>
            </html>';

            $headers = array('Content-Type: text/html; charset=UTF-8');
            echo wp_mail("editor@mindplex.ai", 'Mindplex New Moderators', $emailContent, $headers);
        }
        die();
    }
}
