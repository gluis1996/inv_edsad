
$(document).ready(function () { 

    
    listar();


})

//listara todo

function listar() {
    const data = {
        listarAE: 'listarAE',
    }
    console.log(data);
    $.ajax({
        url: "Assets/ajax/Ajax.asignacion.php",
        data: data,
        type: 'POST',
        success: function (response) {
            //var j = JSON.parse(response);
            console.log(response);
        }
    })

    $('#asignacion_equipos').DataTable({
        "destroy": true,
        "ajax": {
            "url": "Assets/ajax/Ajax.asignacion.php",
            "type": "POST",
            "data": data
        },
        
        "paging": true,       // Quitar paginación
        "searching": true,    // Quitar barra de búsqueda
        "info": true,         // Quitar información de registros
        "ordering": true,     // Quitar la capacidad de ordenar
        "pageLength": 10,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "responsive": true,   // Hacer la tabla responsiva
        "columns": [
            { "data": "id_detalle_asignacion" },
            { "data": "sede_nombres" },
            { "data": "oficina_nombres" },
            { "data": "equipo" },
            { "data": "usuario_nombre" },
            { "data": "cod_patrimonial" },
            { "data": "vida_util" },
            { "data": "estado" },
            { "data": "fecha_asignacion" },
            { "data": "acciones" }

        ],
        "dom": 'lfrtip', // Eliminar algunos elementos de la interfaz
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}