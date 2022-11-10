
<div class="coming-soon-container">
    <h1 class="comment-title">Submit your content here</h1>
    <p class="sub-content">Upload your content here or give us a link to your content </p>
    <div class="input-container">
          <div class="input-text-container">
            <label for="contentLink">Link</label>
            <input type="text" id="contentLink" class="coming-input" name="new_user_email" placeholder="Enter link to your content">
          </div>
         
          <div class="input-text-container">
            <label for="upload">Upload</label>

            <input type="file" id="choose_content" class="coming-input" name="">

            <label for="choose_content">PDF, DOC, pptx Max size of 800K</label>
          </div>
        </div>
        <div class="editors-btn-contian">
          <button class="notify-btn" id="upload_content" type="button">Submit Content</button>
        </div>
</div>

     

<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  const contentLink = document.getElementById("contentLink")
  jQuery("#upload_content").click(function() {
    // if (isAllFiled()) {
        showLoader()
        const choose_content = jQuery('#choose_content').prop('files')[0];
        // if(!choose_content || contentLink){
        //   hideLoader()
        //   alert('Please select a content')
        // }
        const fileSize = choose_content.size / 1024 / 1024 // MB
        if (fileSize > 0.8) {
            hideLoader()
            alert('The maximum file size should be less than 800kb ')
        }

        const form_data = new FormData();

        form_data.append('action', 'mp_mail_upload_content');
        form_data.append('choose_content', choose_content);
        form_data.append('contentLink', contentLink.value);


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
            error: function(responsse){
              hideLoader();
              console.log('error: ',response);
            }
        });
    // }

});


</script>