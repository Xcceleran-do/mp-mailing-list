
<form class="about-us-container-form content" id="theForm">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" placeholder="Enter your first name">

    <label for="lname">Last Name</label>
    <input type="text" name="name" id="lname" placeholder="Enter your last name">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Enter your email address">
    <label for="biography">Discription of the content</label>
    <textarea name="biography" id="biography" cols="30" rows="10" class="about-us-bio"></textarea>

    <div class="icon-unlisted">
      <label for="link">Link</label>
      <span class="icon" id="unlisted-popup"><img class="info-icon-img"src="<?php echo mp_mails_PLAGIN_URL . 'public/assets/info.svg' ?>" alt=""></span>
    </div>
    <input type="text" name="link" id="link" placeholder="Enter link to your content">

    <label for="biography">Upload file</label>
    <input type="file" class="community-upload" name="" id="choose_content">
    <label for="choose_content">PDF, DOC, DOCX Max size of <?php echo wp_max_upload_size()/1024/1024 ?> MB</label>
    
    <input type="submit" value="Submit" class="about-us-form-submit">
    
</form>


<div class="popup" id="popup-unlisted">
    <div class="popcard">
        <div class="popup-wrapper" style="max-width: 600px;padding:1rem 2.5rem;">
            <p class="popup-close" id="unlisted-close">&#10005;</p>
            <div class="mindplex-wrapper">
						<div class="register-container">
							<h2 class="unlisted-title">Youtube unlisted links</h2>
						</div>

            <div>
              <span class="modal-or"> 1 Sign in to your youtube studio</span>
              <img class="unlisted-img" src =" <?php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/sign_in.png' ?>" alt="">
            </div>
            
            <div>
              <span class="modal-or">2 Select "Content" from the menu on the left-hand side. </span>
              <img class="unlisted-img" src =" <?php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/content_unlisted.png' ?>" alt="">
            </div>

            <div>
              <span class="modal-or">3 Choose a video and click the down arrow under "Visibility."</span>
              <img class="unlisted-img" src =" <?php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/choose_video.png' ?>" alt="">
            </div>

            <div>
              <span class="modal-or">4 Set your video to Unlisted and click "Save." </span>
              <img class="unlisted-img" src =" <?php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/set_to_unlisted.png' ?>" alt="">
            </div>

            <div>
              <span class="modal-or">5 Click Options and then "Get shareable link </span>
              <img class="unlisted-img" src =" <?php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/get_link.png' ?>" alt="">
              <span class="modal-or">"Once you click "Get shareable link," the link to your unlisted video will automatically be copied to your clipboard. </span>
            </div>
						
						<!-- <div class="bottom-content">
							<h1 class="signin-create-account">Already have an account? <a href="#"><span class="signin-create" id="signin-register">Sign in</span></a></h1>
							<p class="signin-terms">By Clicking "Create account" i agree to MindPlex's <a href="< ?php echo home_url("/terms") ?>"> <span> Terms of Service </span>and </span>Privacy Policy</span> </a></p>

						</div> -->

					</div>

            <!-- <h2 class="popup-title"> Share Links For Your Own Unlisted Videos.</h2>
            <img class="unlisted-img" src php echo mp_mails_PLAGIN_URL . 'public/assets/unlisted-link/sign_in.png' ?>" alt=""> -->


        </div>
    </div>
</div>


<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitFrom = document.querySelector(".about-us-container-form");
  const firstName = document.querySelector("#fname");
  const lastName = document.querySelector("#lname");
  const email = document.querySelector("#email");
  const biography = document.querySelector("#biography");

  const unlisted = document.getElementById("unlisted-popup")
  const unlistedPopup = document.getElementById("popup-unlisted")
  const closeUnlistedPopup = document.getElementById("unlisted-close")


  unlisted.addEventListener("click", openPopunlisted);

  function openPopunlisted() {

    unlistedPopup.style.display = "Block";
  }

  
  closeUnlistedPopup.addEventListener("click", () => {
    unlistedPopup.style.display = "none";
    });

    function closePopUnlisted(e) {
        if (e.target == unlistedPopup) {
            unlistedPopup.style.display = "none";
        }
    }
    window.addEventListener("click", closePopUnlisted);

  const maxSize = `<?php echo wp_max_upload_size()?>`;

  
  function checkEmailIsFromTrustedProvider(email) {
    const emailDomain = email.split('@')[1]
    const trustedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'singularitynet.io', 'icog-labs.com', 'protonmail.com', 'proton.me', 'pm.me', 'mail.yandex.ru', 'mail.yandex.com', 'yandex.ru', 'yandex.com', 'qq.com', 'tencent.com']
    return trustedDomains.includes(emailDomain)
  }

  const isValidLink = url=>{
    try{
      return Boolean(new URL(url));
    }catch(e){
      return false;
    }
  }
  const form_data = new FormData();
  
  submitFrom.addEventListener('submit',(e)=>{
    e.preventDefault()
    form_data.append('action', 'mp_mail_upload_content');
    showLoader()
    var file = jQuery('#choose_content').prop('files')[0];
  
    if(!file ){
      hideLoader()
      return showNotification('No file selected.', 'danger');
    }

    if(!email.value){
      hideLoader()
      return showNotification('Please provide your email !', 'danger');
    }
    else if(!checkEmailIsFromTrustedProvider(email.value)){
      hideLoader()
      return showNotification('Invalid email address.', 'danger');
    }

    if(file.size > maxSize){
      hideLoader()
      return showNotification(`File too large. The maximum file size should be less than ${(maxSize/1024/1024)} MB`, 'danger');
    }
    

    form_data.append('firstName', firstName.value);
    form_data.append('lastName', lastName.value);
    form_data.append('email', email.value);
    form_data.append('description', biography.value);
    

    jQuery.ajax({
      url: ajaxurl,
      type: 'POST',
      contentType: false,
      processData: false,
      data: form_data,
      success: function(data){
        console.log(data);
        // data = JSON.parse(data);
        // if(data.status =='success'){
        //   showNotification(data.msg);
        //   // submitFrom.reset();
        //   // name.value = '';
        //   // email.value = '';
        //   // biography.value = '';
          
        //   return hideLoader();
        // }
        // showNotification(data.msg, 'danger');
        // // submitFrom.reset();
        // // name.value = '';
        // // email.value = '';
        // // biography.value = '';
        return hideLoader();
      },
      // error: function(data){
      //   showNotification('Please try again later', 'danger');
      //   // submitFrom.reset();
      //   // name.value = '';
      //   // email.value = '';
      //   // biography.value = '';
      //   return hideLoader();
      // }
    });
  })
})
</script>