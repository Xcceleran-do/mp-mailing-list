<link rel="stylesheet" href="<?php echo ds_mails_PLAGIN_URL . 'public/css/soon.css' ?>">
<script>
  const isLoggedIn = `<?php echo get_current_user_id() ?>`
  let queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const page_type = urlParams.get('type')
 if(page_type === 'newsletter' && Number(isLoggedIn) !== 0){     
      window.location.href = `<?php echo home_url('/edit-profile/?tab=settings')?>`;
    }
</script>

<div class="coming-soon-container">
    <h1 class="comment-title">we are coming soon <?php echo $title ?></h1>
    <p class="sub-content">We are almost there! If you want to get notified when the website goes live, subscribe to our mailing list!</p>
    <div class="input-container">
          <div class="input-text-container">
            <input type="text" id="email" class="coming-input" name="new_user_email" placeholder="Please Enter your email address">
          </div>
          <button class="notify-btn" id="notify-btn">Notify me</button>
        </div>
</div>


<script src="<?php echo ds_mails_PLAGIN_URL . "public/js/mp-mailing-list-public.js" ?>"></script>

<script>
  const title = document.querySelector('.comment-title')
  const subTitle = document.querySelector('.sub-content')
  const email = document.getElementById("email");
  const notifyBtn = document.querySelector(".notify-btn");
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  const thankYou = `
        <h2>Thank you for subscribing.</h2>
    `;

  title.textContent = 'signup to our Newsletter'
  subTitle.textContent = 'If you want to get notified about mindplex updates,register your email address'
    
  notifyBtn.addEventListener("click", () => {
    // console.log(validateFn(email));
    if (validateFn(email)) {
      loader("notify-btn", true, "Register");
      $.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
          action: "mp_gl_save_new_email",
          email: email.value,
        },
        success: function (response) {
          console.log(response);
          if (response === "done") {
            loader("notify-btn", false, "Thank you");
            document.querySelector(".input-text-container").innerHTML =
              thankYou;
            notifyBtn.remove();
          }
        },
      });
    }
  });
</script>
