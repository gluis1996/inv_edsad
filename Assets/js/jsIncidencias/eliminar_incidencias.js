$(document).ready(function () {

    $("#contenedor_tarjetas").on('click', '.btn_eliminar',function () {
        var id_ticket = $(this).attr(("data-ticket-id"));
        console.log(id_ticket);

        const data = {
            event_eliminar_ticket       :   'event_eliminar_ticket',
            id_ticket : id_ticket,
        }

        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
            function (response) {
                console.log(response);
                if (response!= 'ok') {
                    $('#ticket_' + id_ticket).remove();
                } else {
                    alert('Elemento no removido ' + response);
                }
            }
        );


    
    });

})