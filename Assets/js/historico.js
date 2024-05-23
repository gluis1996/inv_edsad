
$(document).ready(function () { 

    $('.btn_buscar_historico').click(function (e) {
        e.preventDefault();
        var id = $('#h_id_historico').val();
        console.log(id);

        listar_historico(id);

    });

})


//listara todo
function listar_historico(id) {
    const data = {
        h_buscar        : 'h_buscar',
        h_id_historico  :id,
    };
    console.log(data);
    $.ajax({
        url: "Assets/ajax/Ajax.historico.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })

    $("#tb_listar_historico").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.historico.php",
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
            { data: "id_historial" },
            { data: "id_detalle_asignacion" },
            { data: "nombre_sede" },
            { data: "nombre_oficina" },
            { data: "equipo" },
            { data: "nombre_usuario" },
            { data: "nombre_empleado", className: "text-center", },
            { data: "cod_patrimonial", className: "text-center", },
            { data: "vida_util", className: "text-center", },
            { data: "estado", className: "text-center", },
            { data: "fecha_asignacion", className: "text-center", },
            { data: "accion", className: "text-center", },
            { data: "fecha", className: "text-center", },
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