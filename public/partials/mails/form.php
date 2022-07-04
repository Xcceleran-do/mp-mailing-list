<link rel="stylesheet" href="<?php echo ds_mails_PLAGIN_URL . "public/css/mp-mailing-list-public.css" ?>">
<div class="input-container">
    <div class="input-text-container">

        <input type="text" id="email" class="coming-input" name="new_user_email" placeholder="Please Enter your email address" />
    </div>
    <button class="notify-btn" id="notify-btn">Notify me</button>
</div>
<script src="<?php echo ds_mails_PLAGIN_URL . "public/js/mp-mailing-list-public.js" ?>"></script>

<script>
    const email = document.getElementById('email')
    const notifyBtn = document.querySelector('.notify-btn')
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    notifyBtn.addEventListener('click', () => {
        console.log(validateFn(email));
        if (validateFn(email)) {
            loader('notify-btn', true, 'Register')

            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'mp_gl_save_new_email',
                    email: email.value,
                },
                success: function(response) {
                    console.log(response);
                    if (response === "done") {
                        loader('notify-btn', false, 'Thank you')
                    }
                }
            });
        }
    })
</script>