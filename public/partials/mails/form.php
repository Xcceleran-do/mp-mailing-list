<link rel="stylesheet" href="<?php echo ds_mails_PLAGIN_URL . "public/css/mp-mailing-list-public.css" ?>">
<div class="input-container">
    <input type="text" name="" id="email" class="coming-input" placeholder="Please Enter your email address" />
    <button class="notify-btn">Notify me</button>
</div>
<script>
    const email = document.getElementById('email')
    const notifyBtn = document.querySelector('.notify-btn')
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    notifyBtn.addEventListener('click', () => {
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

                }
            }
        });
    })
</script>