<?php foreach ($discover as $single_discover) { ?>
    <!-- card 1 -->
    <div class="digest-card ">
        <?php
        $post_type_format = get_post_meta($single_discover->ID, 'post_type_format', true);
        if ($post_type_format === "video")
            $src_img = mp_gl_PLAGIN_URL . 'public/assets/video_not_found.png';

        else if ($post_type_format === "audio")
            $src_img = mp_gl_PLAGIN_URL . 'public/assets/Music_fallback.png';

        else
            $src_img = mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png';
        ?>
        <img style="width: 267px;height: 162px" class="digest-thumbnail" src="<?php echo isset(get_post_meta($single_discover->ID, 'thumbnail_image', true)['src']) ? get_post_meta($single_discover->ID, 'thumbnail_image', true)['src'] : $src_img ?>">
        <div class="digest-profile">
            <!-- <img src="< ?php echo mp_mails_PLAGIN_URL . 'public/assets/digest/profile.svg' ?>"> -->
            <a href="<?php echo home_url('user/'.get_the_author_meta('user_login', $single_discover->post_author)); ?>">
                <?php echo get_avatar($single_discover->post_author, 16); ?>
                <p class="digest-profile-description"><?php echo get_the_author_meta('display_name', $single_discover->post_author); ?>
            </a>
            .
            <span class="meta-date"><?php echo  date('M. d, Y.', strtotime($single_discover->post_date)) ?></span>
            </p>

        </div>

        <a href="<?php echo esc_url(get_permalink($single_discover->ID)); ?>">
            <h3 class="card-title">
                <?php echo $single_discover->post_title; ?>
            </h3>
        </a>
        <p class="digest-description">
            <?php
            $digest_teaser = get_post_meta($single_discover->ID, 'mp_gl_post_brief_overview', true);
            echo strlen($digest_teaser) > 150 ? substr($digest_teaser, 0, 150) . '...' : $digest_teaser;
            ?></p>
        <p class="digest-views"><?php do_shortcode('[mp_gl_min_to_read_code post_id="' . $single_discover->ID . '"]'); ?> .
            <?php do_shortcode('[mp_rp_get_postlikes_code likers="true" post_id="' . $single_discover->ID . '"]') ?> likes </p>
    </div>
<?php
} ?>