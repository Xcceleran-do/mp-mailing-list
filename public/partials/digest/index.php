<div class="main-container">
    <div class="digest-header">
        <h1>Weekly Digest</h1>
        <p>
            The Weekly Digest covers enterprise, finance & investments, health and medicine, international politics, music, and chatbot technology. We explore industries like auto, food service, and crypto and keep current on the latest in AI & business.
        </p>
        <img class="digest-line" src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/digest/line.svg' ?>" />
    </div>

    <div class="digest-weekly-selection">

        <h2>Weekly selection</h2>
        <div class="digest-cards">

            <?php foreach ($weekly_digest as $single_weekly) { ?>
                <!-- card 1 -->
                <div class="digest-card ">
                    <?php
                    $post_type_format = get_post_meta($single_weekly->ID, 'post_type_format', true);
                    if ($post_type_format === "video")
                        $src_img = mp_gl_PLAGIN_URL . 'public/assets/video_not_found.png';

                    else if ($post_type_format === "audio")
                        $src_img = mp_gl_PLAGIN_URL . 'public/assets/Music_fallback.png';

                    else
                        $src_img = mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png';
                    ?>
                    <img style="width:267px;height:162px;border-radius:5px;object-fit:cover;" class="digest-thumbnail" src="<?php echo isset(get_post_meta($single_weekly->ID, 'thumbnail_image', true)['src']) ? get_post_meta($single_weekly->ID, 'thumbnail_image', true)['src'] : $src_img ?>">
                    <div class="digest-profile">
                        <a href="<?php echo home_url('user/'.get_the_author_meta('user_login', $single_weekly->post_author)); ?>">
                            <?php echo get_avatar($single_weekly->post_author, 16); ?>
                            <div class="digest-profile-description"><?php echo get_the_author_meta('display_name', $single_weekly->post_author); ?>
                        </a>
                        .
                        <span class="meta-date"><?php echo  date('M. d, Y.', strtotime($single_weekly->post_modified)) ?></span>
                    </div>

                </div>

                <a href="<?php echo esc_url(get_permalink($single_weekly->ID)); ?>">
                    <h3 class="card-title">
                        <?php echo $single_weekly->post_title; ?>
                    </h3>
                </a>
                <p class="digest-description">
                    <?php
                    $digest_teaser = get_post_meta($single_weekly->ID, 'mp_gl_post_brief_overview', true);
                    echo strlen($digest_teaser) > 150 ? substr($digest_teaser, 0, 150) . '...' : $digest_teaser;
                    ?></p>
                <p class="digest-views"><?php do_shortcode('[mp_gl_min_to_read_code post_id="' . $single_weekly->ID . '"]'); ?> .
                    <?php do_shortcode('[mp_rp_get_postlikes_code content_type="like" post_id="' . $single_weekly->ID . '"]') ?> likes
                </p>
        </div>
    <?php
            } ?>

    </div>
    <img class="digest-line" src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/digest/line.svg' ?>">
</div>

