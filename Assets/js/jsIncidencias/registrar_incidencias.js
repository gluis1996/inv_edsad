$(document).ready(function () {

    //buscar incidencia

    $('.btn_buscar_equipo_asigando').click(function (e) { 
        e.preventDefault();
        var id_asignacion = $("#codigo_patrimonial_buscar").val();

        
        const data = {
            as_buscar : 'as_buscar',
            id_detalle_asignacion: id_asignacion,
        }

        console.log(data);

        $.post("Assets/ajax/Ajax.asignacion.php", data,
            function (response) {
                try {
                    // Verifica si la respuesta no está vacía
                    if (!response) {
                        throw new Error('Response is empty');
                    }
        
                    var js = JSON.parse(response);
                    console.log(js);
        
                    // Verifica si js tiene la estructura esperada
                    if (!js.idempleado || !js.empleados) {
                        throw new Error('Invalid response structure');
                    }
        
                    var id_empleado = js.idempleado;
                    var emp = js.empleados;
                    var resul = emp.find(item => item.idempleado == id_empleado);
        
                    // Verifica si se encontró el empleado
                    if (!resul) {
                        throw new Error('Employee not found');
                    }
        
                    $("#incidencias_nombre_empleado").val(resul.nombres);
                    $("#incidencia_nombre_equipo").val(js.equipo);

                } catch (error) {
                    // Captura el error y muestra un mensaje de error
                    console.error('Error:', error.message);
                }
            }
        );

    });

    $(".btn_registrar_incidencias").click(function (e) {
        e.preventDefault();

        

    });

    
});
