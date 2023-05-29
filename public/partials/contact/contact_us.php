
<form class="about-us-container-form" id="theForm">
    <label for="name">First Name</label>
    <input type="text" name="name" id="firstName" placeholder="Enter your first name">

    <label for="name">last Name</label>
    <input type="text" name="name" id="lastName" placeholder="Enter your lsat name">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Enter yout email address">
    <label for="biography">Message</label>
    <textarea name="biography" id="biography" cols="30" rows="10" class="about-us-bio"></textarea>
    <button id="contactUsSubmit"class="about-us-form-submit"> Submit</button>
</form>

<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitForm = document.querySelector(".about-us-container-form");
  
  function checkEmailIsFromTrustedProvider(email) {
    const emailDomain = email.split('@')[1]
    const trustedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'singularitynet.io', 'icog-labs.com', 'protonmail.com', 'proton.me', 'pm.me', 'mail.yandex.ru', 'mail.yandex.com', 'yandex.ru', 'yandex.com', 'qq.com', 'tencent.com']
    return trustedDomains.includes(emailDomain)
}

const contactLoader = (id, status, text) => {
    const contactSubmitBtn = document.getElementById(id)
    if (status) {
        contactSubmitBtn.innerHTML = text
        contactSubmitBtn.disabled = true

    } else {
        contactSubmitBtn.innerHTML = text
        contactSubmitBtn.disabled = false

    }
}

  submitForm.addEventListener("submit", function(e) {
    showLoader()
    const firstName = document.querySelector("#firstName").value;
    const lastName = document.querySelector("#lastName").value;
    const email = document.querySelector("#email").value;
    const biography = document.querySelector("#biography").value;
    e.preventDefault();
    if (firstName == "" || email == "" || biography == "") {
      hideLoader()
      return showNotification('Please fill out all fields', 'danger');
    }
     else if (!checkEmailIsFromTrustedProvider(email)) {
      hideLoader()
      return showNotification('Please enter a valid email address', 'danger');
    } else{
      contactLoader('contactUsSubmit', true, 'Please wait.')
      
      const form_data = new FormData();
      form_data.append('action', 'mp_mail_insert_contact');
      form_data.append('firstName', firstName);
      form_data.append('lastName', lastName);
      form_data.append('email', email);
      form_data.append('message', biography);

      jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        contentType: false,
        processData: false,
        data: form_data,
        success: function(data) {
          hideLoader();
          contactLoader('contactUsSubmit', false, 'Submit')
          return showNotification('Your form has been successfully submitted!');    
        },
        error: function(data) {
          console.log(data);
          hideLoader();
          contactLoader('contactUsSubmit', false, 'Submit')

          return showNotification('Something went wrong please try again later.', 'danger');
        } 
      })

    }
  });
})
</script>