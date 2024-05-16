
$(document).ready(function () { 

    $('#btn_registrarOficina').click(function (e) {
        e.preventDefault();
        var nombre_oficina = $('#nombre_oficina').val();
        var idsede = $('#id_sede').val();
        
        const data = {
            registro_oficina : 'registro_oficina',
            nombre_oficina : nombre_oficina,
            id_sede : idsede,
        }

        $.post('Assets/ajax/Ajax.oficina.php', data, function (response) {
            console.log(response);

        })
    })

})