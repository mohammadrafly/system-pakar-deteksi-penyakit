$(document).ready(function() {
    $('#SignIn').submit(function(event) {
        event.preventDefault();
  
        const usernameInput = $('#username');
        const passwordInput = $('#password');
  
        const username = usernameInput.val();
        const password = passwordInput.val();
    
        if (!username) {
          showAlert('error', 'Input Invalid', 'Username/Email tidak boleh kosong');
          return;
        }
  
        if (!password) {
          showAlert('error', 'Input Invalid', 'Password tidak boleh kosong.');
          return;
        }
  
        $.ajax({
            url: `${base_url}login`,
            type: 'POST',
            data: { username, password },
            dataType: 'JSON',
            success: function(response) {
              if (response.status) {
                swal.fire({
                  icon: response.icon,
                  title: response.title,
                  text: response.text,
                  showCancelButton: false,
                  showConfirmButton: false,
                  timer: 3000
                }).then (function(response) {
                  if (response.role == 'admin') {
                    window.location.href = `${base_url}dashboard`;
                  } else {
                    window.location.href = `${base_url}`;
                  }
                });
              } else {
                showAlert(response.icon, response.title, response.text);
              }
            },
            error: function(response) {
              showAlert(response.icon, response.title, response.text);
            }
        });
    });
  });
  
  function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text });
  }