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
class Mp_mails_community_content
{

    public function __construct()
    {
    }

    public function mp_mails_cc_form()
    {
        wp_enqueue_style( 'cc-form-style',mp_mails_PLAGIN_URL . 'public/css/soon.css', false, '1.0', 'all' );  
        
        include_once mp_mails_PLAGIN_DIR . 'public/partials/cc_form/index.php';
    }

    public function wp_ajax_mp_mail_upload_content(){

        if (self::isUploaded("choose_content")) {

            $choose_content = self::uploadFile("choose_content");
            update_user_meta(get_current_user_id(), 'mp_mails_contributor_content', $choose_content);
        }
        die();
    }


    function isUploaded($fileName)
    {
        // WordPress environment
        // require(dirname(__FILE__) . '/../../../wp-load.php');

        $path = preg_replace('/wp-content.*$/', '', __DIR__);
        require($path . 'wp-load.php');

        $wordpress_upload_dir = wp_upload_dir();
        // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
        // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
        $i = 1; // number of tries when the file with the same name is already exists

        $profilepicture = $_FILES[$fileName];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        $new_file_mime = mime_content_type($profilepicture['tmp_name']);

        if (empty($profilepicture))
            return 0;
        else if ($profilepicture['error'])
            return 0;

        else if ($profilepicture['size'] > wp_max_upload_size())
            return 0;

        else if (!in_array($new_file_mime, get_allowed_mime_types()))
            return 0;

        else return 1;
    }

    function uploadFile($fileName)
    {
        // WordPress environment
        // require(dirname(__FILE__) . '/../../../wp-load.php');

        $path = preg_replace('/wp-content.*$/', '', __DIR__);
        require($path . 'wp-load.php');

        $wordpress_upload_dir = wp_upload_dir();
        // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
        // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
        $i = 1; // number of tries when the file with the same name is already exists

        $profilepicture = $_FILES[$fileName];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        $new_file_mime = mime_content_type($profilepicture['tmp_name']);

        if (empty($profilepicture))
            die('File is not selected.');

        if ($profilepicture['error'])
            die($profilepicture['error']);

        if ($profilepicture['size'] > wp_max_upload_size())
            die('It is too large than expected.');

        if (!in_array($new_file_mime, get_allowed_mime_types()))
            die('Our site doesn\'t allow this type of uploads.');

        while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
        }

        // looks like everything is OK
        if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {


            $upload_id = wp_insert_attachment(array(
                'guid'           => $new_file_path,
                'post_mime_type' => $new_file_mime,
                'post_title'     => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ), $new_file_path);

            // wp_generate_attachment_metadata() won't work if you do not include this file
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            // Generate and save the attachment metas into the database
            wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));

            // Show the uploaded file in browser
            // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
            return $wordpress_upload_dir['url'] . '/' . basename($new_file_path); //basename($new_file_path);
        }
    }

}
