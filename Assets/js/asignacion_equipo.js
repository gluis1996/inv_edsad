$(document).ready(function () {
    listar();
    llenar_select_sede();
    llenar_select_equipo();
    llenar_select_empleado();
    // Añadir evento change al select de sedes
    $("#id_sede").change(function () {
        llenar_select_oficina();
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

        // console.log(data);
        $.post("Assets/ajax/Ajax.asignacion.php", data, function (response) {
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response ,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Registrado exitosamente el equipo",
                    icon: "success",
                });           
            }
        });
    });

    //Activar o desactivar del ml
    $('#tb_asignacion_equipos').on("click","[id^='detalle_id_']",function (e){
        e.preventDefault();
        var id = $(this).attr("id");
        console.log(id);
    })



});

//listara todo
function listar() {
    const data = {
        listarAE: "listarAE",
    };

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
        ordering: true, // Quitar la capacidad de ordenar
        pageLength: 10, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "id_detalle_asignacion", className: "text-center",},
            { data: "sede_nombres" },
            { data: "oficina_nombres" },
            { data: "equipo" },
            { data: "usuario_nombre" },
            { data: "empleado_nombre" },
            { data: "cod_patrimonial", className: "text-center",},
            { data: "vida_util", className: "text-center",},
            { data: "estado" , className: "text-center",},
            { data: "fecha_asignacion", className: "text-center",},
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

function llenar_select_oficina() {
    const id_sede = $("#id_sede").val();

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
                $("#id_oficina")
                    .empty()
                    .append('<option value="">Seleccione una oficina</option>');

                $.each(js, function (index, fila) {
                    $("#id_oficina").append(
                        '<option value="' +
                        fila.idoficinas +
                        '">' +
                        fila.nombres +
                        "</option>"
                    );
                });
            },
        });
    } else {
        // Si no hay una sede seleccionada, limpiar el select de oficinas
        $("#id_oficina")
            .empty()
            .append('<option value="">Seleccione una oficina</option>');
    }
}

function llenar_select_equipo() {
    const data = {
        listar_equipo: "listar_equipo",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (respose) {
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#id_equipo").append('<option value="' +fila.idequipos +'">' + fila.descripcion +  " - " +  fila.modelo + " - " + fila.nombre + "</option>" );
            });
            $("#id_equipo").select2();
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
                $("#id_empleado").append('<option value="' +fila.idempleado +'">' +fila.nombres +"</option>"
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
    $("#vid_util").val("");
}