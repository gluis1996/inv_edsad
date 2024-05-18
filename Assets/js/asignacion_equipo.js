
$(document).ready(function () {


    listar();
    llenar_select_sede();
    llenar_select_oficina();

})

//listara todo
function listar() {
    const data = {
        listarAE: 'listarAE',
    }
    // console.log(data);
    // $.ajax({
    //     url: "Assets/ajax/Ajax.asignacion.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         //var j = JSON.parse(response);
    //         console.log(response);
    //     }
    // })

    $('#tb_asignacion_equipos').DataTable({
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

function llenar_select_sede() {
    const data = {
        listar_sede_en_select: 'listar_sede_en_select',
    };
    $.ajax({
        type: 'POST',
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (respose) {
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#id_sede").append('<option value="' + fila.idsedes + '">' + fila.nombres + '</option>');
            });
        }
    })
}


function llenar_select_oficina() {
    const id_sede =  $("#id_sede").val();

    if (id_sede) {
        const data = {
            listar_oficinas_por_sede: 'listar_oficinas_por_sede',
            id_sede: id_sede
        };

        $.ajax({
            type: 'POST',
            data: data,
            url: "Assets/ajax/Ajax.asignacion.php",
            success: function (response) {
                var js = JSON.parse(response);

                // Limpiar las opciones actuales del select de oficinas
                $("#id_oficina").empty().append('<option value="">Seleccione una oficina</option>');

                $.each(js, function (index, fila) {
                    $("#id_oficina").append('<option value="' + fila.idoficinas + '">' + fila.nombres + '</option>');
                });
            }
        });
    } else {
        // Si no hay una sede seleccionada, limpiar el select de oficinas
        $("#id_oficina").empty().append('<option value="">Seleccione una oficina</option>');
    }
}