
$(document).ready(function () {

    listar_equipo();
    llenar_select_equipo_marca();
    $(".btn_modal_registrar").click(function () {
        $("#modal_equipo_registrar").modal('show');
    });


    $(".btn_equipo_rgistrar_marca").click(function () {
        $("#modal_registrar_marca").modal('show');
    });

    //registar equipo
    $('.btn_regitrar_equipo').click(function (e) {
        e.preventDefault();
        var e_modelo = $('#modal_equipo_modelo').val();
        var e_descripcion = $('#modal_equipo_descripcion').val();
        var e_fecha = $('#modal_equipo_fecha').val();
        var e_marca = $('#modal_select_id_marca').val();


        const data = {
            registrar_equipo: 'registrar_equipo',
            e_modelo: e_modelo,
            e_descripcion: e_descripcion,
            e_fecha: e_fecha,
            e_marca: e_marca,
        }

        $.post("Assets/ajax/Ajax.equipo.php", data, function (response) {
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Registrado exitosamente el equipo",
                    icon: "success",
                });
                $("#modal_equipo_registrar").modal('hide');
                listar_equipo();
            }
        });

    })


    //registar marca
    $('.btn_registrar_marca').click(function (e) {
        e.preventDefault();
        var e_marca = $('#modal_nombre_marca').val();

        const data = {
            registrar_equipo_marca: 'registrar_equipo_marca',
            e_marca: e_marca,
        }

        console.log(data);


        $.post("Assets/ajax/Ajax.equipo.php", data, function (response) {
            console.log(response);
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Registrado exitosamente el equipo",
                    icon: "success",
                });
                $("#modal_registrar_marca").modal('hide');
            }
        });

    })



    //llenar datos en el modal editar registro
    $('#tb_listar_equipos').on("click", "[id^='idequipo_']", function (e) {
        e.preventDefault();
        $("#modal_editar_equipo").modal('show');
        var idequipo = $(this).attr('idequipo');
        const data = {
            buscar_equipo_marca: 'buscar_equipo_marca',
            id_equipo: idequipo,
        }


        $.post("Assets/ajax/Ajax.equipo.php", data, function (response) {
            console.log(response);
            var JsonResponse = JSON.parse(response);
            $('#modal_idequipo_editar_modelo').val(JsonResponse.idequipos);
            $('#modal_equipo_editar_modelo').val(JsonResponse.modelo);
            $('#modal_equipo_editar_descripcion').val(JsonResponse.descripcion);
            $('#modal_equipo_editar_fecha').val(JsonResponse.fecha_registro);

            JsonResponse.listamarca.forEach(function (listamarca) {
                $('#modal_equipo_editar_select_id_marca').append($('<option>', {
                    value: listamarca.idmarca,
                    text: listamarca.nombre
                }));
            })

            $('#modal_equipo_editar_select_id_marca').val(JsonResponse.idmarca);
        });

    })

    //Eliminar equipo
    $('#tb_listar_equipos').on("click", "[id^='idequipoeliminar_']", function (e) {
        e.preventDefault();
        var idequipo = $(this).attr('id_eliminar_eqp');
        const data = {
            eliminar_equipo: 'eliminar_equipo',
            idequipos: idequipo,
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
                $.post("Assets/ajax/Ajax.equipo.php", data, function (response) {
                    console.log(response);
                    if (response != "ok") {
                        Swal.fire({
                            title: "Oppps....",
                            text: response,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se elimino Exitosamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Eliminar la fila con transición
                        var row = $(e.target).closest('tr');
                        row.addClass('fade-out');
                        setTimeout(function () {
                            var table = $('#tb_listar_equipos').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                })
            }
        })

    })


    $('.btn_editar_equipo').click(function (e) {
        e.preventDefault();
        //INPUT
        var e_idequipo = $('#modal_idequipo_editar_modelo').val();
        var e_modelo = $('#modal_equipo_editar_modelo').val();
        var e_descripcion = $('#modal_equipo_editar_descripcion').val();
        var e_fecha = $('#modal_equipo_editar_fecha').val();
        var e_marca = $('#modal_equipo_editar_select_id_marca').val();

        const data = {
            editar_equipo: 'editar_equipo',
            idequipos: e_idequipo,
            e_modelo: e_modelo,
            e_descripcion: e_descripcion,
            e_fecha: e_fecha,
            e_marca: e_marca,
        };

        console.log(data);
        $.post("Assets/ajax/Ajax.equipo.php", data, function (response) {
            console.log(response);
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Editado exitosamente el equipo",
                    icon: "success",
                });
                $("#modal_editar_equipo").modal('hide');
            }
        })
    })




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
            //console.log(response);
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