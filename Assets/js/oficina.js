
$(document).ready(function () {

    listarO();
    llenar_select_sede_oficina();
    listarAU();
    listarS();

    //registrar oficina
    $('#btn_registrarOficina').click(function (e) {
        e.preventDefault();
        var nombre_oficina = $('#nombre_oficina').val();
        var idsede = $('#id_oficina_select_2').val();

        const data = {
            registro_oficina: 'registroOficina',
            nombre_oficina: nombre_oficina,
            id_sede: idsede,
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

    //registrar sede
    $('#btn_registrarSede').click(function (e) {
        e.preventDefault();
        var nombre_sede = $('#nombre_sede').val();

        const data = {
            registro_sede: 'registroSede',
            nombrexsede: nombre_sede,
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
                    text: "Sede registrado exitosamente",
                    icon: "success",
                });
                listarS();
            }

        })
    })

})

//listara todo sede
function listarS() {
    const data = {
        lista_sede: "listasede",
    };
    // console.log(data);
    // $.ajax({
    //     url: "Assets/ajax/Ajax.oficina.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         console.log(response);
    //     }
    // })

    $("#tb_lista_sede_oficina").DataTable({
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
            { data: "idsede", className: "text-center", },
            { data: "nombresed" },
            { data: "acciones", className: "text-center", }, // Centrar el contenido de la columna

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


//ELIMINAR sede
//llenar datos en el modal eliminar /// captura los id de lo botones
$('#tb_lista_sede_oficina').on("click", ".btn_eliminar_sede", function (e) {
    e.preventDefault();
    var id = $(this).attr('id_sedels');
    //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
    const data = {
        eliminar_sede: 'eliminarsede',
        idsede: id,
    }
    //una solicitud POS es lo que se envia al servidor 
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
            $.post('Assets/ajax/Ajax.oficina.php', data, function (response) {
                if (response != "ok") {
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
                        var table = $('#tb_lista_sede_oficina').DataTable();
                        table.row(row).remove().draw();
                    }, 500); // Esperar a que la animación termine
                }

            })
        }
    })
})



//listara todo oficina
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
        pageLength: 3, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "idofi", className: "text-center", },
            { data: "nombreofi" },
            { data: "nombresede" },
            { data: "acciones", className: "text-center", }, // Centrar el contenido de la columna

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


function llenar_select_sede_oficina() {
    const data = {
        listar_sede_oficina: "listarsedeofi",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.oficina.php",
        success: function (respose) {

            //console.log(respose);

            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#id_oficina_select_2").append(
                    '<option value="' + fila.idsedes + '">' + fila.nombres + "</option>"
                );
            });
        },
    });
}

//ELIMINAR
//llenar datos en el modal editar registro  /// captura los id de lo botones
$('#tb_lista_oficina').on("click", ".btn_eliminar_oficina", function (e) {
    e.preventDefault();
    var id = $(this).attr('id_ofi_el');
    //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
    const data = {
        eliminar_oficina: 'eliminaroficina',
        id_ofi: id,
    }
    //una solicitud POS es lo que se envia al servidor 
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
            $.post('Assets/ajax/Ajax.oficina.php', data, function (response) {
                if (response != "ok") {
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
                        var table = $('#tb_lista_oficina').DataTable();
                        table.row(row).remove().draw();
                    }, 500); // Esperar a que la animación termine
                }

            })
        }
    })
})


//listara area usuaria
function listarAU() {
    const data = {
        listar_area_usuaria: "listarAU",
    };
    // console.log(data);
    $.ajax({
        url: "Assets/ajax/Ajax.oficina.php",
        data: data,
        type: 'POST',
        success: function (response) {
            // console.log(response);
        }
    })

    $("#tb_lista_area").DataTable({
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
        pageLength: 3, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "idAreaU", className: "text-center", },
            { data: "nombreusuaria" },
            { data: "acciones", className: "text-center", }, // Centrar el contenido de la columna

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