<div class="digest-latest-news">
    <h2>Latest News</h2>
    <div class="digest-cards">
        <!-- card 1 -->
        <?php foreach ($latest_news as $lewis_latest) {
            $post_type_format = get_post_meta($lewis_latest->ID, 'post_type_format', true);
            if ($post_type_format === "video")
                $latest_img = mp_gl_PLAGIN_URL . 'public/assets/video_not_found.png';

            else if ($post_type_format === "audio")
                $latest_img = mp_gl_PLAGIN_URL . 'public/assets/Music_fallback.png';

            else
                $latest_img = mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png';
        ?>
            <div class="digest-card">
                <div class="digest-blog-description">
                    <div class="digest-profile">
                        <a href="<?php echo home_url('user/'.get_the_author_meta('user_login', $lewis_latest->post_author)); ?>">
                            <?php echo get_avatar($lewis_latest->post_author, 16); ?>
                            <p class="digest-profile-description"><?php echo get_the_author_meta('display_name', $lewis_latest->post_author); ?>
                        </a>
                        . <?php echo  date('M. d, Y.', strtotime($lewis_latest->post_modified)) ?></p>
                    </div>
                    <a href="<?php echo esc_url(get_permalink($lewis_latest->ID)); ?>">
                        <h3><?php echo $lewis_latest->post_title; ?></h3>
                    </a>
                    <P class="digest-description">
                        <?php
                        $latest_teaser = get_post_meta($lewis_latest->ID, 'mp_gl_post_brief_overview', true);
                        // echo strlen($latest_teaser) > 150 ? substr($latest_teaser, 0, 150) . '...' : $latest_teaser;
                        echo $latest_teaser;
                        ?>
                    </P>
                    <p class="digest-views"><?php do_shortcode('[mp_gl_min_to_read_code post_id="' . $lewis_latest->ID . '"]'); ?> .
                        <?php do_shortcode('[mp_rp_get_postlikes_code content_type="like" post_id="' . $lewis_latest->ID . '"]') ?> likes
                    </p>

                </div>
                <img style="width:267px; height:162px; min-width:267px; min-height:162px; border-radius:5px; object-fit:cover;" class="digest-thumbnail" src="<?php echo isset(get_post_meta($lewis_latest->ID, 'thumbnail_image', true)['src']) ? get_post_meta($lewis_latest->ID, 'thumbnail_image', true)['src'] : $latest_img ?>">

            </div>
        <?php } ?>

    </div>
    <img class="digest-line" src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/digest/line.svg' ?>">
</div>

<div class="digest-Discover">
    <h2>Discover</h2>

    <div class="digest-cards discover-container">
        <!-- card 1 -->
        <?php 
            include_once mp_mails_PLAGIN_DIR . 'public/partials/digest/discover.php';
        ?>
    </div>
    <div class="more-btn-container">
        <button id="more-digest">More</button>
    </div>

    <img class="digest-line" src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/digest/line.svg' ?>">
</div>

<div class="digest-footer">
    <div class="digest-newsletter">
        <h2>Lewis' Choice</h2>
        <p>"Lewis' Choice" highlights the week's most important AI stories on the latest advances and insights about AI's future.</p>

        <p class="digest-message-txt"></p>
        <input type="text" placeholder="Email here" class="digest-email-input " value="<?php echo $is_user_subscribed ? $is_user_subscribed : ''; ?>">
        <button class="digest-subscribe-button" data-logged-in="<?php echo is_user_logged_in() ?>">Subscribe</button>

    </div>
    <div class="digest-cards">
        <!-- card 1 -->
        <?php foreach ($lewis_choice_posts as $chosed) { ?>
            <?php
            $post_type_format = get_post_meta($chosed->ID, 'post_type_format', true);
            if ($post_type_format === "video")
                $chosed_thumbnail = mp_gl_PLAGIN_URL . 'public/assets/video_not_found.png';

            else if ($post_type_format === "audio")
                $chosed_thumbnail = mp_gl_PLAGIN_URL . 'public/assets/Music_fallback.png';

            else
                $chosed_thumbnail = mp_gl_PLAGIN_URL . 'public/assets/img_not_found.png';
            ?>
            <div class="digest-card">
                <img style="width: 267px;height: 162px;border-radius: 5px;" class="digest-thumbnail" src="<?php echo isset(get_post_meta($chosed->ID, 'thumbnail_image', true)['src']) ? get_post_meta($chosed->ID, 'thumbnail_image', true)['src'] : $chosed_thumbnail ?>">

                <div class="digest-profile">
                    <a href="<?php echo home_url('user/' . get_the_author_meta('user_login', $chosed->post_author)); ?>">
                        <img style="border-radius:50%;" src="<?php echo get_avatar_url($chosed->post_author, 16); ?>">
                        <p class="digest-profile-description"><?php echo get_the_author_meta('display_name', $chosed->post_author); ?>
                    </a>
                    <?php echo  date('M. d, Y', strtotime($chosed->post_modified)) ?></p>
                </div>
                <a href="<?php echo esc_url(get_permalink($chosed->ID)); ?>">
                    <h3> <?php echo $chosed->post_title; ?></h3>
                </a>
                <p class="digest-views"><?php do_shortcode('[mp_gl_min_to_read_code post_id="' . $chosed->ID . '"]'); ?> .
                    <?php do_shortcode('[mp_rp_get_postlikes_code content_type="like" post_id="' . $chosed->ID . '"]') ?> likes</p>
            </div>
        <?php } ?>

    </div>
