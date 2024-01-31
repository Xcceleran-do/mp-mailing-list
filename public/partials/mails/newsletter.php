 <div class="newsletter-banner">
    <img class="newsletter-bg-img" src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/newsletter.jpeg' ?>"/>
    <div class="newsletter-content">
        <div class="newsletter-heading">
            <h2>Subscribe to our newsletter</h2>
        </div>
        <div class="newsletter-paragraph">
            <p>Get weekly update about our product on your email, no spam guaranteed we promise ✌️</p>
            <p class="digest-message-txt" style="color: var(--color-input-error) !important;"></p>
            <div class="newsletter-input-container">
                <input id="subscriber-email" type="text" placeholder="Enter your email" class="newsletter-input" />
                <button id="newsletter-subscribe-btn" class="newsletter-subscribe">Subscribe</button>

            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {

        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        const subscribeBtn = document.querySelector('#newsletter-subscribe-btn')
        const subscriberEmail = document.querySelector('#subscriber-email')
        const inputerrorTxt = document.querySelector('.digest-message-txt')

        function emailValidation(message, elm) {
            inputerrorTxt.innerHTML = message
            inputerrorTxt.style.display = 'block'
            inputerrorTxt.classList.add(elm)
            subscriberEmail.classList.add('digest-input-error')

            setTimeout(() => {
                inputerrorTxt.style.display = 'none'
                inputerrorTxt.innerHTML = ''
                inputerrorTxt.classList.remove(elm)
                subscriberEmail.classList.remove('digest-input-error')
            }, 5000)
        }
        
        function saveEmail(){
            const emailValue = subscriberEmail.value.trim();

            // Client-side email validation
            if (!emailValue) {
               return emailValidation('Email is empty!', 'newsletter-input')
            }
            if (!isValidEmail(emailValue)) {
               return emailValidation('Email is not valid!', 'newsletter-input')
            }

            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'mp_mails_save_newsletter',
                    emailValue
                },
                beforeSend: function(data) {
                    subscribeBtn.innerHTML = `<img class="loading-btn" style="width:20px;height:20px" src="<?php echo get_template_directory_uri(); ?>/assets/header/loader.svg" alt=""/>`
                },
                success: function(response) {
                    res = JSON.parse(response)
                    if(res.status == 'success'){
                        subscribeBtn.innerHTML = `Subscribe`
                        subscriberEmail.value = ''
                        showNotification('Thank you for subscribing! Your email address has been successfully saved.')

                    }
                    else {
                        subscribeBtn.innerHTML = `Subscribe`

                        return emailValidation(res.message, 'newsletter-input')
                    }


                },
                error: function(response) {
                    subscribeBtn.innerHTML = `Subscribe`
                }

            });


        }

        subscribeBtn.addEventListener('click',saveEmail)
        subscriberEmail.addEventListener('keypress', (event) => {
            if (event.keyCode === 13) {
                saveEmail()
            }
        })

        function isValidEmail(email) {
            // Use a regular expression for basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        // jQuery.ajax({
        //     url: ajaxurl,
        //     type: 'POST',
        //     data: {
        //         action: 'mp_mails_submit_newsletter_subscription',
        //         offset
        //     },
        //     beforeSend: function(data) {
        //         moreDigestBtn.innerHTML = `<img class="loading-btn" style="width:20px;height:20px" src="<?php echo get_template_directory_uri(); ?>/assets/header/loader.svg" alt=""/>`
        //     },
        //     success: function(response) {
        //         moreDigestBtn.innerHTML = 'More topics'
        //         if(response !== 'end'){
        //             discoverContainer.insertAdjacentHTML('beforeend', response)
        //             offset+=1
        //             stopDigest = false
        //         }
        //         else {
                    
        //             stopDigest = true;
        //         }

        //     },
        //     error: function(response) {

        //     }

        // });
    })
</script>