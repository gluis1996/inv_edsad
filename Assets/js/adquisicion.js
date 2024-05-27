$(document).ready(function() {
    listar_adquisicion();
    adq_llenar_select_area();
    adq_llenar_select_beneficiario();
    adq_llenar_select_equipo();
    adq_llenar_select_meta();

    $('.btn_adq_limpiar').click(function (e) {
        e.preventDefault();
        limpiar_adq();

    })

    //registrar adquisicion
    $('.btn_adq_guardar').click(function (e) {
        e.preventDefault();
        var idarea = $('#ad_selec_area').val();
        var idbeneficiario = $('#ad_selec_beneficiario').val();
        var idequipo = $('#ad_selec_equipo').val();
        var idmeta = $('#ad_selec_meta').val();
        var fecha = $('#ad_fecha').val();
        var cantidad = $('#ad_cantidad').val();

    
        const data = {
            ad_registrar: 'ad_registrar',
            ad_area: idarea,
            ad_beneficiario: idbeneficiario,
            ad_equipo: idequipo,
            ad_meta: idmeta,
            ad_año: fecha,
            ad_cantidad: cantidad
        };
        console.log(data);

        $.post('Assets/ajax/Ajax.adquisicion.php',data, function (response) {
            console.log(response);
            if (response.trim() != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            }else{
                Swal.fire({
                    title: "Registrado",
                    text: "registradi exitosamente",
                    icon: "success",
                });
            }
        })
    })

    //Eliminar adquisicion
    $('#tbl_detalle_adquisicion').on("click", "[id^='id_eliminar_']", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_adquisicion_eliminar");
        console.log(id);

        const data = {
            ad_eliminar: 'ad_eliminar',
            id_ad_eliminar: id,
        }
        console.log(data);

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
                $.post("Assets/ajax/Ajax.adquisicion.php", data, function (response) {
                    console.log(response);
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
                            var table = $('#tbl_detalle_adquisicion').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                })
            }
        })
    })

    //buscar adquisicion
    $('#tbl_detalle_adquisicion').on("click", "[id^='id_adquisicion_']", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_adquisicion_buscar");
        console.log(id);

        const data = {
            ad_buscar: 'ad_buscar',
            id_ad_buscar: id,
        }
        //console.log(data);

        $.post('Assets/ajax/Ajax.adquisicion.php',data,function (response) {
            //console.log(response);
            var js = JSON.parse(response);
            $('#modal_id_ad').val(js.id);


            js.l_area.forEach(function (area) {
                $('#modal_edit_ad_selec_area').append($('<option>', {
                    value: area.id_area_usuaria,
                    text: area.nombres
                }));
            });
            
            js.l_bene.forEach(function (bene) {
                $('#modal_edit_ad_selec_beneficiario').append($('<option>', {
                    value: bene.idbeneficiario,
                    text: bene.nombre
                }));
            });

            js.l_equi.forEach(function (equi) {
                $('#modal_edit_ad_selec_equipo').append($('<option>', {
                    value: equi.idequipos,
                    text:  equi.descripcion + " - " + equi.modelo + " - " + equi.nombre 
                }));
            });

            js.l_meta.forEach(function (meta) {
                $('#modal_edit_ad_selec_meta').append($('<option>', {
                    value: meta.idmeta,
                    text:  meta.nombre
                }));
            });

            $('#modal_edit_ad_selec_beneficiario').val(js.bene_id);
            $('#modal_edit_ad_selec_area').val(js.area_id);
            $('#modal_edit_ad_selec_equipo').val(js.equi_id);
            $('#modal_edit_ad_selec_meta').val(js.meta_id);
            $('#modal_edit_ad_fecha').val(js.año);
            $('#modal_edit_ad_cantidad').val(js.cantidad);
        })
    })

    $('.btn_adq_editar').click(function (e) {
        e.preventDefault();
        var bene        =    $('#modal_edit_ad_selec_beneficiario').val();
        var area        =    $('#modal_edit_ad_selec_area').val();
        var equipo      =    $('#modal_edit_ad_selec_equipo').val();
        var meta        =    $('#modal_edit_ad_selec_meta').val();
        var fecha       =    $('#modal_edit_ad_fecha').val();
        var cantidad    =    $('#modal_edit_ad_cantidad').val();
        var id_ad       =    $('#modal_id_ad').val();

        const data = {
            ad_editar           : 'ad_editar',
            ad_editar_id        : id_ad,
            ad_editar_area      : area,
            ad_editar_bene      : bene,
            ad_editar_equipo    : equipo,
            ad_editar_meta      : meta,
            ad_editar_fecha     : fecha,
            ad_editar_cantidad  : cantidad,
        }

        console.log(data);

        $.post('Assets/ajax/Ajax.adquisicion.php',data , function (response) {
            console.log(response);

            if (response.trim() != 'ok') {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            }else{
                Swal.fire({
                    title: "Actualizado",
                    text: "Actualizado exitosamente",
                    icon: "success",
                });
            }
        })


    })

});


function adq_llenar_select_area() {
    const data = {
        ad_area : "ad_area",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_area").append(
                    '<option value="' + fila.id_area_usuaria + '">' + fila.nombres + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_beneficiario() {
    const data = {
        ad_beneficiario : "ad_beneficiario",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_beneficiario").append(
                    '<option value="' + fila.idbeneficiario + '">' + fila.nombre + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_equipo() {
    const data = {
        ad_equipo : "ad_equipo",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_equipo").append(
                    '<option value="' + fila.idequipos + '">' + fila.descripcion + " - " + fila.modelo + " - " + fila.nombre + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_meta() {
    const data = {
        ad_meta : "ad_meta",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_meta").append(
                    '<option value="' + fila.idmeta + '">' + fila.nombre + "</option>"
                );
            });
        },
    });
}

function limpiar_adq() {
    $('#ad_selec_area').val(0);
    $('#ad_selec_beneficiario').val(0);
    $('#ad_selec_equipo').val(0);
    $('#ad_selec_meta').val(0);
    $('#ad_fecha').val('');
    $('#ad_cantidad').val('');
}


//listara todo
function listar_adquisicion() {
    const data = {
        ad_listar: "ad_listar",
    };

    $.ajax({
        url: "Assets/ajax/Ajax.adquisicion.php",
        data: data,
        type: 'POST',
        success: function (response) {
            //console.log(response);
        }
    })


    $("#tbl_detalle_adquisicion").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.adquisicion.php",
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
            { data: "id", className: "text-center", },
            { data: "area_nombre" },
            { data: "beneficiario_nombre" },
            { data: "equipo" },
            { data: "meta_nombre" },
            { data: "año" },
            { data: "cantidad", className: "text-center", },
            { data: "accion", className: "text-center", },
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



