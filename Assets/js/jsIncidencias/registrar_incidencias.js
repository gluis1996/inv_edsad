$(document).ready(function () {

    //buscar incidencia
    llenado_usuarios();

    $("#select_tipo_ticket").change(function (e) {
        e.preventDefault();
        var tipo_ticket = $("#select_tipo_ticket").val();
        console.log(tipo_ticket);

        if (tipo_ticket == 'SISTEMAS') {

            var div = `
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="codigo_patrimonial_buscar" placeholder="Buscar equipo x Codigo Patrimonial" aria-label="Buscar equipo x Codigo Patrimonial" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn_buscar_equipo_asigando" type="button" >Buscar</button>
                    </div>
                </div>
            `;


            $("#contenedor_imput").append(div);
        }

    });

    $('.btn_buscar_equipo_asigando').click(function (e) {
        e.preventDefault();
        var id_asignacion = $("#codigo_patrimonial_buscar").val();


        const data = {
            as_buscar: 'as_buscar',
            id_detalle_asignacion: id_asignacion,
        }

        //console.log(data);

        $.post("Assets/ajax/Ajax.asignacion.php", data,
            function (response) {
                try {
                    // Verifica si la respuesta no está vacía

                    if (!response) {
                        throw new Error('Response is empty');
                    }

                    var js = JSON.parse(response);
                    ////console.log(js);

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
                    //console.error('Error:', error.message);
                }
            }
        );

    });


    $('.btn_buscar_empleado').click(function (e) {
        e.preventDefault();
        var dni_empleado = $("#txt_cod_empleado").val();

        const data = {
            buscar_empleado_dni: 'buscar_empleado_dni',
            dni_empleado: dni_empleado,
        }

        //console.log(data);

        $.post("Assets/ajax/Ajax.empleado.php", data,
            function (response) {
                try {
                    // Parsear la respuesta
                    var js = JSON.parse(response);
                    ////console.log(js);

                    // Asegúrate de que la respuesta es un array y tiene al menos un elemento
                    if (Array.isArray(js) && js.length > 0) {
                        var empleado = js[0]; // Obtener el primer elemento del array

                        // Asignar los valores a los campos del formulario
                        $("#ticket_nombre_empleado").val(empleado.nombres + ' ' + empleado.apellidos);
                        $("#ticket_cod_patrimonial").val(empleado.dni);
                        $("#ticket_nombre_equipo").val('otros');

                    } else {
                        // Manejo en caso de que no se reciban datos válidos
                        //console.error('No se encontraron datos de empleado');
                    }

                } catch (error) {
                    // Captura el error y muestra un mensaje de error
                    //console.error('Error:', error.message);
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
        var fecha = $("#ticket_fecha").val();
        var asignado_a = $("#ticket_asignacion").val();
        var estado = '';

        var dateObject = new Date(fecha);

        // Paso 4: Formatear la fecha y hora en el formato deseado
        var year = dateObject.getFullYear();
        var month = String(dateObject.getMonth() + 1).padStart(2, '0'); // Mes (0-11), así que añadimos 1 y rellenamos con ceros
        var day = String(dateObject.getDate()).padStart(2, '0');
        var hours = String(dateObject.getHours()).padStart(2, '0');
        var minutes = String(dateObject.getMinutes()).padStart(2, '0');
        var seconds = String(dateObject.getSeconds()).padStart(2, '0');

        var fecha_creacion = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

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
        //console.log(data);

        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                //console.log(response);

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


function llenado_usuarios() {

    const data = {
        lista_usuario: 'listausuario',
    }

    $.post("Assets/ajax/Ajax.usuario.php", data,
        function (response) {
            //console.log(response);
            var js = JSON.parse(response);

            js.data.forEach(element => {
                $("#ticket_asignacion").append(
                    $('<option>', {
                        value: element.idusuario,
                        text: element.nombres
                    })
                );
            });

        }
    );

}

function limpiarCamposFormulario() {
    $("#ticket_nombre_empleado").val('');
    $("#ticket_cod_patrimonial").val('');
    $("#ticket_nombre_equipo").val('');
    $("#ticket_fecha").val('');
    $("#ticket_titulo").val('');
    $("#ticket_descripcion").val('');
    $("#ticket_asignacion").val('').trigger('change'); // Resetea el select y notifica a Select2 si lo usas
}