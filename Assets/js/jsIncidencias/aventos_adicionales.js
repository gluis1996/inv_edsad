$(document).ready(function () {

    //registrar Comentario
    $(".btn_añadir_comentario").click( function (e) {
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

        if ($("#txt_comenatrio").val() == "") {
            Swal.fire("Campo vacio..!!!");
            return "Campo vacio...";
        }

        const data = {
            event_registrar_comentario: 'event_registrar_comentario',
            content: {
                ticket_id: $("#text_codigo_ticket").val(),
                user_id: id_usuario,
                comment: $("#txt_comenatrio").val(),
                created_atmestamp: fechaHoraFormateada,
            },
        }

        //console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Comment.php", data,
            function (response) {
                //console.log(response);
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
                    $("#txt_comenatrio").val("");
                    buscar_listar_comentario($("#text_codigo_ticket").val());
                }
            }
        );

    });

    $("#btn_asignar_incidencia").click(function (e) { 
        e.preventDefault();
        var text_codigo_ticket      = $("#text_codigo_ticket").val();
        var select_asignado_a       = $("#select_asignado_a").val();

        // Validación de que se ha seleccionado un valor
        if (!select_asignado_a) {
            Swal.fire({
                title: "Selección requerida",
                text: "Debe seleccionar un empleado para asignar el ticket.",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Entendido"
            });
            return; // Salir de la función si no se ha seleccionado un empleado
        }

        const data = {
            event_asignar_ticket     :   'event_asignar_ticket',
            datos                   : {
                id_ticket  : text_codigo_ticket,
                id_empleado   : select_asignado_a, 
            },
        }

        //console.log(data);
        
        Swal.fire({
            title: "Estas seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, Asignalo!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
                    function (response) {
                        //console.log(response);

                        if (response != '"ok"') {
                            alert('Elemento no asignado ' + response);

                        } else {

                            Swal.fire({
                                title: "Asignado!",
                                text: "Su archivo ha sido eliminado.",
                                icon: "success"
                            });
                            listarticket();
                            buscar_listar_comentario(text_codigo_ticket);
                            $('#btn_asignar_incidencia').prop('disabled', true);
                            $('#btn_cerrar_incidencia').prop('disabled', false);
                        }
                    }
                );

            }
        });

    });

    $("#btn_cerrar_incidencia").click(function (e) { 
        e.preventDefault();
        var text_codigo_ticket      = $("#text_codigo_ticket").val();
        var select_estado_ticket    = $("#select_estado_ticket").val();

        const data = {
            event_actualizar_estado     :   'event_actualizar_estado',
            datos                   : {
                id_ticket  : text_codigo_ticket,
                estado     : 'cerrado', 
            },
        }

        //console.log(data);
        
        Swal.fire({
            title: "Estas seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, Cerrar Ticket!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
                    function (response) {
                        console.log(response);

                        if (response != '"ok"') {
                            alert('Elemento no asignado ' + response);

                        } else {

                            Swal.fire({
                                title: "Cerrado!",
                                text: "Su archivo ha sido cerrado.",
                                icon: "success"
                            });
                            listarticket();
                            buscar_listar_comentario(text_codigo_ticket);
                            $('#btn_asignar_incidencia').prop('disabled', true);
                            $('#btn_cerrar_incidencia').prop('disabled', true);
                        }
                    }
                );

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
                $(".llenado_json").empty();
                const dotClasses = ["b-warning", "b-primary", "b-danger", "b-success", "b-info"];
                let lastUsedClass = ""; // Variable para rastrear la última clase usada
                j.forEach(element => {

                    const tiempo = element.created_at;
                    const [fecha, hora] = tiempo.split(' ');
                    // Seleccionar una clase aleatoria
                    let dotClass;

                    do {
                        // Seleccionar una clase aleatoria
                        dotClass = dotClasses[Math.floor(Math.random() * dotClasses.length)];
                    } while (dotClass === lastUsedClass); // Repetir si es la misma que la última usada

                    lastUsedClass = dotClass; // Actualizar la última clase usada
                    $(".llenado_json").append(`
                        <div class="tl-item">
                            <div class="tl-dot ${dotClass}"></div>
                            <div class="tl-content">
                                <div class="">${element.comment}</div>
                                <div class="tl-date text-muted mt-1">${tiempo}</div>
                            </div>
                        </div>
                        `
                    );

                });

            }
        );
    }

})