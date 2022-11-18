
<style>
  .community-upload{
	background: #17646F;
	border: 1px solid #70D0A7;
	border-radius: 9px;
	width: 100%;
	padding: 10px;
	height: 50px;
	color: #fff;
	font-weight: 400;
	font-size: 18px;
	line-height: 22px;
	color: #EEEEEE;
  }
</style>
<form class="about-us-container-form" id="theForm">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" placeholder="Enter your first full name">

    <label for="lname">Last Name</label>
    <input type="text" name="name" id="lname" placeholder="Enter your last full name">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Enter yout email address">
    <label for="biography">Discription of the content</label>
    <textarea name="biography" id="biography" cols="30" rows="10" class="about-us-bio"></textarea>
    <label for="biography">Upload file</label>
    <input type="file" class="community-upload" name="" id="choose_content">
    <label for="choose_content">PDF, DOC, DOCX Max size of <?php echo wp_max_upload_size()/1024/1024 ?> MB</label>
    
    <input type="submit" value="Submit" class="about-us-form-submit">
    
</form>

<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitFrom = document.querySelector(".about-us-container-form");
  const firstName = document.querySelector("#fname");
  const lastName = document.querySelector("#lname");
  const email = document.querySelector("#email");
  const biography = document.querySelector("#biography");

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
    
    if(!checkEmailIsFromTrustedProvider(email.value)){
      hideLoader()
      return showNotification('Invalid email address.', 'danger');
    }

    if(!file){
      hideLoader()
      return showNotification('No file selected.', 'danger');
    }

    if(file.size > maxSize){
      hideLoader()
      return showNotification(`File too large. The maximum file size should be less than ${(maxSize/1024/1024)} MB`, 'danger');
    }
    

    form_data.append('firstName', firstName.value);
    form_data.append('lastName', lastName.value);
    form_data.append('email', email.value);
    form_data.append('description', biography.value);
    form_data.append('file', file);

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