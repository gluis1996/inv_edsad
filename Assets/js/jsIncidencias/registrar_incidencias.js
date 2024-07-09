$(document).ready(function () {

    $(".btn_registrar_incidencias").click(function (e) {
        e.preventDefault();

        const data = {
            listar_tickets      :   "listar_tickets",
        }

        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data, function (response) {
                var resultado = JSON.parse(response);
                console.log(resultado);

                resultado.forEach(reco => {
                var nuevoHtml = `
                <div class="col mb-4" style="font-size: 12px">
                    <div class="card" id="ticket_${reco.ticket_id}">
                        <div class="card-header">
                            <div class="form-row d-flex justify-content-between">
                                <h5 class="flex-grow-1">#${reco.ticket_id}</h5>
                                <h5 class="text-right status">${reco.status}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${reco.title}</h5>
                            <p class="card-text">${reco.description}</p>
                            <button class="btn btn-primary btn_ver_detalles btn-sm" data-ticket-id="${reco.ticket_id}">Ver Detalles</button>
                            <button class="btn btn-danger btn_eliminar btn-sm" data-ticket-id="${reco.ticket_id}">Eliminar</button>
                            <!-- Botón para asignar agente -->
                            <button class="btn btn-secondary btn_asignar_agente btn-sm" data-ticket-id="${reco.ticket_id}" data-toggle="modal" data-target="#modalAsignarAgente">Asignar Agente</button>
                        </div>
                        <div class="card-footer">
                            <p class="text-primary">Asignado: <span class="assigned_to">${reco.assigned_to}</span></p>
                            <p class="text-secondary">Creado por: ${reco.created_by}</p>
                            
                            <!-- Dropdown para cambiar el estado -->
                            <select class="dropdown_estado form-control" data-ticket-id="${reco.ticket_id}">
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

    });

    // Delegar el evento de click para los botones de eliminar
    $("#contenedor_tarjetas").on("click", ".btn_eliminar", function () {
        $(this).closest(".card").remove();
    });
});
