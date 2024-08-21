$(document).ready(function () {


    $("#btn_registrarEmpleado").click(function (e) {
        e.preventDefault();
    
        var p_dni = $("#em_dni").val();
        var p_nombres = $("#em_nombre_empleado").val();
        var p_apellidos = $("#em_apellido_empleado").val();
        var p_numero_personal = $("#em_numero").val();
        var fecha = $("#em_fecha").val();
        var p_correo_personal = $("#em_correo_personal").val();
        var p_correo_institucional = $("#em_correo-institucional").val();
        var p_idcargo = $("#em-select-cargo").val();
        var p_idtipo_contrato = $("#em-tipo_contrato").val();
        var p_iddireccion_oficina = $("#em-select-direccion").val();
    
        // Fecha de ejemplo
        const date = new Date(fecha);
    
        // Arrays con los nombres de los días y los meses
        const days = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    
        // Obtener el día del mes
        const dayOfMonth = date.getDate() + 1;
    
        // Obtener el mes (número)
        const monthNumber = date.getMonth();
    
        // Obtener el nombre del mes
        const monthName = months[monthNumber];
    
    
        var p_fecha_cumpleaños = dayOfMonth;
        var p_mes_cumpleaños = monthName;
    
        const data = {
            registro_empleado: "registro_empleado",
            p_nombres: p_nombres,
            p_apellidos: p_apellidos,
            p_dni: p_dni,
            p_fecha_cumpleaños: p_fecha_cumpleaños,
            p_mes_cumpleaños: p_mes_cumpleaños,
            p_numero_personal: p_numero_personal,
            p_correo_personal: p_correo_personal,
            p_correo_institucional: p_correo_institucional,
            p_idcargo: p_idcargo,
            p_iddireccion_oficina: p_iddireccion_oficina,
            p_idtipo_contrato: p_idtipo_contrato,
        };
    
        //console.log(data);
    
        limpiarcampos_empleado();
    
        $.post('Assets/ajax/Ajax.empleado.php', data, function (response) {
            //console.log(response);
            if (response.trim() !== "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Empleado registrado exitosamente",
                    icon: "success",
                });
                listarEM();
                limpiarcampos_empleado();
            }
        })
    });
    


})



function limpiarcampos_empleado() {
    $("#em_dni").val('');
    $("#em_nombre_empleado").val('');
    $("#em_apellido_empleado").val('');
    $("#em_numero").val('');
    $("#em_fecha").val('');
    $("#em_correo_personal").val('');
    $("#em_correo-institucional").val('');
    $("#em-select-cargo").val('').change(); // Llamamos a change() para actualizar la apariencia del select
    $("#em-tipo_contrato").val('').change(); // Llamamos a change() para actualizar la apariencia del select
    $("#em-select-direccion").val('').change(); // Llamamos a change() para actualizar la apariencia del select

    // Remover las clases de validación
    $(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
    $(".valid-feedback, .invalid-feedback").text('');

    // Desactivar el botón de registro después de limpiar los campos
    $("#btn_registrarEmpleado").prop("disabled", true);
}

