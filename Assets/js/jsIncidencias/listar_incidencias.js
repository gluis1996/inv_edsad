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
            //console.log(j);            
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
            { data: 'status',
                render:  function(data, type , row){
                    switch (data) {
                        case 'abierto':
                            return '<span class="badge badge-primary">abierto</span>';
                        case 'en proceso':
                            return '<span class="badge badge-warning">en proceso</span>';
                        case 'cerrado':
                            return '<span class="badge badge-danger">cerrado</span>';
                        default:
                            return data;
                    }
                }
            },
            { data: 'equipment_id' },
            { data: 'creadopor' },
            { data: 'asignadoa' },
            { 
                data: 'nombreequipo',
                render: function(data, type, row) {
                    // Reemplaza el valor vacío o null con "otros"
                    return data ? data : 'otros';
                }
            },
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
        scrollX: false, 
        order: [[8, 'desc']],
        responsive: 'true',
        dom: '<"top"iBfrtlp><"clear">', // Colocar información de registros al principio
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                tittleAttr: 'export a excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                customize: function (doc) {
                    // Personalizar título
                    doc.content.splice(1, 0, {
                        margin: [0, 0, 0, 12],
                        alignment: 'center',
                        text: 'Lista de Equipo adquiridos',
                        fontSize: 20,
                        bold: true
                    });

                    // Remover cualquier texto adicional que pudiera haberse añadido
                    doc.content = doc.content.filter(function (item) {
                        return !(typeof item.text === 'string' && item.text.includes('Gestion'));
                    });
                }
            }
        ]
    });
}