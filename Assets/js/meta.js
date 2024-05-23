
$(document).ready(function () {
    listarM();
    $('#btn_registrar_meta').click(function (e) {
        e.preventDefault();
        var nombremeta = $('#nombre_meta').val();

        // console.log(nombre_empleado);

        const data = {
            registro_meta: 'registrometa',
            nombre_meta: nombremeta,
        }

        $.post('Assets/ajax/Ajax.meta.php', data, function (response) {
            console.log(response);
            if (response.trim() !== "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Meta registrado exitosamente",
                    icon: "success",
                });
                listarM();
            }     
        })

    })



})



//listara todo
function listarM() {
    const data = {
        lista_meta: "listameta",
    };

    $("#tb_lista_meta").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.meta.php",
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
            { data: "idmet", className: "text-center", },
            { data: "nombremt" },
            { data: "acciones",className: "text-center", },// Centrar el contenido de la columna
            
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


