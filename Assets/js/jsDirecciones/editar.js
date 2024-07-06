$(document).ready(function () {

    $("#tb_lista_direccion").on("click", "#id_direccion_buscar", function (e) {
        
        $("#txt_editar_direccion").val($(this).attr("nombre_direccion"));
        $("#txt_editar_id_direccion").val($(this).attr("iddireccion_oficina"));

    })

    $("#btn_editar_direccion").click(function (e) { 
        e.preventDefault();
        
        if ($('#txt_editar_direccion').val() == '') {
            Swal.fire({
                title: "Oppsss...!",
                text: "Campo Vacio!",
                icon: "error"
                });
                return;
        }

        const data = {
            editar_direccion        :   'editar_direccion',
            dato                    :   {
                                        txt_editar_direccion        :   $('#txt_editar_direccion').val(),
                                        txt_editar_id_direccion     :   $('#txt_editar_id_direccion').val(),
            },
            
        }

        $.post("Assets/ajax/Ajax.direccion.php", data,
            function (response) {
                if (response != 'ok') {
                    Swal.fire({
                        title: "Oppsss...!",
                        text: response,
                        icon: "error"
                        });
                } else {
                    Swal.fire({
                        title: "Exito...!",
                        text: "Edicion Exitoso!",
                        icon: "success"
                        });
                        listardirecciones();
                    $('#txt_editar_direccion').val('');
                }                
            }
        );

    });

})