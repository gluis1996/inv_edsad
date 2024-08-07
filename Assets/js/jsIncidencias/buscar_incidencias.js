$(document).ready(function () {

    //ver detalles

    // $("#btn_buscar_id_incidencias").click(function (e) { 
    //     e.preventDefault();
    //     console.log('dadasd');
    //     //console.log($(this).attr('data-ticket-id'));
    // });


    // evento para buscar y ver detalle de la incidencia
    $("#tablaticket").on("click", "#btn_edit_val", function () {
        console.log($(this).attr('id_ticket_editar'));

        const data = {
            listar_tickets_detalle : 'listar_tickets_detalle',
            detalle_id_tickets : $(this).attr('id_ticket_editar'),
        }
        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                var j = JSON.parse(response);
                console.log(j);
                
                
            }
        );
    });




})