<div class="authors-container">
    <div class="authors-header">
        <h1 class="authors-heading">Promotional Email Contents</h1>
    </div>
    <div class="category-input-container">
        <div class="authors-header">
            <label for="">Select Email type</label>
            <select name="email_type" class="email-type">
                <option value="" selected disabled>--------</option> 
                <option value="publication">Publication</option>
                <option value="mindplexUpdates">Mindplex Updates</option>
            </select>
        </div>
    </div>
    <div class="category-input-container">
        <div class="authors-header">
            <label for="">Email Title</label>
            <input id="mp-mails-email-content-title" type="text" style="width: 40%;">            
        </div>
    </div>
    
    <form action="" id="formsData">
        <div class="authors-header">
            <label style="font-weight: bold;font-size: 20px;" for="">Enter Content</label>

            <?php
                // default settings - Kv_front_editor.php
                $content = '';
                $editor_id = 'promotional_email';

                $args = array(
                    'tinymce'       => array(
                        'toolbar1'      => 'formatselect,bold,italic,underline,|,bullist,numlist,blockquote,|,alignleft,aligncenter,alignright,|,link,unlink,|,forecolor,backcolor',
                        'toolbar2' => '',
                        'toolbar3'      => '',
                    ),
                );
                wp_editor( $content, $editor_id, $args );
                // $settings =   array(
                //     'wpautop' => true, // use wpautop?
                //     'media_buttons' => false, // show insert/upload button(s)
                //     'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                //     'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                //     'tabindex' => '',
                //     'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                //     'editor_class' => '', // add extra class(es) to the editor textarea
                //     'teeny' => false, // output the minimal editor config used in Press This
                //     'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                //     'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                //     'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                // );

                // wp_editor($content, $editor_id, $settings = array());
            ?>
        </div>
    </form>

    <div class="category-input-container">
        <div class="authors-header">
            <button id="saveContent">Save Content</button>
        </div>
    </div>
</div>


<script>
    jQuery('#wp-promotional_email-media-buttons').remove();
    const saveContentBtn = document.getElementById('saveContent');
    const contentTitle = document.querySelector('#mp-mails-email-content-title');
    const notifyType = document.querySelector('.email-type');
    saveContentBtn.addEventListener('click', function (e){
        e.preventDefault()
        // sendDigest.textContent = 'Sending ...';
        // if(notifyType.value == ''){
        //     alert('Please, choose digest type.')
        //     return;
        // }
        // if(tinyMCE.activeEditor.getContent() == ''){
        //     alert('Please, Provide digest message.')
        //     return;
        // }
        const emailContent = tinyMCE.activeEditor.getContent({                   
            format: 'text'
        });

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'mp_mails_emails_content',
                eamilType: notifyType.value,
                emailTitle: contentTitle.value,emailContent
            },
            beforeSend: function(){
                saveContentBtn.innerHTML = "Saving......"
            },
            success: function(response) {
                saveContentBtn.innerHTML = "Save Content"
                if(response == 'saved') {
                    alert('Post Saved Successfully!');
                }
            },
        });
    })
</script>
    