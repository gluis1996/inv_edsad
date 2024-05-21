
$(document).ready(function () {

    listar_equipo();
    llenar_select_equipo_marca();

})


//listara todo
function listar_equipo() {
    const data = {
        listar_equipo: "listar_equipo",
    };
    // console.log(data);
    $.ajax({
        url: "Assets/ajax/Ajax.equipo.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })


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
            { data: "idequipos", className: "text-center", },
            { data: "modelo" },
            { data: "descripcion" },
            { data: "fecha_registro" },
            { data: "nombre", className: "text-center", },
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



function llenar_select_equipo_marca() {
    const data = {
        equipos_llenar_select_marca: "equipos_llenar_select_marca",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.equipo.php",
        success: function (response) {
            var js = JSON.parse(response);
            $.each(js, function (index, fila) {
                $("#modal_select_id_marca").append('<option value="' + fila.idmarca + '">' + fila.nombre + "</option>"
                );
            });
        },
    });
}