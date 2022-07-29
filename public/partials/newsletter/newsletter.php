<div class="popup" id="newsletterModal">
			<div class="popcard">
				<div class="popup-wrapper">

					<div class="close-modal" id="close-signup">
						&#10005;
					</div>
					<div class="join-mindplex-wrapper">
						<div class="register-container">
							<h2 class="signin-modal-title">Join</h2>
							<div class="logo-container">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/header/logo.svg" width="61.83px" height="62px" alt="">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/header/mindplexTxt.svg" class="" width="148.93px" height="34.53px" alt="Logo" />
							</div>
						</div>
						<?php
						include_once get_template_directory() . '/additional/register_user.php';
						if (isset($GLOBALS['social_login_error'])) {
							print_r($GLOBALS['social_login_error']);
						?>

							<script>
								openSignUp()
							</script>

						<?php
						}
						?>
				
						<div class="bottom-content">
							<h1 class="signin-create-account">Already have an account? <a href="#"><span class="signin-create" id="signin-register">Sign in</span></a></h1>
							<p class="signin-terms">By Clicking "Create account" i agree to MindPlex's <span> Terms of Service </span>and </span>Privacy Policy</span></p>

						</div>

					</div>

				</div>
			</div>
		</div>