//checking availability
function checkemail() {
  var emailAdd = document.getElementById('email').value;

  if (emailAdd) {
    $.ajax({
      type: 'post',
      url: 'check-availability.php',
      data: {
        user_email: emailAdd,
      },
      success: function (response) {
        $('#availability').html(response);

        if (response == 'Email is available for registration.') {
          return true;
        } else {
          return false;
        }
      },
    });
  } else {
    $('#availability').html('');
    return false;
  }
}
//checking availability
