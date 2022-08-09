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
}
