$(document).ready(function () {

    // evento para buscar y ver detalle de la incidencia
    $("#tablaticket").on("click", "#btn_edit_val", function () {
        //console.log($(this).attr('id_ticket_editar'));

        const data = {
            listar_tickets_detalle: 'listar_tickets_detalle',
            detalle_id_tickets: $(this).attr('id_ticket_editar'),
        }

        //console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                var json = JSON.parse(response);
                //console.log(response);
                $("#select_asignado_a").empty();
                $(".llenado_json").empty();

                //llenar usuario          
                json.data.usuario_todo.forEach(element => {
                    $("#select_asignado_a").append(
                        $('<option>', {
                            value: element.idusuario,
                            text: element.nombre
                        })
                    );
                });

                //asignacion
                json.data.tickets.forEach(element => {
                    $("#text_asunto").val(element.title);
                    $("#text_codigo_ticket").val(element.ticket_id);
                    $("#txt_descripcion").val(element.description);
                    const datetime = element.created_at;
                    const [date, time] = datetime.split(' ');
                    $("#txt_fecha").val(date);
                    $("#txt_hora_inicio").val(time);
                    $("#select_estado_ticket").val(element.status);
                    $("#select_asignado_a").val(element.assigned_to);

                    if (element.status == 'abierto') {
                        $('#btn_asignar_incidencia').prop('disabled', false);
                        $('#btn_cerrar_incidencia').prop('disabled', true);
                    }else if(element.status == 'en proceso'){
                        $('#btn_asignar_incidencia').prop('disabled', true);
                        $('#btn_cerrar_incidencia').prop('disabled', false);
                    }else if(element.status == 'cerrado'){
                        $('#btn_asignar_incidencia').prop('disabled', true);
                        $('#btn_cerrar_incidencia').prop('disabled', true);
                    }
                });

                //usuartio crador
                json.data.usuario_creador.forEach(element => {
                    $("#txt_creado_por").val(element.nombre);
                })

                json.data.detalle_asigando.forEach(element => {
                    $("#txt_equipo").val(element.equipo);
                    $("#txt_sede_oficina").val(element.sede_nombres + '/' + element.oficina_nombres);
                });

                const dotClasses = ["b-warning", "b-primary", "b-danger", "b-success", "b-info"];
                let lastUsedClass = ""; // Variable para rastrear la última clase usada
                json.data.comment.forEach(element => {

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

                })
            }
        );
    });

})