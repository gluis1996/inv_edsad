$(document).ready(function () {


    //registrar Comentario
    $("#detalles_ticket").on('click', '.btn_añadir_comentario', function (e) {
        e.preventDefault();
        //console.log($("#text_area_comentario").val());

        var fechaActual = new Date();
        var año = fechaActual.getFullYear();
        var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript van de 0 a 11
        var dia = fechaActual.getDate();
        var hora = fechaActual.getHours();
        var minutos = fechaActual.getMinutes();
        var segundos = fechaActual.getSeconds();
        var id_usuario = $("#usuario_sesion").attr("id_lg_usuario");
        var fechaHoraFormateada = año + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia) + " " +
            (hora < 10 ? "0" + hora : hora) + ":" + (minutos < 10 ? "0" + minutos : minutos) + ":" +
            (segundos < 10 ? "0" + segundos : segundos);

        if ($("#text_area_comentario").val() == "") {
            Swal.fire("Campo vacio..!!!");
            return "Campo vacio...";
        }

        const data = {
            event_registrar_comentario: 'event_registrar_comentario',
            content: {
                ticket_id: $("#id_ticket_oculto").val(),
                user_id: id_usuario,
                comment: $("#text_area_comentario").val(),
                created_atmestamp: fechaHoraFormateada,
            },
        }

        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Comment.php", data,
            function (response) {
                console.log(response);
                if (response.trim() !== '"ok"') {
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
                    $("#text_area_comentario").val("");
                    buscar_listar_comentario($("#id_ticket_oculto").val());
                }
            }
        );

    });


    //cambia estado de la incidencia:

    $('#contenedor_tarjetas').on('change', '#select_estado_incidencia', function (e) {
        e.preventDefault();
        var id_usuario = $("#usuario_sesion").attr("id_lg_usuario");
        var estado_nuevo = $("#select_estado_incidencia").val();
        var id_ticket = $(this).attr(("data-ticket-id"));

        const data = {
            event_actualizar_estado: 'event_actualizar_estado',
            datos: {
                id_usuario: id_usuario,
                ticket_id: id_ticket,
                status: estado_nuevo
            },
        }

        console.log(data);

        Swal.fire({
            title: "añade un comentario",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Look up",
            showLoaderOnConfirm: true,
            preConfirm: async (comment) => {
                if (!comment) {
                    Swal.showValidationMessage("El comentario no puede estar vacío");
                } else {
                    try {
                        // Aquí puedes añadir el código para manejar el comentario
                        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
                            function (response) {
                                console.log(response);
                                //Actualizar visualmente el estado de la tarjeta
                                var tarjeta = $("#ticket_" + id_ticket);
                                tarjeta.find('.status span').removeClass('badge-danger badge-success badge-secondary badge-primary');

                                if (estado_nuevo == 'en proceso') {
                                    tarjeta.find('.status span').addClass('badge-danger').text(estado_nuevo);
                                } else if (estado_nuevo == 'resuelto') {
                                    tarjeta.find('.status span').addClass('badge-success').text(estado_nuevo);
                                } else if (estado_nuevo == 'abierto') {
                                    tarjeta.find('.status span').addClass('badge-primary').text(estado_nuevo);
                                } else if (estado_nuevo == 'cerrado') {
                                    tarjeta.find('.status span').addClass('badge-secondary').text(estado_nuevo);
                                }

                                tarjeta.find('#select_estado_incidencia').val(estado_nuevo);
                            }
                        );
                        return comment; // Retorna el comentario si todo está bien
                    } catch (error) {
                        Swal.showValidationMessage(`Error: ${error}`);
                    }
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `actualizado`,
                    text: `Comentario: ${result.value}`, // Mostrar el comentario ingresado
                });
            }
        });

    });








    //evento buscar y listar comentario

    function buscar_listar_comentario(ticket_id) {
        const data = {
            event_buscar_comment: 'event_buscar_comment',
            ticket_id: ticket_id,
        }

        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Comment.php", data,
            function (response) {
                console.log(response);
                var j = JSON.parse(response);
                $(".listas-comment").empty();
                j.forEach(element => {

                    var comments = `
                        <li class="media">
                            <label for="fecha" class="mr-2"><i class="fa fa-caret-right" aria-hidden="true"></i> ${element.created_at}</label>
                            <div class="media-body">
                                <p>${element.comment}</p>
                            </div>
                        </li>
                    ` ;


                    $(".listas-comment").append(comments);
                });

            }
        );
    }

})