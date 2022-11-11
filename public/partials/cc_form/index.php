
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
    function isFilled(){
      if(jQuery('#choose_content').prop('files')[0] || contentLink.value) return true;
      else return false
    }
        showLoader()
        const form_data = new FormData();
        form_data.append('action', 'mp_mail_upload_content');
        if(jQuery('#choose_content').prop('files')[0]){
          
          var choose_content = jQuery('#choose_content').prop('files')[0];
  
          const fileSize = choose_content.size / 1024 / 1024 // MB
          if (fileSize > 0.8) {
              hideLoader()
              alert('The maximum file size should be less than 800kb ')
          }
          form_data.append('choose_content', choose_content);
          
        }
        if(contentLink.value ) {
          form_data.append('contentLink', contentLink.value);
        
        }
       
        if(isFilled()){
          jQuery.ajax({
              url: ajaxurl,
              type: 'post',
              contentType: false,
              processData: false,
              data: form_data,
              success: function(response) {
                  console.log(response);
                  hideLoader()
                  alert("Content submitted")
                  contentLink.value = '';
                  document.getElementById("choose_content").value = '';
                  
              },
              error: function(responsse){
                hideLoader();
                console.log('error: ',response);
              }
          });
        } else  {
          hideLoader()
          alert("Please ensert a link to your content or upload one.")
        } 

});


</script>