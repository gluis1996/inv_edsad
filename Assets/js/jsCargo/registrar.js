$(document).ready(function () {

    $('#btn_registrar_cargo').click(function (e) {
        e.preventDefault();

        if ($('#txt_registrar_cargo').val() == '') {
            Swal.fire({
                title: "Oppsss...!",
                text: "Campo Vacio!",
                icon: "error"
              });
              return;
        }

        const data = {
            registrar_cargo     : 'registrar_cargo',
            registrar_nombre    : $('#txt_registrar_cargo').val(),
        }

        $.post('Assets/ajax/Ajax.cargo.php', data, function (response) {
            if (response != 'ok') {
                Swal.fire({
                    title: "Oppsss...!",
                    text: response,
                    icon: "error"
                  });
            } else {
                Swal.fire({
                    title: "Oppsss...!",
                    text: "Registro Exitoso!",
                    icon: "success"
                  });
                listarcargo20();
            }
        })




        console.log(data);
    })

})