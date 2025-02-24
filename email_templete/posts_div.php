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

      // $post_content = '<a style="color: #fff !important;text-decoration:none;" href='.get_permalink($filtered_post->ID).'> <div style="width: 176px; height: auto; color: #FFFFFF; border-radius: 10px; padding: 6px 4px; border-radius: 8px; background: linear-gradient(181deg, rgba(128, 172, 237, 0.38) 0%, rgba(73, 190, 255, 0.00) 100%); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); margin-right:10px;">
      //   <img src="'.mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png'.'" alt="" style="position: relative; max-height:200px;  margin: 4px auto; width: 100%" />
      //   <a href='.home_url("user/".get_the_author_meta('display_name', $filtered_post->post_author)).'>'.
      //   get_avatar($filtered_post->post_author, 16).'<span style="color: #fff !important;font-size:10px; margin-left: 4px;">'.get_the_author_meta('display_name', $filtered_post->post_author).'</span></a>
      //   <div style="color: #fff !important;font-size:10px;">'.date('M. d, Y.', strtotime($filtered_post->post_date)).'</div><div style="text-align: start;"><p style="font-size: 15px; color: #49FFB3; margin: 6px auto;">'.$filtered_post->post_title.'</p><p style="font-size: 11px;margin: 6px auto;">'.get_post_meta($filtered_post->ID, 'mp_gl_post_brief_overview', true).'</p></div></div> </a>';

      $posts_content .= '<a style="color: #fff !important;text-decoration:none;" href="'.get_permalink($filtered_post->ID).'">';
      $posts_content .= '<div style="width: 176px; height: auto; color: #FFFFFF; border-radius: 10px; padding: 6px 4px; border-radius: 8px; background: linear-gradient(181deg, rgba(128, 172, 237, 0.38) 0%, rgba(73, 190, 255, 0.00) 100%); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); margin-right:10px;">';
      $posts_content .= '<img src="'.(isset(get_post_meta($filtered_post->ID, 'thumbnail_image', true)['src']) ? get_post_meta($filtered_post->ID, 'thumbnail_image', true)['src'] : $src_img).'" alt="" style="position: relative; max-height:200px;  margin: 4px auto; width: 100%" />';
      $posts_content .= '<a href='.home_url("user/".get_the_author_meta('display_name', $filtered_post->post_author)).'>'.get_avatar($filtered_post->post_author, 16).'<span style="color: #fff !important;font-size:10px; margin-left: 4px;">'.get_the_author_meta('display_name', $filtered_post->post_author).'</span></a>';
      $posts_content .= '<div style="color: #fff !important;font-size:10px;">'.date('M. d, Y.', strtotime($filtered_post->post_date)).'</div>';
      $posts_content .= '<div style="text-align: start;"><p style="font-size: 15px; color: #49FFB3; margin: 6px auto;">'.$filtered_post->post_title.'</p>';
      $posts_content .= '<p style="font-size: 11px;margin: 6px auto;">'.$strippedContent.'</p>';
      $posts_content .= '</div>';
      $posts_content .= '</div>';
      $posts_content .= '</a>';
    
    }
    if($posts_content == "") return "";

    return $posts_content;
  }
  public function one_time_token(){
    $post_content = '<p style="text-align:center"><span style="font-size:20px"><a title="Mindplex_AI Twitter" href="https://twitter.com/Mindplex_AI" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/twitter.png" alt="twiiter" width="24" height="24" ></a>';
    $post_content .= '<a title="MindplexAI Facebook" href="https://www.facebook.com/MindplexAI" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/facebook.png" alt="facebook" width="24" height="24" ></a>';
    $post_content .= '<a title="MINDPLEX YouTube" href="https://www.youtube.com/channel/UCUwdBITXX-aDXgt2ZmBD-IA" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/youtube.png" alt="youtube" width="24" height="24" ></a>';
    $post_content .= ' <a title="MINDPLEX Linkedin" href="https://www.linkedin.com/company/79915299/" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/linkedin.png" alt="linkedin" width="24" height="24" ></a>';
    $post_content .= '<a title="MINDPLEX Telegram" href="https://t.me/mindplex_ai" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/telegram.png" alt="telegram" width="24" height="24" style="margin-left: 7px !important;"></a></span></p>';

    $post_content .= '<p style="margin-left: 35px !important;"><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/Line91.png" alt="" ></p>';

    $post_content .= '<p style="text-align:center; color:#ffffff !important"><span style="font-size:15px"><span style="color:#ffffff"><a style="color:#ffffff" title="Mindplex privacy" href="{{--home_url--}}/privacy-policy/" rel="noopener" target="_blank" >Privacy</a>';
    $post_content .= '  |  <a style="color:#ffffff" title="user agreement" href="{{--home_url--}}/terms" rel="noopener" target="_blank" >User Agreement</a>';
    $post_content .= '  |  <a style="color:#ffffff" title="unsubscribe " href="{{--home_url--}}/edit-profile/?{{onetime_token}}&tab=settings" rel="noopener" target="_blank" >Unsubscribe</a></span><span style="color:#ffffff">&nbsp;</span> </span></p>
    ';

    return $post_content;
  }


  public function contest_unsubscribe($email){
    $post_content = '<p style="text-align:center"><span style="font-size:20px"><a title="Mindplex_AI Twitter" href="https://twitter.com/Mindplex_AI" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/twitter.png" alt="twiiter" width="24" height="24" ></a>';
    $post_content .= '<a title="MindplexAI Facebook" href="https://www.facebook.com/MindplexAI" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/facebook.png" alt="facebook" width="24" height="24" ></a>';
    $post_content .= '<a title="MINDPLEX YouTube" href="https://www.youtube.com/channel/UCUwdBITXX-aDXgt2ZmBD-IA" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/youtube.png" alt="youtube" width="24" height="24" ></a>';
    $post_content .= ' <a title="MINDPLEX Linkedin" href="https://www.linkedin.com/company/79915299/" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/linkedin.png" alt="linkedin" width="24" height="24" ></a>';
    $post_content .= '<a title="MINDPLEX Telegram" href="https://t.me/mindplex_ai" rel="noopener" target="_blank" ><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/telegram.png" alt="telegram" width="24" height="24" style="margin-left: 7px !important;"></a></span></p>';

    $post_content .= '<p style="margin-left: 35px !important;"><img src="{{--home_url--}}/wp-content/plugins/mp-mailing-list/email_templete/assets/img/Line91.png" alt="" ></p>';

    $post_content .= '<p style="text-align:center; color:#ffffff !important"><span style="font-size:15px"><span style="color:#ffffff"><a style="color:#ffffff" title="Mindplex privacy" href="{{--home_url--}}/privacy-policy/" rel="noopener" target="_blank" >Privacy</a>';
    $post_content .= '  |  <a style="color:#ffffff" title="user agreement" href="{{--home_url--}}/terms" rel="noopener" target="_blank" >User Agreement</a>';
    $post_content .= '  |  <a style="color:#ffffff" title="unsubscribe " href="{{--home_url--}}/?contest-unsubscribe='.$email.'" rel="noopener" target="_blank" >Unsubscribe</a></span><span style="color:#ffffff">&nbsp;</span> </span></p>
    ';

    return $post_content;
  }
}