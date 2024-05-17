$(document).ready(function () { 

    $('#btn_registrarEmpleado').click(function (e) {
        e.preventDefault();
        var nombre_empleado = $('#nombre_empleado').val();
        
       // console.log(nombre_empleado);

        const data = {
            registro_empleado : 'registro_empleado',
            nombre_empleado : nombre_empleado,
        }

        $.post('Assets/ajax/Ajax.empleado.php', data, function (response) {
            console.log(response);

        })
    })

})