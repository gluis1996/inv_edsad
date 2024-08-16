$(document).ready(function () {

    $("#contenedor_tarjetas").on("click", ".btn_activity", function () {
        //e.preventDefault();
        const data = {
            listar_tickets_activity: 'listar_tickets_activity',
            detalle_id_tickets_activity : $(this).attr('data-ticket-id'),
        }

        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                console.log(response);
                var res = JSON.parse(response);
                $(".card-activity").empty();
                res.forEach(element => {
                    console.log(element);
                    var comments =`
                        <ul class="list-unstyled">
                            <li class="media">
                                <label for="fecha" class="mr-2"><i class="fa fa-caret-right" aria-hidden="true"></i> ${element.created_at}</label>
                                <div class="media-body">
                                    <p>${element.activity_type} <i class="fa fa-caret-right" aria-hidden="true"></i> ${element.description}</p>
                                </div>
                            </li>
                        </ul>
                ` ;

                $(".card-activity").append(comments);
                });

            }
        );

    });

    
});
