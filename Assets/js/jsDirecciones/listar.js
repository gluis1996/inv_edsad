$(document).ready(function () {

    listardirecciones();

})

//listara todo
function listardirecciones() {
    const data = {
        listar_direcciones: "listar_direcciones",
    };

    $("#tb_lista_direccion").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.direccion.php",
            type: "POST",
            data: data,
        },
        paging: true, // Quitar paginación
        searching: true, // Quitar barra de búsqueda
        info: true, // Quitar información de registros
        ordering: true, // Quitar la capacidad de ordenar
        pageLength: 6, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "iddireccion_oficina" },
            { data: "nombre_direccion" },
            { data: "acciones", className: "text-center" },
        ],
        order: [[0, "desc"]], // Ordenar por la columna 'idcargo' en forma descendente
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
