<link rel="stylesheet" href="<?php echo mp_mails_PLAGIN_URL . 'public/css/soon.css' ?>">
<div class="coming-soon-container">
    <h1 class="comment-title">Contact Our Editors</h1>
    <p class="sub-content">Fill the forms below to send a message to our editors </p>
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
<textarea id="message" class="coming-input coming-input-textarea" name="new_user_email" placeholder="Please enter your message" cols="30" rows="10"></textarea>
          </div>
        </div>
        <div class="editors-btn-contian">

          <button class="notify-btn" id="notify-btn">Send message</button>
        </div>
</div>

     

<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  jQuery(document).ready(function() {
    const loader = (id, status, name) => {
        const elm = document.getElementById(id)
        if (status) {
            elm.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="loading-btn" style="width:20px;height:20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" fill="none" stroke="#fff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
                    `
            elm.disabled = true

        } else {
            elm.innerHTML = name
            elm.disabled = false

        }
}
const thankYou = `
        <h2>Thank you for subscribing.</h2>
    `;

      jQuery("#notify-btn").click(function() {

        loader("notify-btn",true)
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
                  jQuery(".editors-btn-contian").html(`<p style="font-size:1.5rem">Thank you for contacting our editors</p>`)
                  setTimeout(() => {
                    location.href = `<?php echo home_url()?>`
                  }, 5000);
                  // loader("notify-btn",false,"Send Message")
              }
          });
      });
  });
</script>