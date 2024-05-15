$(document).ready(function () { 

    $('#btn_registrarSede').click(function (e) {
        e.preventDefault();
        var nombre_sede = $('#nombre_sede').val();
        
        const data = {
            registro_sede : 'registro_sede',
            nombre_sede : nombre_sede,
        }

        $.post('Assets/ajax/Ajax.sede.php', data, function (response) {
            console.log(response);

        })
    })

})