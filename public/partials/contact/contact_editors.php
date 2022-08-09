<link rel="stylesheet" href="<?php echo mp_mails_PLAGIN_URL . 'public/css/soon.css' ?>">
<div class="coming-soon-container">
    <h1 class="comment-title">Contact our editors</h1>
    <p class="sub-content">fill the forms below to send a message to our ediors </p>
    <div class="input-container">
          <div class="input-text-container">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" class="coming-input" name="new_user_email" placeholder="Please Enter your first name">
          </div>
          <div class="input-text-container">
          <label for="lastName">last Name</label>
            <input type="text" id="lastName" class="coming-input" name="new_user_email" placeholder="Please Enter your last name">
          </div>
          <div class="input-text-container">
          <label for="email">email</label>

            <input type="text" id="email" class="coming-input" name="new_user_email" placeholder="Please Enter your email address">
          </div>
          <div class="input-text-container">
          <label for="message">message</label>
<textarea id="message" class="coming-input coming-input-textarea" name="new_user_email" placeholder="Please Enter your email address" cols="30" rows="10"></textarea>
          </div>
        </div>
        <button class="notify-btn" id="notify-btn">Send message</button>
</div>

     

<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  jQuery(document).ready(function() {
      

      jQuery("#notify-btn").click(function() {

          jQuery.ajax({
              url: ajaxurl,
              type: 'POST',
              data: {

                  action: 'mp_mails_insert_contact',
                  firstName: jQuery("#firstName").val(),
                  lastName: jQuery("#lastName").val(),
                  email: jQuery("#email").val(),
                  message: jQuery("#message").val(),
              },
              success: function(response) {
                  console.log(response);
              }
          });
      });
  });
</script>