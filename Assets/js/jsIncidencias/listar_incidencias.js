$(document).ready(function () {

    // $('#tablaticket').DataTable();

    const data = {
        listar_tickets : 'listar_tickets',
    }

    $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data,
        function (response) {
            var j = JSON.parse(response);
            console.log(j);
            
        }
    );

    $("#tablaticket").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.Incidencias.Tickets.php",
            type: "POST",
            data: data,
            dataSrc: 'data'
        },
        columns: [
            { data: 'ticket_id' },
            { data: 'title' },
            { data: 'description' },
            { data: 'status' },
            { 
                data: 'priority',
                render: function (data, type, row) {
                    switch (data) {
                        case "alta":
                            return '<span style="color: red;">Alta</span>';
                        case "media":
                            return '<span style="color: orange;">Media</span>';
                        case "baja":
                            return '<span style="color: green;">Baja</span>';
                        default:
                            return data;
                    }
                }
            },
            { data: 'created_by' },
            { data: 'assigned_to' },
            { data: 'equipment_id' },
            { data: 'created_at' },
            { data: 'updated_at' }
        ],
        scrollX: false // Habilita el desplazamiento horizontal
            
    });

})

