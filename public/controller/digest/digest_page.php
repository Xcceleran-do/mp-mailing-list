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

        $lewis_choises = get_option('mp_mails_lewis_selected', array());
        $lewis_choise_posts = get_posts(
            array(
                'include' => $lewis_choises,
                'order'          => 'DESC',
                'orderby'        => "ID",
                'post_type'      => 'digest',
                'post_status'    => 'publish',
            )
        );
        // weekly digest
        $weekly_digest = self::mp_mails_digest_recommendations('popularity', 1);
        // on discover
        $discover = self::mp_mails_digest_recommendations('default', 1);
        // on latest
        $latest_news = get_posts(
            array(
                // 'exclude' => $lewis_choises,
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

    function mp_mails_digest_recommendations($recommender, $offset)
    {
        $lewis_choises = get_option('mp_mails_lewis_selected', array());

        $mp_rep_community_slug = get_option('mp_rep_community_slug', 'none');
        $mp_rc_base_api = get_option('mp_rc_base_api');
        $posts_per_page = 10;
        $url =  $mp_rc_base_api . "recommendations?id=" . get_current_user_id() . "&from=mindplex&community=" . $mp_rep_community_slug . "&page_size=" . $posts_per_page . "&page=" . $offset . "&post_type=community_content&post_type_format=all&category=all&verbose=false&recommender=" . $recommender;
        $data = array(
            "id" => get_current_user_id(),
            "from" => "mindplex",
            "community" => $mp_rep_community_slug,
            "page_size" => $posts_per_page,
            "page" => $offset,
            "post_type" => 'digest',
            "post_type_format" => "all",
            "category" => "all",
            "verbose" => false,
            "recommender" => $recommender,
        );
        $digest_rec_responses = wp_remote_get(
            $url,
            array(
                'timeout' => 10,
                'headers' => array(
                    'X-API-Key' =>  get_option('mp_rc_base_api_key'),
                ),
                'body' => $data
            )
        );
        if (!is_wp_error($digest_rec_responses) && $digest_rec_responses['response']['code'] == '200') {
            $postIds = array();
            $responses = json_decode($digest_rec_responses['body'], true);
            if (isset($responses['results'])) {

                foreach ($responses['results'] as $response) {
                    if (in_array($response['content_id'], $lewis_choises)) continue;
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
            return array();
        } else {
            $offset = $offset - 1;
            $offset = $offset * $posts_per_page;

            $args = array(
                'exclude' => $lewis_choises,
                'order'          => 'DESC',
                'orderby'        => "ID",
                'offset'         => $offset,
                'post_type'      => 'digest',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page,
            );
            return get_posts($args);
        }
    }

    public function wp_ajax_mp_mails_digest_subscribe()
    {
        $user_email = $_POST['userEmail'];
        if (is_user_logged_in()) {
            update_user_meta(get_current_user_id(), 'notify_me_on_new_digest', $user_email);
        }
        die();
    }
}
