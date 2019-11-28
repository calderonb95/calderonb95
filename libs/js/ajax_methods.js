function send_code(user_id) {
    email =  $('input[name="nmUserEmail"]').val();
    $.ajax({
        url: 'resend_authcode.php',
        type: 'POST',
        data: { 'user_id' : user_id, 'email' : email},
        success: function(data) {
            alert("Código de Verificación Enviado");
        }
    });
}