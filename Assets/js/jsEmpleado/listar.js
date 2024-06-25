$(document).ready(function () {

    listarEM();

})
//listara todo
function listarEM() {
    const data = {
        lista_empleado: "lista_empleado",
    };

    //    console.log(data);
    // $.ajax({
    //     url: "Assets/ajax/Ajax.empleado.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         console.log(response);
    //     }
    // })

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
        pageLength: 3, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "nombres" },
            { data: "dni" },
            { data: "numero" },
            { data: "correo" },
            { data: "cargo" },
            { data: "contrato" },
            { data: "cantidad", className: "text-center" },
            { data: "acciones"},
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
