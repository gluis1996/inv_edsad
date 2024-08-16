$(document).ready(function() {
    $(".btn_exportar_asignacion").click(function() {
        const data = { event_exportar: 'event_exportar' };

        $.post("ruta/exportar.php", data, function(response) {
            // Aquí puedes manejar la respuesta si es necesario
            if(response.success) {
                window.location.href = response.file; // Redirige a la URL del archivo Excel generado
            } else {
                alert("Hubo un problema al exportar el archivo.");
            }
        }, "json");
    });
});
