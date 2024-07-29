$(document).ready(function () {

   listar_incidencias();
    //listar_incidencias_abiertas();

    $('.btn_listar_ticket_abiertos').click(function (e) { 
        e.preventDefault();
        listar_incidencias('abierto');
    });
    $('.btn_listar_ticket_en_proceso').click(function (e) { 
        e.preventDefault();
        listar_incidencias('en proceso');
    });
    $('.btn_listar_ticket_cerrados').click(function (e) { 
        e.preventDefault();
        listar_incidencias('cerrado');
    });

    
    function listar_incidencias(estado) {
        const data = {
            listar_tickets      :   "listar_tickets",
        }
        
        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data, function (response) {
                var resultado = JSON.parse(response);
                console.log(resultado);
                // Filtrar los tickets que están en estado 'abierto'
                var tickets_abiertos = resultado.filter(reco => reco.status === estado);        
                $("#contenedor_tarjetas").empty();
                tickets_abiertos.forEach(reco => {
                var estado = '<span class="badge badge-pill badge-primary">Primary</span>';
                

                if (reco.status == 'en proceso') {
                    estado = `<span class="badge badge-pill badge-danger">${reco.status}</span>`;
                } else if (reco.status == 'resuelto') {
                    estado = `<span class="badge badge-pill badge-success">${reco.status}</span>`;
                } else if (reco.status == 'abierto') {
                    estado = `<span class="badge badge-pill badge-primary">${reco.status}</span>`;
                } else if (reco.status == 'cerrado') {
                    estado = `<span class="badge badge-pill badge-secondary">${reco.status}</span>`;
                }
        
                var nuevoHtml = `
                <div class="col mb-4" style="font-size: 12px">
                    <div class="card" style = "height: 350px" id="ticket_${reco.ticket_id}">
                        <div class="card-header">
                            <div class="form-row d-flex justify-content-between">
                                <h5 class="flex-grow-1">#${reco.ticket_id}</h5>
                                <input type="hidden" id="id_ticket_incidencia" value="${reco.ticket_id}">
                                <h5 class="text-right status">${estado}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${reco.title}</h5>
                            <p class="card-text">${reco.description}</p>
                            <button class="btn btn-primary btn_ver_detalles btn-sm" data-toggle="modal" data-target="#modal_detalle_incidencia" data-ticket-id="${reco.ticket_id}">Ver</button>
                            <button class="btn btn-danger btn_eliminar btn-sm"  data-ticket-id="${reco.ticket_id}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <!-- Botón para asignar agente -->
                            <button class="btn btn-secondary btn_asignar_agente btn-sm" data-toggle="modal" data-target="#modal_asignacion_incidencia" id="btn_buscar_id_incidencias" data-ticket-id="${reco.ticket_id}"><i class="fa fa-users" aria-hidden="true"></i></button>
                            <button class="btn btn-secondary btn_asignar_agente btn-sm btn_activity" data-toggle="modal" data-target="#modal_activity_incidencia" data-ticket-id="${reco.ticket_id}" ><i class="fa fa-history" aria-hidden="true"></i></button>
                        </div>
                        <div class="card-footer">
                            <p class="text-primary">Asignado: <span class="assigned_to">${reco.asignadoa}</span></p>
                            <p class="text-secondary">Creado por: ${reco.creadopor}</p>
                            
                            <!-- Dropdown para cambiar el estado -->
                            <select class="form-control select_estado_incidencia" id="select_estado_incidencia${reco.ticket_id}" data-ticket-id="${reco.ticket_id}">
                                <option value="abierto" ${reco.status === 'abierto' ? 'selected' : ''}>Abierto</option>
                                <option value="en proceso" ${reco.status === 'en proceso' ? 'selected' : ''}>En proceso</option>
                                <option value="resuelto" ${reco.status === 'resuelto' ? 'selected' : ''}>Resuelto</option>
                                <option value="cerrado" ${reco.status === 'cerrado' ? 'selected' : ''}>Cerrado</option>
                            </select>       
                            
                        </div>
                    </div>
                </div>
                `;
                $("#contenedor_tarjetas").append(nuevoHtml);
                
            });
        
            }
        );
    }



    
})

