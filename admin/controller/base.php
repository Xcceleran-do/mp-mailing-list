<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_gl
 * @subpackage Mp_gl/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_gl
 * @subpackage Mp_gl/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_Mails_Admin_Base
{

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct()
	{
	}

	function mp_mail_base_menu_section()
	{
		$page_title = "MP Promotional Mails";
		$menu_title = "MP Promotional Mails";
		$capability = "manage_options";
		$menu_slug = "mp-mail-menu";
		$functionCallable = array($this, "mp_mails_dashboard_landing");
		$icon_url = "dashicons-email";
		$position = 10;
		add_menu_page($page_title, $menu_title, $capability, $menu_slug, $functionCallable, $icon_url, $position);
	}
	function mp_mails_dashboard_landing()
	{
        if (current_user_can('manage_options') || current_user_can('marketer')) {
            include_once mp_mails_PLAGIN_DIR . 'admin/partials/promotion/index.php';
        } 
        
	}

    public function wp_ajax_mp_mails_emails_content(){
        $post_title = sanitize_text_field($_POST['emailTitle']);
        $post_content = wp_kses_post($_POST['emailContent']);
        $email_type = wp_kses_post($_POST['eamilType']);
    
        // Create new post
        $post_args = array(
            'post_title'    => $post_title,
            'post_content'  => $post_content,
            'post_status'   => 'publish', // You can change this if needed
            'post_type'     => 'mp_mail_formats',
            'post_author'   => get_current_user_id() // Current user ID
        );
    
        // Insert the post into the database
        $post_id = wp_insert_post($post_args);
    
        if ($post_id) {
            update_post_meta($post_id, 'promotional_email_type', $email_type);
            echo 'saved';
        } else {
            echo 'Failed to save post.';
        }
    
        wp_die();
    }

}
