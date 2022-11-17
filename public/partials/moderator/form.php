<form class="become-mode">
  <div class="mod-top-form">
    <div class="mode-contain">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your Full name">
    </div>
    <div class="mode-contain">
        <label for="biography">Title of the content</label>
        <input type="text" name="name" id="title" placeholder="Enter Title of the content">
    </div>
  </div>
  <label for="motivationLetter">Motivation letter</label>
  <textarea name="motivationLetter" id="motivationLetter" cols="30" rows="10" class="mod-bio"></textarea>
  <input type="submit" value="Submit" class="mod-form-submit">
</form>

<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitBtn = document.querySelector(".mod-form-submit");

  submitBtn.addEventListener("click", function(e) {
    showLoader()
    const name = document.querySelector("#name").value;
    const title = document.querySelector("#title").value;
    const letter = document.querySelector("#motivationLetter").value;
    e.preventDefault();
    
    if (name == "" || title == "" || letter == "") {
      hideLoader()
      return showNotification('Please fill out all the fields','danger');
      
    }
    else{
      const form_data = new FormData();
      form_data.append('action', 'mp_mails_become_moderator');
      form_data.append('name', name);
      form_data.append('title', title);
      form_data.append('letter', letter);

      jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        contentType: false,
        processData: false,
        data: form_data,
        success: function(data) {
          hideLoader()
          return showNotification('Your message has been sent successfully!');
        },
        error: function(data) {
          hideLoader()
          return showNotification('Something went wrong. Please try again later.', 'danger');
        }
      })
    }
  });
})
</script>