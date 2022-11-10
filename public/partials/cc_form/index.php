
<div class="coming-soon-container">
    <h1 class="comment-title">Contact Our Editors</h1>
    <p class="sub-content">Fill the forms below to send a message to our ediors </p>
    <div class="input-container">
          <div class="input-text-container">
            <label for="firstName">Title</label>
            <input type="text" id="firstName" class="coming-input" name="new_user_email" placeholder="Please enter content title">
          </div>
         
          <div class="input-text-container">
            <label for="firstName">Upload</label>

            <input type="file" id="choose_content" class="coming-input" name="">

            <label for="choose_content">PDF, DOC, pptx Max size of 800K</label>
          </div>
        </div>
        <div class="editors-btn-contian">
          <button class="notify-btn" id="upload_content" type="button">Upload</button>
        </div>
</div>

     

<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  jQuery("#upload_content").click(function() {
    // if (isAllFiled()) {
        showLoader()
        var choose_content = jQuery('#choose_content').prop('files')[0];
        if(!choose_content){
          hideLoader()
          alert('Please select an a file')
        }
        const fileSize = choose_content.size / 1024 / 1024 // MB
        if (fileSize > 0.8) {
            hideLoader()
            alert('The maximum file size should be less than 800kb ')
        }

        var form_data = new FormData();

        form_data.append('action', 'mp_mail_upload_content');
        form_data.append('choose_content', choose_content);


        jQuery.ajax({
            url: ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                console.log(response);
                hideLoader()
            }
        });
    // }

});


</script>