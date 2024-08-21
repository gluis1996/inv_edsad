$(document).ready(function () {

    $("#tablaticket").on('click', '#btn_delet_val', function () {
        var id_ticket = $(this).attr(("id_ticket_eliminar"));
        //console.log(id_ticket);

        const data = {
            event_eliminar_ticket: 'event_eliminar_ticket',
            id_ticket: id_ticket,
        }

        //console.log(data);

        Swal.fire({
            title: "Estas seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
                    function (response) {
                        //console.log(response);

                        if (response != '"ok"') {
                            alert('Elemento no removido ' + response);

                        } else {

                            Swal.fire({
                                title: "Deleted!",
                                text: "Su archivo ha sido eliminado.",
                                icon: "success"
                            });
                            listarticket();
                        }
                    }
                );

            }
        });

    });

})