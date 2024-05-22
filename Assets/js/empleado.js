$(document).ready(function () {
    listar();
    $('#btn_registrarEmpleado').click(function (e) {
        e.preventDefault();
        var nombre_empleado = $('#nombre_empleado').val();

        // console.log(nombre_empleado);

        const data = {
            registro_empleado: 'registro_empleado',
            nombre_empleado: nombre_empleado,
        }

        $.post('Assets/ajax/Ajax.empleado.php', data, function (response) {
            console.log(response);
            if (response.trim() !== "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Agregados exitosamente",
                    icon: "success",
                });
                listar();
            }     
        })



    })





    //llenar datos en el modal editar registro
    $('#tb_registrar_empleados').on("click", ".btn_listar_equipo_empleado", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_empleado');
        console.log(id);
        listar_equipo_empleado(id);

    })

    //llenar datos en el modal editar registro  /// captura los id de lo botones
    $('#tb_registrar_empleados').on("click", ".btn_eliminar_empleado", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_empleado_el');
        console.log(id);
        const data = {
            id_eliminar_empleado : 'id_eliminar_empleado',
            idempleado : id,
        }
        $.post('Assets/ajax/Ajax.empleado.php', data, function (response) {
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
                    var table = $('#tb_registrar_empleados').DataTable();
                    table.row(row).remove().draw();
                }, 500); // Esperar a que la animación termine
            }            

        })
    })



})



//listara todo
function listar() {
    const data = {
        lista_empleado: "lista_empleado",
    };

    $("#tb_registrar_empleados").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.empleado.php",
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
            { data: "idempleado", className: "text-center", },
            { data: "nombres" },
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



//listara todo
function listar_equipo_empleado(id) {
    const data = {
        listar_equipo_empleado: "listar_equipo_empleado",
        idempleado: id,
    };

    $.ajax({
        url: "Assets/ajax/Ajax.empleado.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })

    $("#tb_listar_equipo_empleados").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.empleado.php",
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
            { data: "idempleado", className: "text-center", },
            { data: "nombre_empleado", className: "text-center", },
            { data: "nombre_equipo", className: "text-center", },
            { data: "id_detalle_asignacion", className: "text-center", },
            { data: "cod_patrimonial", className: "text-center", },
            { data: "nombre_sede", className: "text-center", },
            { data: "nombre_oficina" },
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