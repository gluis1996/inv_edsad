
$(document).ready(function () { 

    listar_equipo();

})


//listara todo
function listar_equipo() {
    const data = {
        listar_equipo: "listar_equipo",
    };

    $("#tb_listar_equipos").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.equipo.php",
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