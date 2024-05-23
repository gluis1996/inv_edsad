
$(document).ready(function () { 

    listarO();

    $('#btn_registrarOficina').click(function (e) {
        e.preventDefault();
        var nombre_oficina = $('#nombre_oficina').val();
        var idsede = $('#id_sede').val();
        
        const data = {
            registro_oficina : 'registroOficina',
            nombre_oficina : nombre_oficina,
            id_sede : idsede,
        }

        $.post('Assets/ajax/Ajax.oficina.php', data, function (response) {
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
                    text: "Oficina registrado exitosamente",
                    icon: "success",
                });
                listarO();
            } 

        })
    })

})



//listara todo
function listarO() {
    const data = {
        lista_oficina: "listaoficina",
    };
        // console.log(data);
        // $.ajax({
        //     url: "Assets/ajax/Ajax.oficina.php",
        //     data: data,
        //     type: 'POST',
        //     success: function (response) {
        //     console.log(response);
        //     }
        // })

    $("#tb_lista_oficina").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.oficina.php",
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
            { data: "idofi", className: "text-center", },
            { data: "nombreofi" },
            { data: "nombresede" },
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
