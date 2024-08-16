$(document).ready(function () {

    llenado_ticket_total();


    function llenado_equipo_sede_total() {
        
    }



    function llenado_ticket_total() {
        const data = {
            dash_total_ticket: 'dash_total_ticket',
        }
    
        $.post("Assets/ajax/Ajax.DashBoard.php", data,
            function (response) {
                console.log(response);
                var j = JSON.parse(response);
                let i = 0;
    
                while (i < j.data.length) {
                    const item = j.data[i];
                    if (item.status == 'Total') {
                        $("#ticket_total").text(item.cantidad);
                    }else if (item.status === 'abierto') {
                        $("#ticket_abiertos").text(item.cantidad);
                    } else if (item.status === 'en proceso') {
                        $("#ticket_en_proceso").text(item.cantidad);
                    } else if (item.status === 'cerrado') {
                        $("#ticket_cerrado").text(item.cantidad);
                    }
                    i++;
                }
            }
        );
    }


});
