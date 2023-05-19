<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_mail_promotions
 * @subpackage Mp_mail_promotions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_mail_promotions
 * @subpackage Mp_mail_promotions/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_mail_promotions_Admin
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

    function Mp_mail_promotion_registration_init()
    {
        $labels = array(
            'name'                  => _x('Promotions', 'Post type general name', 'Promotions'),
            'singular_name'         => _x('Promotion', 'Post type singular name', 'Promotion'),
            'menu_name'             => _x('Promotions', 'Admin Menu text', 'Promotions'),
            'name_admin_bar'        => _x('Promotions', 'Add New on Toolbar', 'Promotions'),
            'add_new'               => __('Add New', 'Promotions'),
            'add_new_item'          => __('Add New Promotion', 'Promotions'),
            'new_item'              => __('New Promotion', 'Promotions'),
            'edit_item'             => __('Edit Promotion', 'Promotions'),
            'view_item'             => __('View Promotion', 'Promotions'),
            'all_items'             => __('All Promotions', 'Promotions'),
            'search_items'          => __('Search Promotions', 'Promotions'),
            'parent_item_colon'     => __('Parent Promotions:', 'Promotions'),
            'not_found'             => __('No Promotions found.', 'Promotions'),
            'not_found_in_trash'    => __('No Promotions found in Trash.', 'Promotions'),
            'featured_image'        => _x('Promotion Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'archives'              => _x('Promotion archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'general_plugin'),
            'insert_into_item'      => _x('Insert into Promotion', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'general_plugin'),
            'uploaded_to_this_item' => _x('Uploaded to this Promotion', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'general_plugin'),
            'filter_items_list'     => _x('Filter Promotions list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'general_plugin'),
            'items_list_navigation' => _x('Promotion list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'general_plugin'),
            'items_list'            => _x('Promotion list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'general_plugin'),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => 'Promotion custom post type.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'mp_mail_promotions'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'   => 'dashicons-book',
            'supports'           => array('title', 'editor', 'author'),
            // 'taxonomies'         => array('category', 'post_tag'),
            'show_in_rest'       => true
        );

        register_post_type('mp_mail_promotions', $args);
    }
}
