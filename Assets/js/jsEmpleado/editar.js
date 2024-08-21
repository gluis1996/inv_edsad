$(document).ready(function () {

    $("#btn_editarEmpleado").click(function (e) {
        e.preventDefault();
        const data = {
            empleado_editar: 'empleado_editar',
            valor: {
                edit_id_empleado:           $("#em_edit_codigo").val(),
                edit_nombre:                $("#em_edi_nombre_empleado").val(),
                edit_apellido:              $("#em_edi_apellido_empleado").val(),
                edit_dni:                   $("#em_edi_dni").val(),
                edit_numero:                $("#em_edi_numero").val(),
                edit_correo_perosnal:       $("#em_edi_correo_personal").val(),
                edit_correo_institucional:  $("#em_edi_correo-institucional").val(),
                edit_dia:                   $("#em_edi_dia").val() || 'SIN DIA',
                edit_mes:                   $("#em_edi_mes").val() || 'SIN MES',
                edit_cargo:                 $("#em_edi_select_cargo").val(),
                edit_contrato:              $("#em_edi_tipo_contrato").val(),
                edit_direccion:             $("#em_edi_select_direccion").val(),
            }
        }

        $.post('Assets/ajax/Ajax.empleado.php', data, function (response) {
            var js = JSON.parse(response);
            //console.log(js);
            if (response.trim() !== '"ok"') {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Empleado editado exitosamente",
                    icon: "success",
                });
                listarEM();
                limpiarCampos_campos();
            }
        })
    });

});

function limpiarCampos_campos() {
    $("#em_edit_codigo").val('');
    $("#em_edi_nombre_empleado").val('');
    $("#em_edi_apellido_empleado").val('');
    $("#em_edi_dni").val('');
    $("#em_edi_numero").val('');
    $("#em_edi_correo_personal").val('');
    $("#em_edi_correo-institucional").val('');
    $("#em_edi_dia").val('');
    $("#em_edi_mes").val('');
    $("#em_edi_select_cargo").val('');
    $("#em_edi_tipo_contrato").val('');
    $("#em_edi_select_direccion").val('');
}