$(document).ready(function () {

    $(".btn_modal_marca_ver").click(function () {
        $("#modal_listar_marca").modal('show');
        listar_marca();
    });


    // LISTAR MODAL
    // Llenar datos en el modal editar registro  /// captura los id de lo botones
    $('#tb_listar_marca').on("click", ".btn_modal_marca_editar", function (e) {
        e.preventDefault();
        var marca_id = $(this).attr('id_marca');
        var marca_nombre = $(this).attr('nombre_marca');

        // Asigna los valores a los campos del modal
        $('#modal_editar_nombre_marca').val(marca_nombre);
        $('#modal_editar_marca_id').val(marca_id);
        // Abre el modal de edición
        $('#modal_editar_marca').modal('show');
    });

    

    $('.btn_editar_marca').click(function (e) {
        e.preventDefault();
        
        // Obtén los valores de los campos del modal
        var editar_marca_nombre = $('#modal_editar_nombre_marca').val();
        var editar_marca_id = $('#modal_editar_marca_id').val();

        if (editar_marca_nombre == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Campo vacío "nombre"',
                icon: "error",
            });
            return;
        }

        if (editar_marca_id == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Campo vacío "ID"',
                icon: "error",
            });
            return;
        }

        const data = {
            marca_editar: 'marca_editar',
            marca_nombre: editar_marca_nombre,
            marca_id: editar_marca_id,
        }

        console.log(data);
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, editar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('Assets/ajax/Ajax.marca.php', data, function (response) {
                    // console.log(response); //para ver en la consola
                    if (response.trim() != "ok") {
                        Swal.fire({
                            title: "Oppps....",
                            text: response,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            title: "Editado",
                            text: "Editado exitosamente!",
                            icon: "success",
                        });
                        listarM();
                        $('#modal_editar_nombre_marca').val('');
                        $('#modal_editar_marca_id').val('');
                    }
                });
            }
        });
    });
});

//listara todo
function listar_marca() {
    const data = {
        marca_listar: "marca_listar",
    };
    // console.log(data);
    $.ajax({
        url: "Assets/ajax/Ajax.marca.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })


    $("#tb_listar_marca").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.marca.php",
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
            { data: "idmarca", className: "text-center", },
            { data: "nombre", className: "text-center", },
            { data: "acciones", className: "text-center", },
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

