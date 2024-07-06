$(document).ready(function () {
    var contador = 0;
    $(".btn_registrar_incidencias").click(function (e) {
        e.preventDefault();

        // Generar un ID único para la nueva tarjeta
        var tarjetaId = "tarjeta-" + contador;
        contador++;

        var nuevoHtml = `
            <div class="card m-1" style="width: 18rem;" id="${tarjetaId}">
                <h5 class="card-header">${tarjetaId}</h5>
                <div class="card-body">
                    <h5 class="card-title">${tarjetaId}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    <button class="btn btn-danger btn_eliminar">Eliminar</button>
                </div>
            </div>
        `;

        $("#contenedor_tarjetas").append(nuevoHtml);
    });

    // Delegar el evento de click para los botones de eliminar
    $("#contenedor_tarjetas").on("click", ".btn_eliminar", function () {
        $(this).closest(".card").remove();
    });
});
