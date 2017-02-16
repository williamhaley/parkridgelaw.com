(function () {
	var $form    = $('form');
	var $overlay = $('.overlay');

	function submit(event) {
		event.preventDefault();

		$overlay.show();

		var data = {};

		$form.serializeArray().map(function(item) {
			data[item.name] = item.value;
		});

		// Yeah, I know this is insecure, but leave it be, please. I'll buy you a beer.
		sendEmail(data);

		return false;
	}

	function sendEmail(data) {
		$.post('./mail.php', data).done(showConfirmation).fail(showError).always(hideOverlay);
	}

	function showConfirmation() {
		$form.get(0).reset();

		alert('Thank you. Your email has been sent.');
	}

	function showError() {
		alert('There was an error. Please try again later.');
	}

	function hideOverlay() {
		$overlay.hide();
	}

	function focusOnContactForm() {
		$form.find('input').get(0).focus();
	}

	$form.on('submit', submit);
})();

