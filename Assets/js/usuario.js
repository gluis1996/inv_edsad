$(document).ready(function () { 

    $('#btn_registrar_usuario').click(function (e) {
        e.preventDefault();
        var nombre_usuario = $('#nombre_usuario').val();
        var user = $('#user').val();
        var contraseña = $('#contraseña').val();
        
        const data = {
            registro_usuario : 'registro_usuario',
            nombre_usuario : nombre_usuario,
            user : user,
            contra : contraseña,

        }

        $.post('Assets/ajax/Ajax.usuario.php', data, function (response) {
            console.log(response);

        })
    })

})