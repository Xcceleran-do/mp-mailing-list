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
class Mp_mail_templete_types_taxonomy_Admin
{



     /**
      * Create two taxonomies, Templetes and writers for the post type "book".
      *
      * @see register_post_type() for registering custom post types.
      */
     function wpdocs_create_Mp_mail_templete_types_taxonomy()
     {
          $labels = array(
               'name'              => _x('Templetes', 'taxonomy general name', 'textdomain'),
               'singular_name'     => _x('Templete', 'taxonomy singular name', 'textdomain'),
               'search_items'      => __('Search Templetes', 'textdomain'),
               'all_items'         => __('All Templetes', 'textdomain'),
               'parent_item'       => __('Parent Templete', 'textdomain'),
               'parent_item_colon' => __('Parent Templete:', 'textdomain'),
               'edit_item'         => __('Edit Templete', 'textdomain'),
               'update_item'       => __('Update Templete', 'textdomain'),
               'add_new_item'      => __('Add New Templete', 'textdomain'),
               'new_item_name'     => __('New Templete Name', 'textdomain'),
               'menu_name'         => __('Templete', 'textdomain'),
          );

          $args = array(
               'hierarchical'      => true,
               'labels'            => $labels,
               'show_ui'           => true,
               'show_admin_column' => true,
               'query_var'         => true,
               'rewrite'           => array('slug' => 'mp_mail_promo_temp_types'),
               'show_in_rest'       => true
          );

          register_taxonomy('mp_mail_promo_temp_types', array('mp_mail_promotions'), $args);

          unset($args);
          unset($labels);
     }

     function Mp_mail_template_metas()
     {

          /* 
   * prefix of meta keys, optional
   */
          $prefix = 'mp_mail_template_';

          $config = array(
               'id' => 'mp_mail_promo_templete_mb',          // meta box id, unique per meta box
               'title' => 'Promotion email templete meta box title',          // meta box title
               'pages' => array('mp_mail_promo_temp_types'),        // taxonomy name, accept categories, post_tag and custom taxonomies
               'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
               'fields' => array(),            // list of meta fields (can be added by field arrays)
               'local_images' => true,          // Use local or hosted images (meta box images for add/remove)
               'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
          );

          /*
   * Initiate your meta box
   */
          $my_meta =  new Tax_Meta_Class($config);

          /*
   * Add fields to your meta box
   */

          // github.com/bainternet/Tax-Meta-Class

          $my_meta->addWysiwyg($prefix . 'before_content', array('name' => __('Before the content', 'tax-meta')));
          $my_meta->addWysiwyg($prefix . 'after_content', array('name' => __('After content', 'tax-meta')));

          /*
          * Don't Forget to Close up the meta box decleration
          */
          //Finish Meta Box Decleration
          $my_meta->Finish();
     }
}
