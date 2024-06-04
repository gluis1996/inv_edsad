
$(document).ready(function () {
    listarM();
    $('#btn_registrar_meta').click(function (e) {
        e.preventDefault();
        var nombremeta = $('#nombre_meta').val();


        if (nombremeta == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Nombre Meta Vacio!',
                icon: "error",
            });
            return;
        }

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
                $('#nombre_meta').val('');
            }     
        })

    })


    //ELIMINAR
    //llenar datos en el modal editar registro  /// captura los id de lo botones
    $('#tb_lista_meta').on("click", ".btn_eliminar_empleado", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_meta_ls');
        //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
        const data = {
            eliminar_meta : 'eliminarmeta',
            idmeta : id,
        }
        Swal.fire({
            title: "Estas seguro",
            text: "¡No podrás revertir esto!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('Assets/ajax/Ajax.meta.php', data, function (response) {
                    //console.log(response); //para ver en la consola
                    if (response.trim() != "ok") {
                        Swal.fire({
                            title: "Oppps....",
                            text: response,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted",
                            text: "Eliminado exitosamente",
                            icon: "success",
                        });
                        // Eliminar la fila con transición
                        var row = $(e.target).closest('tr');
                        row.addClass('fade-out');
                        setTimeout(function () {
                            var table = $('#tb_lista_meta').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                })
            }
        })
    })

    //LISTAR MODAL
    //llenar datos en el modal editar registro  /// captura los id de lo botones
    $('#tb_lista_meta').on("click", ".btn_modal_meta_editar", function (e) {
        e.preventDefault();
        var meta_id = $(this).attr('id_mt');
        var meta_nombre = $(this).attr('mt_nombre');
        
        $('#modal_meta_id').val(meta_id);
        $('#modal_meta_editar_nombre').val(meta_nombre);
       

    })


    $('#btn_editar_meta').click(function (e) {
        e.preventDefault();
        var nombre_meta =  $('#modal_meta_editar_nombre').val();
        var id_meta =  $('#modal_meta_id').val();
        
        if (nombre_meta == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Nombre Meta Vacio!',
                icon: "error",
            });
            return;
        }

        const data = {
            editarmeta          : 'editarmeta',
            idmeta_editar       : id_meta,
            nombremeta_editar   : nombre_meta,
        }
        console.log(data);
        Swal.fire({
            title: "Estas seguro",
            text: "¡No podrás revertir esto!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, editar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('Assets/ajax/Ajax.meta.php', data, function (response) {
                    //console.log(response); //para ver en la consola
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
                        $('#modal_meta_editar_nombre').val('');
                        $('#modal_meta_id').val('');
                    }
                })
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
        pageLength: 5, // Establecer el número de registros por página a 3
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


