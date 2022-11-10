
<section class="terms-container">
    <div class="terms-header">
        <p class="terms-header-title">Call To Action</p>
    </div>

    <div class="terms-body-one">
        <div class="terms-body-one-text">
            <div class="text-one">Mindplex is looking for high-quality content about the future, artificial intelligence, consciousness, transhumanism, and related themes. <a href="#"id="to-moderator">Click here</a> to contribute.
			</div>
        </div>
    
    </div>
   
</section>
<script>
	 var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    window.addEventListener('DOMContentLoaded', () => {
        const toModerate = document.getElementById('to-moderator')
        const isLoggedIn = `<?php echo get_current_user_id()?>`;
		toModerate.addEventListener('click',()=>{
            if (Number(isLoggedIn) <= 0) {
                signInFn()
                return signInFn.openSignModal('Please login or register to Contribute!')
            }
            else if(Number(isLoggedIn) > 0){
                location.href = `<?php echo home_url("mindplex-moderator")?>`
            }
		})
    })
</script>