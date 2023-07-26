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
class Mp_mail_templete_post_type_Admin
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

    function Mp_mail_templete_format_init()
    {
        $labels = array(
            'name'                  => _x('Email Formats', 'Post type general name', 'Email Formats'),
            'singular_name'         => _x('Email Format', 'Post type singular name', 'Email Format'),
            'menu_name'             => _x('Email Formats', 'Admin Menu text', 'Email Formats'),
            'name_admin_bar'        => _x('Email Formats', 'Add New on Toolbar', 'Email Formats'),
            'add_new'               => __('Add New', 'Email Formats'),
            'add_new_item'          => __('Add New Email Format', 'Email Formats'),
            'new_item'              => __('New Email Format', 'Email Formats'),
            'edit_item'             => __('Edit Email Format', 'Email Formats'),
            'view_item'             => __('View Email Format', 'Email Formats'),
            'all_items'             => __('All Email Formats', 'Email Formats'),
            'search_items'          => __('Search Email Formats', 'Email Formats'),
            'parent_item_colon'     => __('Parent Email Formats:', 'Email Formats'),
            'not_found'             => __('No Email Formats found.', 'Email Formats'),
            'not_found_in_trash'    => __('No Email Formats found in Trash.', 'Email Formats'),
            'featured_image'        => _x('Email Format Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'general_plugin'),
            'archives'              => _x('Email Format archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'general_plugin'),
            'insert_into_item'      => _x('Insert into Email Format', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'general_plugin'),
            'uploaded_to_this_item' => _x('Uploaded to this Email Format', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'general_plugin'),
            'filter_items_list'     => _x('Filter Email Formats list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'general_plugin'),
            'items_list_navigation' => _x('Email Format list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'general_plugin'),
            'items_list'            => _x('Email Format list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'general_plugin'),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => 'Email Format custom post type.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'edit.php?post_type=mp_mail_promotions', // Display in the "Promotional emails" submenu
            'query_var'          => true,
            'rewrite'            => array('slug' => 'mp_mail_formats'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'   => 'dashicons-book',
            'supports'           => array('title', 'editor', 'author'),
            // 'taxonomies'         => array('category', 'post_tag'),
            'show_in_rest'       => true,
        );

        register_post_type('mp_mail_formats', $args);
    }
}
