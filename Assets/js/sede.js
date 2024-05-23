
$(document).ready(function () { 

    listarS();

    $('#btn_registrarSede').click(function (e) {
        e.preventDefault();
        var nombre_sede = $('#nombre_sede').val();
        
        const data = {
            registro_sede : 'registro_sede',
            nombre_sede : nombre_sede,
        }

        $.post('Assets/ajax/Ajax.sede.php', data, function (response) {
            console.log(response);

        })
    })

})

//listara todo
function listarS() {
    const data = {
        lista_sede: "listasede",
    };

    $("#tb_lista_sede").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.sede.php",
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
            { data: "idsede", className: "text-center", },
            { data: "nombresed" },
            {data: "acciones",className: "text-center",}, // Centrar el contenido de la columna
            
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
