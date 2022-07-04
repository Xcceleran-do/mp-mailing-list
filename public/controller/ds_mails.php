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

    public function Ds_mails_form_code()
    {
        include_once ds_mails_PLAGIN_DIR . '/public/partials/mails/form.php';
    }
    public function wp_ajax_ds_mails_submit()
    {

        die();
    }
}
