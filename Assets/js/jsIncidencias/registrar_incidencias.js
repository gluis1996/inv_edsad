$(document).ready(function () {
    // var contador = 0;

    // const resultado = [
    //     {
    //         numero_ticket: '#12215',
    //         cod_patrimonial: 'HGXC12012521',
    //         observacion: 'equipo presenta fallas tecnicos',
    //         tipo: 'SoftWare',
    //         estado: 'abierto',
    //         fecha: '2024/05/23',
    //         asignado_po: 'Gonzao Valdez',
    //         creado_por: 'Gonzalo Valdez',
    //         prioridad: 'media',
    //     },
    //     {
    //         numero_ticket: '#12454',
    //         cod_patrimonial: 'HGXC12012521',
    //         observacion: 'equipo presenta fallas tecnicos',
    //         tipo: 'SoftWare',
    //         estado: 'en proceso',
    //         fecha: '2024/05/23',
    //         asignado_po: 'Gonzao Valdez',
    //         creado_por: 'Gonzalo Valdez',
    //         prioridad: 'baja',
    //     },
    //     {
    //         numero_ticket: '#12215',
    //         cod_patrimonial: 'HGXC12012521',
    //         observacion: 'equipo presenta fallas tecnicos',
    //         tipo: 'SoftWare',
    //         estado: 'resuelto',
    //         fecha: '2024/05/23',
    //         asignado_po: 'Gonzao Valdez',
    //         creado_por: 'Gonzalo Valdez',
    //         prioridad: 'alta',
    //     },
    //     {
    //         numero_ticket: '#12215',
    //         cod_patrimonial: 'HGXC12012521',
    //         observacion: 'equipo presenta fallas tecnicos',
    //         tipo: 'SoftWare',
    //         estado: 'cerrado',
    //         fecha: '2024/05/23',
    //         asignado_po: 'Gonzao Valdez',
    //         creado_por: 'Gonzalo Valdez',
    //         prioridad: 'crítica',
    //     }
    // ];
    



    $(".btn_registrar_incidencias").click(function (e) {
        e.preventDefault();

        // // Generar un ID único para la nueva tarjeta
        // var tarjetaId = "tarjeta-" + contador;
        // contador++;

        

        // resultado.forEach(reco => {
        //     var nuevoHtml = `
        //     <div clas="col mb-4">
        //         <div class="card">
        //             <div class="card-header">
        //                 <div class="form-row d-flex justify-content-between">
        //                     <h5 class="flex-grow-1">#sjdfkjf</h5>
        //                     <h5 class="text-right">pendiente</h5>
        //                 </div>
        //             </div>
        //             <div class="card-body">
        //                 <h5 class="card-title">${reco.cod_patrimonial}</h5>
        //                 <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        //                 <a href="#" class="btn btn-primary">Go somewhere</a>
        //                 <button class="btn btn-danger btn_eliminar">Eliminar</button>
        //             </div>
        //             <div class="card-footer">
        //                 <p class="text-primary">Asignado: ${reco.asignado_po}</p>
        //                 <p class="text-secondary">Asignado: ${reco.creado_por}</p>
        //             </div>
        //         </div>
        //     </div>
            
        // `;

        // $("#contenedor_tarjetas").append(nuevoHtml);
        // });

        const data = {
            listar_tickets      :   "listar_tickets",
        }
        //console.log(data);

        $.post("Assets/ajax/Ajax.Incidencias.Tickets.php", data, function (response) {
                var js = JSON.parse(response);
                console.log(js);
            }   
        );

    });

    // Delegar el evento de click para los botones de eliminar
    $("#contenedor_tarjetas").on("click", ".btn_eliminar", function () {
        $(this).closest(".card").remove();
    });
});
