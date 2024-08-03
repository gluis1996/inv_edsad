$(document).ready(function () {

    //ver detalles

    // $("#btn_buscar_id_incidencias").click(function (e) { 
    //     e.preventDefault();
    //     console.log('dadasd');
    //     //console.log($(this).attr('data-ticket-id'));
    // });


    // evento para buscar y ver detalle de la incidencia
    $("#contenedor_tarjetas").on("click", ".btn_ver_detalles", function () {
        console.log($(this).attr('data-ticket-id'));

        const data = {
            listar_tickets_detalle : 'listar_tickets_detalle',
            detalle_id_tickets : $(this).attr('data-ticket-id'),
        }
        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                var j = JSON.parse(response);
                console.log(j);
                j.tickets.forEach(element => {
                    // console.log(element);
                    $("#detalles_ticket").empty();
                    var nuevoHtml = `

                    <form>
                        <fieldset disabled>
                            <div class="form-group">
                            <label for="disabledTextInput">Titulo:</label>
                            <input type="text" id="disabledTextInput" class="form-control form-control-sm" value= "${element.title}">
                            <input type="hidden" id="id_ticket_oculto" value="${element.ticket_id}">
                            </div>

                            <div class="form-group">
                            <label for="disabledTextInput">Descripción:</label>
                            <input type="text" id="disabledTextInput" class="form-control form-control-sm" value= "${element.description}">
                            </div>

                            <div class="form-group">
                            <label for="disabledTextInput">Asignado a:</label>
                            <input type="text" id="disabledTextInput" class="form-control form-control-sm" value= "${element.asignadoa}">
                            </div>

                            <div class="form-group">
                            <label for="disabledTextInput">Creado por:</label>
                            <input type="text" id="disabledTextInput" class="form-control form-control-sm" value= "${element.creadopor}">
                            </div>
                           
                            <div class="form-group">
                            <label for="disabledTextInput">Estado:</label>
                            <input type="text" id="disabledTextInput" class="form-control form-control-sm" value= "${element.status}">
                            </div>
                           
                        </fieldset>
                    </form>

                    <div class="card-comments" style="font-size: 12px;">
                        <ul class="list-unstyled listas-comment">
                            
                        </ul>
                    </div>                    

                    <form class="form-inline">
                        <textarea name="comentario" id="text_area_comentario" class="form-control form-group mr-2" style="width:300px" required></textarea>
                        <button class="btn btn-primary mb-2 btn-sm btn_añadir_comentario" >Añadir Comentario</button>
                    </form>
                `;               
                
                $("#detalles_ticket").append(nuevoHtml);
                
                });
                j.comment.forEach(element => {
                    console.log(element);
                    var comments =`
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
    });


})