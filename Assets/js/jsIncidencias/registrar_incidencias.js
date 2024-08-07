$(document).ready(function () {

    //buscar incidencia

    $('.btn_buscar_equipo_asigando').click(function (e) {
        e.preventDefault();
        var id_asignacion = $("#codigo_patrimonial_buscar").val();


        const data = {
            as_buscar: 'as_buscar',
            id_detalle_asignacion: id_asignacion,
        }

        console.log(data);

        $.post("Assets/ajax/Ajax.asignacion.php", data,
            function (response) {
                try {
                    // Verifica si la respuesta no está vacía

                    if (!response) {
                        throw new Error('Response is empty');
                    }

                    var js = JSON.parse(response);
                    console.log(js);

                    // Verifica si js tiene la estructura esperada
                    if (!js.idempleado || !js.empleados) {
                        throw new Error('Invalid response structure');
                    }

                    var id_empleado = js.idempleado;
                    var emp = js.empleados;
                    var resul = emp.find(item => item.idempleado == id_empleado);

                    // Verifica si se encontró el empleado
                    if (!resul) {
                        throw new Error('Employee not found');
                    }

                    $("#ticket_nombre_empleado").val(resul.nombres);
                    $("#ticket_nombre_equipo").val(js.equipo);
                    $("#ticket_cod_patrimonial").val(js.cod_patrimonial);

                } catch (error) {
                    // Captura el error y muestra un mensaje de error
                    console.error('Error:', error.message);
                }
            }
        );

    });

    $("#btn_registrar_ticket").click(function (e) {
        e.preventDefault();

        var titulo = $("#ticket_titulo").val();
        var descripcion = $("#ticket_descripcion").val();

        var creado_por = $("#usuario_sesion").attr("id_lg_usuario");
        var equipo = $("#ticket_cod_patrimonial").val();
        var fecha_creacion = $("#ticket_fecha").val();
        var asignado_a = $("#ticket_asignacion").val();
        var estado = '';

        if (titulo == '' || descripcion == '' || fecha_creacion == '') {
            return alert('campo vacio');
        }

        if (asignado_a != "") {
            estado = 'en proceso';
        } else {
            estado = 'abierto';
        }

        const data = {
            event_ticket_registrar: 'event_ticket_registrar',
            datos: {
                p_title: titulo,
                p_description: descripcion,
                p_status: estado,
                p_created_by: creado_por,
                p_assigned_to: asignado_a,
                p_equipment_id: equipo,
                p_fecha: fecha_creacion,
            }
        }
        console.log(data);

        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                console.log(response);
                
                if (response != '"ok"') {
                    alert(response);
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "El ticket se registro con exito.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    listarticket();
                    limpiarCamposFormulario();
                }
                
            }
        );
    });

});


function limpiarCamposFormulario() {
    $("#ticket_nombre_empleado").val('');
    $("#ticket_cod_patrimonial").val('');
    $("#ticket_nombre_equipo").val('');
    $("#ticket_fecha").val('');
    $("#ticket_titulo").val('');
    $("#ticket_descripcion").val('');
    $("#ticket_asignacion").val('').trigger('change'); // Resetea el select y notifica a Select2 si lo usas
}