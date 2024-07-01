$(document).ready(function () {

    listarcargo20();

})
//listara todo
function listarcargo20() {
    const data = {
        listar_cargo: "listar_cargo",
    };

    // console.log(data);
    // $.ajax({
    //     url: "Assets/ajax/Ajax.cargo.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         console.log(response);
    //     }
    // })

    $("#tb_lista_cargo").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.cargo.php",
            type: "POST",
            data: data,
        },
        paging: true, // Quitar paginación
        searching: true, // Quitar barra de búsqueda
        info: true, // Quitar información de registros
        ordering: true, // Quitar la capacidad de ordenar
        pageLength: 8, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "idcargo" },
            { data: "nombre_cargo" },
            { data: "acciones", className: "text-center" },
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
