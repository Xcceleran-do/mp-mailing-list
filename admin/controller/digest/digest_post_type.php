<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_mail_metas
 * @subpackage Mp_mail_metas/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_mail_metas
 * @subpackage Mp_mail_metas/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_mail_digest_admin
{
    function mp_mail_digest_post_type()
    {
        $labels = array(
            'name'                  => _x('Mindbytes', 'Post type general name', 'digest'),
            'singular_name'         => _x('Mindbytes Mirror', 'Post type singular name', 'digest'),
            'menu_name'             => _x('Mindbytes', 'Admin Menu text', 'digest'),
            'name_admin_bar'        => _x('Mindbytes', 'Add New on Toolbar', 'digest'),
            'add_new'               => __('Add New', 'digest'),
            'add_new_item'          => __('Add New Mindbytes', 'digest'),
            'new_item'              => __('New Mindbytes', 'digest'),
            'edit_item'             => __('Edit Mindbytes', 'digest'),
            'view_item'             => __('View Mindbytes', 'digest'),
            'all_items'             => __('All Mindbytess', 'digest'),
            'search_items'          => __('Search Mindbytess', 'digest'),
            'parent_item_colon'     => __('Parent Mindbytess:', 'digest'),
            'not_found'             => __('No Mindbytess found.', 'digest'),
            'not_found_in_trash'    => __('No Mindbytess found in Trash.', 'digest'),
            'featured_image'        => _x('Mindbytes Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'archives'              => _x('Mindbytes archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'general_plugin'),
            'insert_into_item'      => _x('Insert into Mindbytes', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'general_plugin'),
            'uploaded_to_this_item' => _x('Uploaded to this Mindbytes', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'general_plugin'),
            'filter_items_list'     => _x('Filter Mindbytess list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'general_plugin'),
            'items_list_navigation' => _x('Mindbytes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'general_plugin'),
            'items_list'            => _x('Mindbytes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'general_plugin'),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => 'Mindbytes custom post type.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'digest'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'supports'           => array('title', 'editor', 'author', 'thumbnail', 'comments'),
            'taxonomies'         => array('category', 'post_tag'),
            'show_in_rest'       => true
        );

        register_post_type('digest', $args);
    }
    public function main()
    {
        function mp_gl_register_digest_metabox()
        {
            add_meta_box("mp_mails_digest_selection", "Lewis' Choice", "mp_mails_lewis_selection", array("digest"), "side", "low");
        }
        add_action('admin_init', 'mp_gl_register_digest_metabox');

        function mp_mails_lewis_selection()
        {
            $lewis_selected_posts =  get_option('mp_mails_lewis_selected', 'none');
            $lewis_posts = get_posts(
                array(
                    'fields' => 'ids',
                    'post_type' => 'digest',
                    'post_status' => 'publish',
                    'orderby'    => 'ID',
                    'order'    => 'DESC',
                    'posts_per_page' => -1
                )
            );
?>

            <div id="mp-mailing-selections">
                <?php foreach ($lewis_posts as $id) { ?>
                    <div class="mp-mailing-digest-checkbox" style="padding-block: 10px;">
                        <label class="label">
                            <input style="width: 20px;height: 20px;border-radius: 0px;" type="checkbox" name="lewis_choice_posts[]" value="<?php echo $id ?>" <?php if (is_array($lewis_selected_posts) && in_array($id, $lewis_selected_posts)) echo 'checked' ?>>
                            <?php echo get_the_title($id) ?>
                        </label>
                    </div>
                <?php } ?>
            </div>

<?php
        }
        function mp_mails_register_digest_metabox_script()
        {
            wp_enqueue_script('wp_digest_selection', mp_mails_PLAGIN_URL . 'admin/js/mp-mailing-selections.js', array('jquery'), '0.0.2', true);
            // wp_localize_script('wp_digest_selection', 'customUploads', array('imageData' => get_post_meta(get_the_ID(), 'thumbnail_image', true)));
        }
        add_action('admin_enqueue_scripts', 'mp_mails_register_digest_metabox_script');

        function mp_mails_save_lewis_selected($post_ID)
        {
            if (get_post_type($post_ID) == 'digest' && isset($_POST['lewis_choice_posts'])) {
                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
                if ($parent_id = wp_is_post_revision($post_ID)) {
                    $post_ID = $parent_id;
                }
                update_option('mp_mails_lewis_selected', $_POST['lewis_choice_posts']);
            }
        }
        add_action('save_post', 'mp_mails_save_lewis_selected');
    }
}
