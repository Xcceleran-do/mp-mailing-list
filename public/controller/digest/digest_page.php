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
class Mp_mail_digest_public
{
    public function mp_mails_digest_shortcode()
    {
        $is_user_subscribed = get_user_meta(get_current_user_id(), 'notify_me_on_new_digest', true);

        $lewis_choices = get_option('mp_mails_lewis_selected', array());
        $lewis_choice_posts = get_posts(
            array(
                'include' => $lewis_choices,
                'order'          => 'DESC',
                'orderby'        => "ID",
                'post_type'      => 'digest',
                'post_status'    => 'publish',
            )
        );
        // weekly digest
        $weekly_digest = self::mp_digest_weekly_recommendation(7);
        // on discover
        $discover = self::mp_mails_digest_recommendations('default', 1);
        // on latest
        $latest_news = get_posts(
            array(
                // 'exclude' => $lewis_choices,
                'order'          => 'DESC',
                'orderby'        => "ID",
                'offset'         => 0,
                'post_type'      => 'digest',
                'post_status'    => 'publish',
                'posts_per_page' => 10,
            )
        );
        wp_enqueue_style('mp-mails-digest-page-style', mp_mails_PLAGIN_URL . 'public/css/mp-mailing-digest.css', false, '1.0', 'all');

        include_once mp_mails_PLAGIN_DIR . 'public/partials/digest/index.php';
    }

    public function mp_mails_digest_homepage(){
        $mindbytes_homepage = self::mp_mails_digest_recommendations('default', 1,3);

        include_once mp_mails_PLAGIN_DIR . 'public/partials/digest/homepage.php';
    }

    public function mp_digest_weekly_recommendation($day=''){
        $mp_rep_community_slug = get_option('mp_rep_community_slug');
        $url = get_option('mp_rc_base_api') . "recommendations?recommender=popularity&verbose=false&community=" . $mp_rep_community_slug ."&day=".$day."&post_type=digest&post_type_format=all&page_size=5&category=all";
        
        $digest_rec_weekly = wp_remote_get(
            $url,
            array(
                'timeout' => 10,
                'headers' => array(
                    'X-API-Key' => get_option('mp_rc_base_api_key')
                )
            )
        );
        if (!is_wp_error($digest_rec_weekly) && $digest_rec_weekly['response']['code'] == 200){
            $weekly_content = json_decode($digest_rec_weekly['body'],true);
            if(isset($weekly_content['results']) && $weekly_content['count'] > 0) {
                // return $weekly_content['results'];
                foreach($weekly_content['results'] as $digests){
                    $return_array[]=$digests['content_id'];
                }
                if (count($return_array)) {
                    $args = array(
                        'include'          => $return_array,
                        'post_type'      => 'digest',
                        'post_status'    => 'publish',
                    );
                    return get_posts($args);
                }
            }
        }
        return array();
        
    }

    function mp_mails_digest_recommendations($recommender, $offset,$posts_per_page = 5)
    {
        $lewis_choices = get_option('mp_mails_lewis_selected', array());

        $mp_rep_community_slug = get_option('mp_rep_community_slug', 'none');
        $mp_rc_base_api = get_option('mp_rc_base_api');
        $posts_per_page = 5;
        $url =  $mp_rc_base_api . "recommendations?id=" . get_current_user_id() . "&from=mindplex&community=" . $mp_rep_community_slug . "&page_size=" . $posts_per_page . "&page=" . $offset . "&post_type=digest&post_type_format=all&category=all&verbose=false&recommender=" . $recommender;
       
        $digest_rec_responses = wp_remote_get(
            $url,
            array(
                'timeout' => 10,
                'headers' => array(
                    'X-API-Key' =>  get_option('mp_rc_base_api_key'),
                ),
            )
        );
        if (!is_wp_error($digest_rec_responses) && $digest_rec_responses['response']['code'] == '200') {
            $postIds = array();
            $responses = json_decode($digest_rec_responses['body'], true);
            $args = array();
            if (isset($responses['results'])) {

                foreach ($responses['results'] as $response) {
                    if (in_array($response['content_id'], $lewis_choices)) continue;
                    $postIds[] = $response['content_id'];
                }
            }
            if (count($postIds)) {
                $args = array(
                    'include'          => $postIds,
                    'post_type'      => 'digest',
                    'post_status'    => 'publish',
                );
                return get_posts($args);
            }
        } else {
            $offset = $offset - 1;
            $offset = $offset * $posts_per_page;

            $args = array(
                'exclude' => $lewis_choices,
                'order'          => 'DESC',
                'orderby'        => "ID",
                'offset'         => $offset,
                'post_type'      => 'digest',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page,
                // 'author' => 356
            
            );
        }
        return count($args)> 0 ? get_posts($args) : array();
    }

