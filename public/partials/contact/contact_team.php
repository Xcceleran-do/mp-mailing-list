<link rel="stylesheet" href="<?php echo mp_mails_PLAGIN_URL . 'public/css/soon.css' ?>">
<div class="coming-soon-container">
  <h1 class="comment-title">Contact Our Team</h1>
  <!-- <p class="sub-content">Fill out the form below to send a message to our team </p> -->
  <form class="input-container">
    <div class="input-text-container">
      <label for="firstName">First Name</label>
      <input type="text" id="firstName" class="coming-input" name="new_user_email">

    </div>
    <div class="input-text-container">
      <label for="lastName">last Name</label>
      <input type="text" id="lastName" class="coming-input" name="new_user_email">
    </div>
    <div class="input-text-container">
      <label for="email">email</label>

      <input type="email" id="email" class="coming-input required-input " name="new_user_email" required>
      <span class="digest-error-txt">Email should not be empty!</span>
    </div>
    <div class="input-text-container">
      <label for="message">message</label>
      <textarea id="message" class="coming-input coming-input-textarea contact-message required-input" name="new_user_email" cols="30" rows="10"></textarea>
      <span class="digest-error-txt">Message should not be empty!</span>
    </div>
  </form>
  <div class="editors-btn-contian">

    <button class="notify-btn" id="send-to-team">Send</button>
  </div>
</div>
<script type='module'>
  window.addEventListener("DOMContentLoaded", () => {
    let cancelSending = false
    const contactMessage = document.querySelector(".contact-message")
    const sendBtn = document.querySelector('#send-to-team')
    const firstName = document.querySelector('#firstName')
    const lastName = document.querySelector('#lastName')
    const userEmail = document.querySelector('#email')

    const inputs = document.querySelectorAll('.required-input')

    // send email data
    sendBtn.addEventListener('click', function(e) {
      e.preventDefault();
      // validation 
      inputs.forEach(element => {
        if (!element.value) {
          cancelSending = true
          element.classList.add('digest-input-error')
          element.nextElementSibling.style.display = 'block'

        }
      })
      if (!cancelSending) {
        sendBtn.innerHTML = "Sending..."
        jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'mp_mail_email_team',
            first_name: firstName.value,
            last_name: lastName.value,
            user_email: userEmail.value,
            user_message: contactMessage.value

          },
          success: function(response) {
            sendBtn.innerHTML = 'Send'
            console.log(response);
          },
          error: function(data) {
            sendBtn.innerHTML = 'Send'
            console.log('error', data);
          }
        });
      }
      inputs.forEach(element => {
        setTimeout(() => {
          element.classList.remove('digest-input-error')
          element.nextElementSibling.style.display = 'none'
        }, 5000)
        cancelSending = false
      })
    })

  })
</script>