</div>
</div>


<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    let offset = 2;
    let stopDigest = false
    let isUserLoggedIn = `<?php echo is_user_logged_in()?>`

    window.addEventListener("DOMContentLoaded", () => {
        const subscribeBtn = document.querySelector('.digest-subscribe-button')
        const errorTxt = document.querySelector('.digest-message-txt')
        const emailField = document.querySelector('.digest-email-input')
        const moreDigestBtn = document.querySelector('#more-digest')
        const btnContainer = document.querySelector('.more-btn-container')

        const discoverContainer = document.querySelector('.discover-container')
        

        function checkDigestEmail(email) {
            const emailDomain = email.split('@')[1]
            const trustedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'singularitynet.io', 'icog-labs.com', 'protonmail.com', 'proton.me', 'pm.me', 'mail.yandex.ru', 'mail.yandex.com', 'yandex.ru', 'yandex.com', 'qq.com', 'tencent.com']
            return trustedDomains.includes(emailDomain)
        }

        function digestEmailValidation(message, elm) {
            errorTxt.innerHTML = message
            errorTxt.style.display = 'block'
            errorTxt.classList.add(elm)
            emailField.classList.add('digest-input-error')

            setTimeout(() => {
                errorTxt.style.display = 'none'
                errorTxt.innerHTML = ''
                errorTxt.classList.remove(elm)
                emailField.classList.remove('digest-input-error')
            }, 5000)
        }

        function loadMoreDigest(){
            stopDigest = true
            jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'mp_mails_load_digest',
                        offset
                    },
                    beforeSend: function(data) {
                        moreDigestBtn.innerHTML = `<img class="loading-btn" style="width:20px;height:20px" src="<?php echo get_template_directory_uri(); ?>/assets/header/loader.svg" alt=""/>`
                    },
                    success: function(response) {
                        moreDigestBtn.innerHTML = 'More'
                        if(response !== 'end'){
                            discoverContainer.insertAdjacentHTML('beforeend', response)
                            offset+=1
                            stopDigest = false
                        }
                        else {
                            
                            stopDigest = true;
                        }

                    },
                    error: function(response) {

                    }

                });
        }

        subscribeBtn.addEventListener('click', function(element) {
            if (isUserLoggedIn == '') {
                window.location.href = `<?php echo home_url('?type=login') ?>`
                return
            }
            if (!emailField.value) {
                digestEmailValidation('Email field cannot be empty!', 'digest-error-txt')
            } else if (!checkDigestEmail(emailField.value)) {
                digestEmailValidation('Your email should be one of the trusted email service providers <a target="_blank" href="/mp-faq/creating-an-account-signup">listed here</a>', 'digest-error-txt')
            } else {
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'mp_mails_digest_subscribe',
                        userEmail: emailField.value
                    },
                    beforeSend: function(data) {
                        subscribeBtn.innerHTML = `<img class="loading-btn" style="width:20px;height:20px" src="<?php echo get_template_directory_uri(); ?>/assets/header/loader.svg" alt=""/>`
                    },
                    success: function(response) {
                        subscribeBtn.innerHTML = 'Subscribe'
                        digestEmailValidation('Email registered successfully!', 'digest-success-txt')

                    },
                    error: function(response) {

                    }

                });
            }
        })

        moreDigestBtn.addEventListener('click', function(){
            if(!stopDigest){
                loadMoreDigest()
            }
        })
    })
</script>