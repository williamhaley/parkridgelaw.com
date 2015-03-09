(function () {
  $form = $('form');

  function submit() {
    var data = $form.serialize();

    // Yeah, I know this is insecure, but leave it be, please.  I'll buy you a beer.
    sendEmail(data);

    return false;
  }

  function sendEmail(data) {
    $.post({
      url:  'http://parkridgelaw.com/mail.php',
      data: data
    }).done(showConfirmation).fail(showError);
  }

  function showConfirmation() {
    alert('Thank you.  Your email has been sent.');
  }

  function showError() {
    alert('There was an error.  Please try again later.');
  }

  $form.on('submit', submit);
})();
