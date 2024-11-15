$(document).ready(function() {
      
    $('#login_form').submit(function(e) {

      e.preventDefault();
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var formData = {
          email: $('#email').val(),
          password: $('#password').val(),
          csrfToken: csrfToken  // Attach CSRF token
      };

      if(formData.email == '' || formData.password == '') {
          $('#error_message').html('Please fill in all fields');
          return false;
      }

      $.ajax({
          url: 'index.php?url=submit_login',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response) {

            if (response.status == 'success') {

                alert(response.message);
                window.location.href = 'index.php?url=dashboard';
                $('#error_message').text('');

            } else {

                $('#error_message').html(response.message);

            }

          },
          error: function(xhr, status, error) {
              alert('An error occurred: ' + error);
          }
      });

    });
});