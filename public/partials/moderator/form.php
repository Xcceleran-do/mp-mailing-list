
<form class="become-mode">
	<div class="mod-top-form">
		<div class="mode-contain">
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" id="firstName" placeholder="Enter your First Name">
		</div>
		<div class="mode-contain">
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" placeholder="Enter your Last Name">
		</div>
	</div>
	<div class="mode-contain">
		<label for="email">Email</label>
		<input type="text" name="email" id="moderatorEmail" placeholder="Enter email">
	</div>
	<label for="motivationLetter">Motivation letter</label>
	<textarea name="motivationLetter" id="motivationLetter" cols="30" rows="10" class="mod-bio"></textarea>
	<?php if(get_current_user_id() > 0 ){ ?>
	<input type="submit" value="Submit" class="mod-form-submit">
    <?php } else{ ?>
    <label class="mod-form-submit">Please login first </label>
    <?php } ?>
</form>
<script>
	window.addEventListener('DOMContentLoaded', () => {
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		const submitForm = document.querySelector(".become-mode");

		submitForm.addEventListener("submit", function(e) {
			showLoader()
			const firstName = document.querySelector("#firstName").value;
			const lastName = document.querySelector("#lastName").value;
			const email = document.querySelector("#moderatorEmail").value;
			const letter = document.querySelector("#motivationLetter").value;
			e.preventDefault();

			if (firstName == "" || lastName == "" || letter == "" || email == "") {
				hideLoader()
				return showNotification('Please fill out all the fields', 'danger');

			} else {
				const form_data = new FormData();
				form_data.append('action', 'mp_mails_become_moderator');
				form_data.append('firstName', firstName);
				form_data.append('lastName', lastName);
				form_data.append('email', email);
				form_data.append('letter', letter);

				jQuery.ajax({
					url: ajaxurl,
					type: 'post',
					contentType: false,
					processData: false,
					data: form_data,
					success: function(data) {
						hideLoader()
						console.log(data);
						return showNotification('Your request has been sent successfully!');
					},
					error: function(data) {
						hideLoader()
						return showNotification('Something went wrong. Please try again later.', 'danger');
					}
				})
			}
		});
	})
</script>