(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	let removeWarning
	const validateError = (errorElements) => {
		errorElements.map(el => {
			const p = document.createElement('p')
			if (!el.element.nextElementSibling) {
				p.innerText = el.message
				el.element.classList.add('input-error')
				p.classList = 'error-txt'
				p.innerText = el.message
				el.element.insertAdjacentElement('afterend', p)
			} else {
				p.classList = 'error-txt'
				el.element.nextElementSibling.remove();
				p.textContent = el.message
				el.element.insertAdjacentElement('afterend', p)
			}
			if (removeWarning) {
				clearTimeout(removeWarning);
			}
			removeWarning = setTimeout(() => {
				clean(errorElements)
			}, 5000)
		})
	}

	const clean = (elm) => {
		elm.map(el => {
			if (!el.element.nextElementSibling) return;
			el.element.classList.remove('input-error')
			el.element.nextElementSibling.remove();
		})
	}
	const validateFn = (...args) => {
		const errorElements = []
		const mailFormat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		args.forEach(elm => {
			if (elm.value === "") {
				errorElements.push({
					element: elm,
					message: elm.placeholder + " should not be empty"
				})
			}
			console.log(elm.name === 'new_user_email' && !elm.value.trim().toLowerCase().match(mailFormat));
			if (elm.name === 'new_user_email' && !elm.value.trim().toLowerCase().match(mailFormat)) {
				errorElements.push({
					element: elm,
					message: 'enter a valid email'
				})
			}
			if (elm.name === 'new_user_password') {
				const eightCharacters = new RegExp('(?=.{8,})')
				const oneUpperCase = new RegExp('(?=.*[A-Z])')
				const oneLowerCase = new RegExp('(?=.*[a-z])')
				const oneDigit = new RegExp('(?=.*[0-9])')
				const oneSpecial = new RegExp('([^A-Za-z0-9])')
				if (!eightCharacters.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'password should be 8 characters long'
					})
				} else if (!oneUpperCase.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'must have atLeast one uppercase letter '
					})
				} else if (!oneLowerCase.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'must have atLeast one lowercase letter '
					})
				} else if (!oneDigit.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'must have atLeast one number '
					})
				} else if (!oneSpecial.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'must have atLeast one special character '
					})
				}
			}
			if (elm.name === 'new_user_name') {
				let maxCharacter = new RegExp('(?=.{3,8}$)')
				let allowedCharacter = /^[a-zA-Z0-9_.]+$/
				if (!maxCharacter.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'username must be Between 3 to 8 characters'
					})
				} else if (!allowedCharacter.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'username must not contain special characters'
					})

				}

			}
			if (elm.name === 'new_user_first_name') {
				const nameFormat = /^[a-zA-Z]+$/
				if (!nameFormat.test(elm.value)) {
					errorElements.push({
						element: elm,
						message: 'First name should not include any special characters or numbers '
					})
				}

			}
		})

		if (errorElements.length) {
			validateError(errorElements)
		} else {
			return true
		}
	}
	const loader = (id, status, name) => {
		const elm = document.getElementById(id)
		if (status) {
			elm.innerHTML = `
			 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="loading-btn" style="width:20px;height:20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
	 <circle cx="50" cy="50" fill="none" stroke="#fff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
	   <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
	 </circle>
			 `
			elm.disabled = true

		} else {
			elm.innerHTML = name
			elm.disabled = false

		}
	}

})(jQuery);
