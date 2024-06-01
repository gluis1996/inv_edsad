$(document).ready(function () {
    listar();
    llenar_select_sede();
    llenar_select_equipo();
    llenar_select_empleado();
    llenar_select_asigancion_marca();
    
    //mostrar modal registrar
    $(".btn_modal_asignacion_mostrar").click(function () {
        $("#modal_asignacion_registrar").modal('show');
    });
    
    //mostrar modal registrar cerra
    $(".close").click(function () {
        $("#modal_asignacion_registrar").modal('hide');
    });


    // Añadir evento change al select de sedes
    $("#id_sede").change(function () {
        llenar_select_oficina('id_sede', 'id_oficina');
    });

    // Añadir evento change al select de sedes
    $("#id_equipo_marca").change(function () {
        llenar_select_equipo();
    });


    $(".btnRegistrar_asignacion").click(function (e) {
        e.preventDefault();
        var idsede = $("#id_sede").val();
        var id_equipo = $("#id_equipo").val();
        var id_empleado = $("#id_empleado").val();
        var cod_patrimonial = $("#cod_patrimonial").val();
        var fecha = $("#fecha").val();
        var id_oficina = $("#id_oficina").val();
        var id_estado = $("#id_estado").val();
        var vid_util = $("#vid_util").val();
        var id_usuario = $("#usuario_sesion").attr("id_lg_usuario");

        const data = {
            as_registrar: "as_registrar",
            idsede: idsede,
            id_equipo: id_equipo,
            id_empleado: id_empleado,
            cod_patrimonial: cod_patrimonial,
            fecha: fecha,
            id_oficina: id_oficina,
            id_estado: id_estado,
            vid_util: vid_util,
            id_usuario: id_usuario,
        };

        console.log(data);
        $.post("Assets/ajax/Ajax.asignacion.php", data, function (response) {
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Registrado exitosamente el equipo",
                    icon: "success",
                });
                listar();
                limpiar();
                $("#modal_asignacion_registrar").modal('hide');
            }
        });
        
    });

    //Eliminar Registro.
    $('#tb_asignacion_equipos').on("click", "[id^='eliminar_id_']", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_detalle_asignacion");
        console.log(id);

        const data = {
            as_eleminar: 'as_eleminar',
            id_detalle_asignacion: id,
        }

        Swal.fire({
            title: "Estas seguro",
            text: "¡No podrás revertir esto!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("Assets/ajax/Ajax.asignacion.php", data, function (response) {
                    if (response != "ok") {
                        Swal.fire({
                            title: "Oppps....",
                            text: response,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted",
                            text: "Eliminado exitosamente",
                            icon: "success",
                        });
                        // Eliminar la fila con transición
                        var row = $(e.target).closest('tr');
                        row.addClass('fade-out');
                        setTimeout(function () {
                            var table = $('#tb_asignacion_equipos').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                })
            }
        })


    })

    //llenar datos en el modal editar registro
    $('#tb_asignacion_equipos').on("click", "[id^='detalle_id_']", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_detalle_asignacion");
        console.log(id);

        const data = {
            as_buscar: 'as_buscar',
            id_detalle_asignacion: id,
        }
        //console.log(data);

        $.post("Assets/ajax/Ajax.asignacion.php", data, function (response) {
            var jsonResponse = JSON.parse(response);
            // console.log(response);
            // console.log(jsonResponse.idoficina);
            $('#modal_text_asig_id').val(jsonResponse.idregistro);
            $('#modal_text_asig_cod_patrimonial').val(jsonResponse.cod_patrimonial);
            $('#modal_text_asig_vida_util').val(jsonResponse.vidautil);
            $('#modal_text_asig_equipo').val(jsonResponse.equipo);
            $('#modal_select_asig_estado').val(jsonResponse.estado);
            $('#modal_text_asig_usuario').val(jsonResponse.usuario);
            $('#modal_text_asig_fecha').val(jsonResponse.fecha);

            $('#modal_select_asig_sede').empty();
            $('#modal_select_asig_oficina').empty();
            $('#modal_select_asig_empleado').empty();

            // Iterar sobre los empleados y agregarlos al select
            jsonResponse.sede.forEach(function (sede) {
                $('#modal_select_asig_sede').append($('<option>', {
                    value: sede.idsedes,
                    text: sede.nombres
                }));
            });

            // Iterar sobre los empleados y agregarlos al select
            jsonResponse.oficina.forEach(function (oficina) {
                $('#modal_select_asig_oficina').append($('<option>', {
                    value: oficina.idoficinas,
                    text: oficina.nombres
                }));
            });

            // Iterar sobre los empleados y agregarlos al select
            jsonResponse.empleados.forEach(function (empleados) {
                $('#modal_select_asig_empleado').append($('<option>', {
                    value: empleados.idempleado,
                    text: empleados.nombres
                }));
            });

            $('#modal_select_asig_sede').val(jsonResponse.idsede);
            $('#modal_select_asig_oficina').val(jsonResponse.idoficina);
            $('#modal_select_asig_empleado').val(jsonResponse.idempleado);


        });
        // Añadir evento change al select de sedes
        $("#modal_select_asig_sede").change(function () {
            llenar_select_oficina('modal_select_asig_sede', 'modal_select_asig_oficina');
        });

    })

    $('.modal_btn_editar_detalle').click(function (e) {
        e.preventDefault();
        var idregistro = $('#modal_text_asig_id').val();
        var modal_select_asig_sede = $('#modal_select_asig_sede').val();
        var modal_select_asig_oficina = $('#modal_select_asig_oficina').val();
        var modal_text_asig_equipo = $('#modal_text_asig_equipo').val();
        var modal_text_asig_usuario = $('#modal_text_asig_usuario').val();
        var modal_select_asig_empleado = $('#modal_select_asig_empleado').val();
        var modal_text_asig_cod_patrimonial = $('#modal_text_asig_cod_patrimonial').val();
        var modal_text_asig_vida_util = $('#modal_text_asig_vida_util').val();
        var modal_select_asig_estado = $('#modal_select_asig_estado').val();
        var modal_text_asig_fecha = $('#modal_text_asig_fecha').val();
        var id_usuario = $("#usuario_sesion").attr("id_lg_usuario");

        const data = {
            asigancion_editar: 'asigancion_editar',
            idregistro: idregistro,
            modal_select_asig_sede: modal_select_asig_sede,
            modal_select_asig_oficina: modal_select_asig_oficina,
            modal_text_asig_equipo: modal_text_asig_equipo,
            modal_text_asig_usuario: modal_text_asig_usuario,
            modal_select_asig_empleado: modal_select_asig_empleado,
            modal_text_asig_cod_patrimonial: modal_text_asig_cod_patrimonial,
            modal_text_asig_vida_util: modal_text_asig_vida_util,
            modal_select_asig_estado: modal_select_asig_estado,
            modal_text_asig_fecha: modal_text_asig_fecha,
            id_usuario:id_usuario
        };

        console.log(data);

        $.post("Assets/ajax/Ajax.asignacion.php",data,function (response) {  
            if (response != '"ok"') {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                $('#modal_asignacion_editar').modal('hide');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Se guardo cambios",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $('#modal_asignacion_editar').modal('hide');
                    listar(); // Llamar a la función listar después de que se cierre el SweetAlert
                });
            }
        })


    })

});///fin dom


