$(document).ready(function () {
    $('#btn_registrar_direccion').click(function (e) {
        e.preventDefault();

        if ($('#txt_registrar_direccion').val() == '') {
            Swal.fire({
                title: "Oppsss...!",
                text: "Campo Vacio!",
                icon: "error"
                });
                return;
        }

        const data = {
            registrar_direccion         : 'registrar_direccion',
            txt_registrar_direccion     : $('#txt_registrar_direccion').val(),
        }

        $.post("Assets/ajax/Ajax.direccion.php", data, function (response) {
            if (response != 'ok') {
                Swal.fire({
                    title: "Oppsss...!",
                    text: response,
                    icon: "error"
                    });
            } else {
                Swal.fire({
                    title: "Exito...!",
                    text: "Registro Exitoso!",
                    icon: "success"
                    });
                    listardirecciones();
                $('#txt_registrar_direccion').val('');
            }
            }
        );


    })

})