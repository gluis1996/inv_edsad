$(document).ready(function() {
    listar_adquisicion();
});

function adq_llenar_select_area() {
    
}



//listara todo
function listar_adquisicion() {
    const data = {
        ad_listar: "ad_listar",
    };

    $.ajax({
        url: "Assets/ajax/Ajax.adquisicion.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })


    $("#tbl_detalle_adquisicion").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.adquisicion.php",
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
            { data: "id", className: "text-center", },
            { data: "area_nombre" },
            { data: "beneficiario_nombre" },
            { data: "equipo" },
            { data: "meta_nombre" },
            { data: "año" },
            { data: "cantidad", className: "text-center", },
            { data: "accion", className: "text-center", },
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