//listara todo
function listar() {
    const data = {
        listarAE: "listarAE",
    };
    // $.ajax({
    //     url: "Assets/ajax/Ajax.asignacion.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         console.log(response);
    //     }
    // })

    $("#tb_asignacion_equipos").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.asignacion.php",
            type: "POST",
            data: data,
        },
        paging: true, // Quitar paginación
        searching: true, // Quitar barra de búsqueda
        info: true, // Quitar información de registros
        ordering: false, // Quitar la capacidad de ordenar
        pageLength: 10, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "id_detalle_asignacion", className: "text-center", },
            { data: "sede_nombres" },
            { data: "oficina_nombres" },
            { data: "equipo" },
            { data: "usuario_nombre" },
            { data: "empleado_nombre" },
            { data: "cod_patrimonial", className: "text-center", },
            { data: "vida_util", className: "text-center", },
            { data: "estado", className: "text-center", },
            { data: "fecha_asignacion", className: "text-center", },
            {
                data: "acciones",
                className: "text-center", // Centrar el contenido de la columna
            },
        ],
        dom: "lfrtip", // Eliminar algunos elementos de la interfaz
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando página _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
    });
}

function llenar_select_sede() {
    const data = {
        listar_sede_en_select: "listar_sede_en_select",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (respose) {
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#id_sede").append(
                    '<option value="' + fila.idsedes + '">' + fila.nombres + "</option>"
                );
            });
        },
    });
}

function llenar_select_oficina(sede, ofi) {
    const id_sede = $("#" + sede).val();

    if (id_sede) {
        const data = {
            listar_oficinas_por_sede: "listar_oficinas_por_sede",
            id_sede: id_sede,
        };

        $.ajax({
            type: "POST",
            data: data,
            url: "Assets/ajax/Ajax.asignacion.php",
            success: function (response) {
                var js = JSON.parse(response);

                // Limpiar las opciones actuales del select de oficinas
                $("#" + ofi).empty().append('<option value="">Seleccione una oficina</option>');

                $.each(js, function (index, fila) {
                    $("#" + ofi).append(
                        '<option value="' +fila.idoficinas +'">' + fila.nombres + "</option>"
                    );
                });
            },
        });
    } else {
        // Si no hay una sede seleccionada, limpiar el select de oficinas
        $("#" + ofi)
            .empty()
            .append('<option value="">Seleccione una oficina</option>');
    }
}

//llenar select marca
function llenar_select_asigancion_marca() {
    const data = {
        listar_equipo_marca: "listar_equipo_marca",
    };
// console.log(data);
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (response) {
            //console.log(response);
            var js = JSON.parse(response);
            var $select = $("#id_equipo_marca");
            $("#id_equipo_marca").empty().append('<option value="0">Seleccione una Marca</option>');
            $.each(js, function (index, fila) {
                $select.append('<option value="' + fila.idmarca + '">' + fila.nombre+ "</option>");
            });

        },
    });
}

function llenar_select_equipo() {
    const idmarca = $("#id_equipo_marca").val();
    const data = {
        listar_equipo: "listar_equipo",
        id_marca: idmarca,
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (response) {
            console.log(response);
            var js = JSON.parse(response);
            var $select = $("#id_equipo");
            // Limpiar las opciones actuales del select de oficinas
            $("#id_equipo").empty().append('<option value="0">Seleccione un equipo</option>');
            $.each(js, function (index, fila) {
                $select.append('<option value="' + fila.idequipos + '">' + fila.descripcion + " - " + fila.modelo + "</option>");
            });

        },
    });
}

function llenar_select_empleado() {
    const data = {
        listar_empleado: "listar_empleado",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (respose) {
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#id_empleado").append('<option value="' + fila.idempleado + '">' + fila.nombres + "</option>"
                );
            });
        },
    });
}

function limpiar() {

    $("#id_sede").val(0);
    $("#id_empleado").val(0);
    $("#cod_patrimonial").val("");
    $("#fecha").val("");
    $("#id_oficina").val(0);
    $("#id_estado").val(0);
    $("#id_equipo").val(0);
    $("#id_equipo_marca").val(0);
    $("#vid_util").val("");
}