    public function wp_ajax_mp_mails_load_digest(){
        $offset = $_POST['offset'];
        
        $discover = self::mp_mails_digest_recommendations('default', $offset);
        if(count($discover) > 0)
            include_once mp_mails_PLAGIN_DIR . 'public/partials/digest/discover.php';
        else echo 'end';
        die();
    }

    public function wp_ajax_mp_mails_digest_subscribe()
    {
        $user_email = $_POST['userEmail'];
        if (is_user_logged_in()) {
            update_user_meta(get_current_user_id(), 'notify_me_on_new_digest', $user_email);
        }
        die();
    }

    function send_notif_digest($author_id, $user, $post_ID, $source){
        $author = get_user_by("id", $author_id);

        include_once mp_mails_PLAGIN_DIR . '/email_templete/templetes.php';
        $Mp_mails_templetes = new Mp_mails_templetes();
        $post_ids = array($post_ID);

        $bodyReplacements['body1'] = '<a href="' . home_url("/user/" . $user->user_login) . '">' . $user->user_login . '</a>';
        $bodyReplacements['body2'] = '<a href="' . home_url("/user/" . $author->user_login) . '">' . $author->first_name . '</a>';

        if($source === 'subscriber'){
            $Mp_mails_templetes->template2($user->user_email, 'new-mindbytes-mirror-hot-news-article', $post_ids, $bodyReplacements);
        }
        else if($source === 'follower'){
            $Mp_mails_templetes->template2($user->user_email, 'new-mindbytes-mirror-for-follow', $post_ids, $bodyReplacements);
        }
        
    }

    // checks if the users is author's follower and users has turned on follower notification 
    public function is_follower($author_id,$user_id){
        global $table_prefix, $wpdb;
        $mp_rp_follow = $table_prefix . "mp_rp_follow";
        $user_notify_follow_data = get_users(
            array(
                'meta_key' => 'mp_gl_notify_follower',
                'meta_value' => 'true',
                'fields' => 'ids'
            )
        );
        $ids = implode(',',$user_notify_follow_data);
        $follower_query = $wpdb->get_row("SELECT follower_id FROM $mp_rp_follow where following_id = $author_id and follower_id = $user_id and follower_id in ($ids) and deleted_at IS NULL");
        if(null !== $follower_query){ 
            return true ;
        }
        return false;
    }

    // email user 
    public function mp_mails_notify_digest($new_status, $old_status, $post){
        $subscribed_users = get_users(
            array(
                'meta_key' => 'notify_me_on_new_digest',
                'fields' => 'ids'
            )
        );
        $post_author = get_post_field('post_author', $post->ID);

        if ($new_status === 'publish' && $old_status !== 'publish' && $post->post_type === 'digest') {
            foreach($subscribed_users as $subscriber){
                $subscriber_data = get_user_by('id', $subscriber);
                $is_follower = self::is_follower($post_author, $subscriber);
                if($is_follower){
                    self::send_notif_digest($post_author, $subscriber_data, $post->ID,'follower');
                }
                else {
                    self::send_notif_digest($post_author, $subscriber_data, $post->ID,'subscriber');
                }
            }
        }

    }
}
