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
class Mp_mail_email_types_taxonomy_Admin
{



     /**
      * Create two taxonomies, Email types and writers for the post type "book".
      *
      * @see register_post_type() for registering custom post types.
      */
     function wpdocs_create_Mp_mail_email_types_taxonomy()
     {
          $labels = array(
               'name'              => _x('Email types', 'taxonomy general name', 'textdomain'),
               'singular_name'     => _x('Email type', 'taxonomy singular name', 'textdomain'),
               'search_items'      => __('Search Email types', 'textdomain'),
               'all_items'         => __('All Email types', 'textdomain'),
               'parent_item'       => __('Parent Email type', 'textdomain'),
               'parent_item_colon' => __('Parent Email type:', 'textdomain'),
               'edit_item'         => __('Edit Email type', 'textdomain'),
               'update_item'       => __('Update Email type', 'textdomain'),
               'add_new_item'      => __('Add New Email type', 'textdomain'),
               'new_item_name'     => __('New Email type Name', 'textdomain'),
               'menu_name'         => __('Email type', 'textdomain'),
          );

          $args = array(
               'hierarchical'      => true,
               'labels'            => $labels,
               'show_ui'           => true,
               'show_admin_column' => true,
               'query_var'         => true,
               'rewrite'           => array('slug' => 'mp_mail_promo_types'),
               'show_in_rest'       => true
          );

          register_taxonomy('mp_mail_promo_types', array('mp_mail_promotions'), $args);

          unset($args);
          unset($labels);
     }

}
