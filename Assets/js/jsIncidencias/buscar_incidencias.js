$(document).ready(function () {

    //ver detalles

    // $("#btn_buscar_id_incidencias").click(function (e) { 
    //     e.preventDefault();
    //     console.log('dadasd');
    //     //console.log($(this).attr('data-ticket-id'));
    // });


    // Delegar el evento de click para los botones de eliminar
    $("#contenedor_tarjetas").on("click", ".btn_ver_detalles", function () {
        console.log($(this).attr('data-ticket-id'));

        const data = {
            listar_tickets_detalle : 'listar_tickets_detalle',
            detalle_id_tickets : $(this).attr('data-ticket-id'),
        }
        
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                var j = JSON.parse(response);
                //console.log(j);
                j.tickets.forEach(element => {
                    // console.log(element);
                    $("#detalles_ticket").empty();
                    var nuevoHtml = `
                    <p><strong>Título:</strong> ${element.title}</p>
                    <p><strong>Descripción:</strong>${element.description}</p>
                    <p><strong>Asignado a:</strong> ${element.asignadoa}</p>
                    <p><strong>Creado por:</strong> ${element.creadopor}</p>
                    <p><strong>Estado:</strong>${element.status}</p>

                    <div class="card-comments" style="font-size: 12px;">
                        
                    </div>                    

                    <form class="form-inline">
                        <textarea name="comentario" class="form-group mr-2" required></textarea>
                        <button type="submit" class="btn btn-primary mb-2 btn-sm">Añadir Comentario</button>
                    </form>
                `;               
                
                $("#detalles_ticket").append(nuevoHtml);
                
                });
                j.comment.forEach(element => {
                    console.log(element);
                    var comments =`
                        <h5>Comentarios</h5>
                        <ul class="list-unstyled">
                            <li class="media">
                                <label for="fecha" class="mr-2"><i class="fa fa-circle" aria-hidden="true" style="margin-rigth = 10px"></i>${element.created_at}</label>
                                <div class="media-body">
                                    <p>${element.comment}</p>
                                </div>
                            </li>
                        </ul>
                ` ;


                $(".card-comments").append(comments);
                });
                
            }
        );
    });


})