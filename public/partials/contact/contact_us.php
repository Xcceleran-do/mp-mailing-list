<div class="contact-form">
  <img class="about-decoration-right-blur" src="<?php echo mp_gl_PLAGIN_URL . 'public/assets/about-us/elipse1.svg' ?>" alt="">
  <img class="about-decoration-right" src="<?php echo mp_gl_PLAGIN_URL . 'public/assets/about-us/elipse2.svg' ?>" alt="">
      <h1 class="about-contact">Contact us</h1>
      <form class="about-us-container-form" id="theForm">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter your full">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="Enter yout email address">
          <label for="biography">Biography</label>
          <textarea name="biography" id="biography" cols="30" rows="10" class="about-us-bio"></textarea>
          <input type="submit" value="Submit" class="about-us-form-submit">
      </form>
</div>

<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitBtn = document.querySelector(".about-us-form-submit");
  
  submitBtn.addEventListener("click", function(e) {
    
    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const biography = document.querySelector("#biography").value;
    e.preventDefault();

    if (name == "" || email == "" || biography == "") {
      alert("Please fill out all the fields");
      return;
    }
    else{
      const form_data = new FormData();
      form_data.append('action', 'mp_mail_insert_contact');
      form_data.append('name', name);
      form_data.append('email', email);
      form_data.append('message', biography);

      jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        contentType: false,
        processData: false,
        data: form_data,
        success: function(data) {
          
        },
      })

    }
  });
})
</script>