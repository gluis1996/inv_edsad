$(document).ready(function() {

    
    listar_adquisicion();
    adq_llenar_select_area();
    adq_llenar_select_beneficiario();
    adq_llenar_select_equipo();
    adq_llenar_select_meta();

    
    // Añadir evento change al select de sedes
    $("#ad_selec_equipo").change(function () {
        llenar_modelo_adquisicion();
    });


    $('.btn_adq_limpiar').click(function (e) {
        e.preventDefault();
        limpiar_adq();

    })

    //registrar adquisicion
    $('.btn_adq_guardar').click(function (e) {
        e.preventDefault();
        var idarea = $('#ad_selec_area').val();
        var idbeneficiario = $('#ad_selec_beneficiario').val();
        var idequipo = $('#ad_selec_equipo_modelo').val();
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
        //console.log(data);

        $.post('Assets/ajax/Ajax.adquisicion.php',data, function (response) {
            //console.log(response);
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
                listar_adquisicion();
                limpiar_adq();
            }
        })
    })

    //Eliminar adquisicion
    $('#tbl_detalle_adquisicion').on("click", "[id^='id_eliminar_']", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_adquisicion_eliminar");
        //console.log(id);

        const data = {
            ad_eliminar: 'ad_eliminar',
            id_ad_eliminar: id,
        }
        //console.log(data);

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
                    //console.log(response);
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
        //console.log(id);

        const data = {
            ad_buscar: 'ad_buscar',
            id_ad_buscar: id,
        }
        ////console.log(data);

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

        //console.log(data);

        $.post('Assets/ajax/Ajax.adquisicion.php',data , function (response) {
            //console.log(response);

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
                listar_adquisicion();
                limpiar_adq();
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
            ////console.log(respose);
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
            ////console.log(respose);
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
        listar_equipo_marca: "listar_equipo_marca",
    };
// //console.log(data);
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (response) {
            ////console.log(response);
            var js = JSON.parse(response);
            var $select = $("#ad_selec_equipo");
            $("#ad_selec_equipo").empty().append('<option value="0">Seleccione una Marca</option>');
            $.each(js, function (index, fila) {
                $select.append('<option value="' + fila.idmarca + '">' + fila.nombre+ "</option>");
            });

        },
    });


    // // const data = {
    // //     ad_equipo : "ad_equipo",
    // // };
    // $.ajax({
    //     type: "POST",
    //     data: data,
    //     url: "Assets/ajax/Ajax.adquisicion.php",
    //     success: function (response) {
    //         var js = JSON.parse(response);
    //         var select = $("#ad_selec_equipo");
    //         select.empty();  // Vacía las opciones anteriores
    //         $.each(js, function (index, fila) {
    //             select.append(
    //                 '<option value="' + fila.idequipos + '">' + fila.descripcion + " - " + fila.modelo + " - " + fila.nombre + "</option>"
    //             );
    //         });
    //     },
    // });
}

function llenar_modelo_adquisicion(){
    const idmarca = $("#ad_selec_equipo").val();
    const data = {
        listar_equipo: "listar_equipo",
        id_marca: idmarca,
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.asignacion.php",
        success: function (response) {
            ////console.log(response);
            var js = JSON.parse(response);
            //console.log(js);            
            var $select = $("#ad_selec_equipo_modelo");  
            // Limpiar las opciones actuales del select de oficinas
            $("#ad_selec_equipo_modelo").empty().append('<option value="0">Seleccione un equipo</option>');
            $.each(js, function (index, fila) {
                $select.append('<option value="' + fila.idequipos + '">' + fila.descripcion + " - " + fila.modelo + "</option>");
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
            ////console.log(respose);
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

    // $.ajax({
    //     url: "Assets/ajax/Ajax.adquisicion.php",
    //     data: data,
    //     type: 'POST',
    //     success: function (response) {
    //         ////console.log(response);
    //     }
    // })

    const imageBase64 = "data:image/png;base64,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"

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
        ordering: false, // Quitar la capacidad de ordenar
        pageLength: 10, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "id", className: "text-center", },
            { data: "area_nombre" },
            { data: "beneficiario_nombre" },
            { data: "equipo" },
            { data: "meta_nombre" , className: "text-center", },
            { data: "año" , className: "text-center", },
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
        responsive: 'true',
        dom: '<"top"iBfrtlp><"clear">', // Colocar información de registros al principio
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                tittleAttr: 'export a excel',
                className: 'btn btn-success',
                title: 'REPORTE ENSAD'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                customize: function (doc) {
                    // Personalizar encabezado
                    doc.content.splice(0, 0, {
                        margin: [0, 0, 0, 12],
                        alignment: 'center',
                        image: imageBase64,
                        width: 300,
                        height: 91
                    });

                    // Personalizar título
                    doc.content.splice(1, 0, {
                        margin: [0, 0, 0, 12],
                        alignment: 'center',
                        text: 'Lista de Equipo adquiridos',
                        fontSize: 20,
                        bold: true
                    });

                    // Remover cualquier texto adicional que pudiera haberse añadido
                    doc.content = doc.content.filter(function (item) {
                        return !(typeof item.text === 'string' && item.text.includes('Gestion'));
                    });
                }
            }
        ]
    });
}



