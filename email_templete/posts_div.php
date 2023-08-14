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
class Mp_mails_templetes_posts_div
{


  public function posts_div($post_ids)
  {
    $posts_content = "";
    foreach ($post_ids as $post_id) {

    $filtered_post = get_post($post_id);

      $post_type_format = get_post_meta($filtered_post->ID, 'post_type_format', true);
      if($post_type_format === "video")
          $src_img = mp_gl_PLAGIN_URL . 'public/assets/video_not_found.png';

      else if($post_type_format === "audio")
          $src_img = mp_gl_PLAGIN_URL . 'public/assets/Music_fallback.png';

      else    
              $src_img = mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png';

      $overview = get_post_meta($filtered_post->ID, 'mp_gl_post_brief_overview', true);
      $strippedContent=  strlen(strip_tags($overview)) > 100 ? substr(strip_tags($overview), 0, 100).'....' :strip_tags($overview);


    $posts_content .= '<a style="color: #fff !important;text-decoration:none;" href='.get_permalink($filtered_post->ID).'> <div style="width: 176px; height: auto; color: #FFFFFF; border-radius: 10px; padding: 6px 4px; border-radius: 8px; background: linear-gradient(181deg, rgba(128, 172, 237, 0.38) 0%, rgba(73, 190, 255, 0.00) 100%); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); margin-right:10px;">
        <img src="'.(isset(get_post_meta($filtered_post->ID, 'thumbnail_image', true)['src']) ? get_post_meta($filtered_post->ID, 'thumbnail_image', true)['src'] : $src_img).'" alt="" style="position: relative;   margin: 4px auto;  min-height: 63%; width: 100%" />
        <a href='.home_url("user/".get_the_author_meta('display_name', $filtered_post->post_author)).'>'.
        get_avatar($filtered_post->post_author, 16).
            '<span style="color: #fff !important;font-size:10px; margin-left: 4px;">'.get_the_author_meta('display_name', $filtered_post->post_author).'</span>
            </a>
            <div style="color: #fff !important;font-size:10px;">'.date('M. d, Y.', strtotime($filtered_post->post_date)).'</div>
        
        <div style="text-align: start;">
            <p style="font-size: 9px; color: #49FFB3; margin: 6px auto;">
                '.$filtered_post->post_title.'
            </p>
            <p style="font-size: 8px;margin: 6px auto;">
                '.$strippedContent.'
            </p>';
            // <p style="font-size: 6px;">21 min read . 19.9K views</p>
        $posts_content .= '</div>
    </div> </a>';
    
  }
  if($posts_content == "") return "";
  $posts_content = '<div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-top: 25px;">'.
  $posts_content . '</div>';

  return $posts_content;

}
}