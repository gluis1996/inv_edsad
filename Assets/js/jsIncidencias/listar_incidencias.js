$(document).ready(function () {
    listarticket();

})

function listarticket() {
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
            { data: 'creadopor' },
            { data: 'asignadoa' },
            { data: 'nombreequipo' },
            { data: 'created_at' },
            { data: 'updated_at' },
            {
                data: null,
                render: function (data, type, row) {
                    // Genera los botones dentro de la columna de acciones
                    return `
                        <button class="btn btn-primary  btn-sm " id="btn_edit_val" id_ticket_editar='${row.ticket_id}' data-toggle="modal" data-target="#modal_detalle_incidencia">
                            <i class='fas fa-pencil-alt'></i>
                        </button>
                        <button class="btn btn-danger   btn-sm" id="btn_delet_val" id_ticket_eliminar='${row.ticket_id}'>
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    `;
                }
            }
        ],
        scrollX: false // Habilita el desplazamiento horizontal            
    });
}