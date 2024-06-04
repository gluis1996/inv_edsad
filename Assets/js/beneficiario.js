

$(document).ready(function () {
    listarB();

    $('#btn_registrarBeneficiario').click(function (e) {
        e.preventDefault();
        var nombre_beneficiario = $('#nombre_beneficiario').val();

        if (nombre_beneficiario == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Nombre Beneficiario Vacio!!',
                icon: "error",
            });
            return;
        }

        const data = {
            registro_beneficiario: 'registro_beneficiario',
            nombre_beneficiario: nombre_beneficiario,
        }

        $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
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
                    text: "Beneficiario registrado exitosamente",
                    icon: "success",
                });
                listarB();
                $('#nombre_beneficiario').val('');
            }

        })
    })

    //ELIMINAR
    //llenar datos en el modal editar registro  /// captura los id de lo botones
    $('#tb_lista_beneficiario').on("click", ".btn_eliminar_benef", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_bf');
        console.log(id);  //---> se utiliza para verificar si le esta asignando el id del empleado

        const data = {
            eliminar_beneficiario: 'eliminarB',
            idbeneficiario: id,
        }
        // una solicitud POS es lo que se envia al servidor 
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
                $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
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
                            var table = $('#tb_lista_beneficiario').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }

                })
            }
        })
    })

    //buscar beneficario y listar en modal
    $('#tb_lista_beneficiario').on("click", ".btn_buscar_editar_benef", function (e) {
        e.preventDefault();
        var id = $(this).attr('idbeneficiario');
        console.log(id);

        const data = {
            buscar_beneficiario: 'buscar_beneficiario',
            idbeneficiario: id,
        }
        $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
            console.log(response);
            var jsres = JSON.parse(response);
            $('#modal_beneficiario_editar_nombre').val(jsres[0].nombre);
            $('#modal_beneficiario_id').val(jsres[0].idbeneficiario);
        })
    })

    $('#btn_editar_Beneficiario').click(function (e) {
        e.preventDefault();
        var modal_benef_id = $('#modal_beneficiario_id').val();
        var modal_benef_nombre = $('#modal_beneficiario_editar_nombre').val();

        if (modal_benef_nombre == '') {
            Swal.fire({
                title: "Oppps....",
                text: 'Nombre Beneficairio Vacio',
                icon: "error",
            });
            return;
        }

        const data = {
            editar_beneficiario: 'editar_beneficiario',
            m_benef_edit_id: modal_benef_id,
            m_benef_edit_nombre: modal_benef_nombre,
        }

        console.log(data);

        // una solicitud POS es lo que se envia al servidor 
        Swal.fire({
            title:  "Estas seguro",
            text:   "¡No podrás revertir esto!!",
            icon:   "warning",
            showCancelButton:   true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor:  "#d33",
            confirmButtonText:  "Si, editar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
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
                            text: "Beneficiario editar exitosamente",
                            icon: "success",
                        });
                        listarB();
                        $('#modal_beneficiario_editar_nombre').val('');
                    }
                })
            }
        })

    })





})

//listar beneficiario
function listarB() {
    const data = {
        listar_beneficiario: 'listar_beneficiario',
    };

    $.ajax({
        url: "Assets/ajax/Ajax.beneficiario.php",
        data: data,
        type: 'POST',
        success: function (response) {
            //console.log(response);
        }
    })

    $("#tb_lista_beneficiario").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.beneficiario.php",
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
            { data: "idbeneficiario", className: "text-center", },
            { data: "nombre" },
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


