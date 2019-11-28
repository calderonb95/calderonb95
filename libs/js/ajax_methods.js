function send_code(user_id) {
    $.ajax({
        url: 'resend_authcode.php',
        type: 'POST',
        data: { 'user_id': user_id },
        success: function(data) {
            alert("Código de Verificación Enviado");
        }
    });
}