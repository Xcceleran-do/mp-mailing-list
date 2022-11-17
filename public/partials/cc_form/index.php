
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
    <label for="name">Name</label>
    <input type="text" name="name" id="name" placeholder="Enter your full">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Enter yout email address">
    <label for="biography">Discription of the content</label>
    <textarea name="biography" id="biography" cols="30" rows="10" class="about-us-bio"></textarea>
    <label for="biography">Upload file</label>
    <input type="file" class="community-upload" name="" id="">
    <input type="submit" value="Submit" class="about-us-form-submit">
</form>

<script>
window.addEventListener('DOMContentLoaded', () => {
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const submitFrom = document.querySelector(".about-us-container-form");
  
  function checkEmailIsFromTrustedProvider(email) {
    const emailDomain = email.split('@')[1]
    const trustedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'singularitynet.io', 'icog-labs.com', 'protonmail.com', 'proton.me', 'pm.me', 'mail.yandex.ru', 'mail.yandex.com', 'yandex.ru', 'yandex.com', 'qq.com', 'tencent.com']
    return trustedDomains.includes(emailDomain)
}
  submitFrom.addEventListener('submit',(e)=>{
    e.preventDefault()
    console.log('...');
  })
})
</script>