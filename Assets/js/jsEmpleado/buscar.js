$(document).ready(function () {

    //listar equipos por cada empleado
    $("#tb_registrar_empleados").on("click", "[id^='id_empleado_buscar_']", function (e) {
            e.preventDefault();
            var id = $(this).attr("id_empleado");
            console.log(id);
            
            const data = {
                buscar_empleado_codigo: 'buscar_empleado_codigo',
                codigo_empleado: id,
            }

            $.post('Assets/ajax/Ajax.empleado.php',data,function (response) {
                var res = JSON.parse(response);
                console.log(res);
                $('#em_edi_titulo').text('Editar Empleado : #'+res.idempleado);
                $('#em_edit_codigo').val(res.idempleado);
                $('#em_edi_nombre_empleado').val(res.nombres);
                $('#em_edi_apellido_empleado').val(res.apellidos);
                $('#em_edi_dni').val(res.dni);
                $('#em_edi_numero').val(res.numero);
                $('#em_edi_correo_personal').val(res.correo_personal);
                $('#em_edi_correo-institucional').val(res.correo_institucional);

                $('#em_edi_select_cargo').empty();
                $('#em_edi_tipo_contrato').empty();
                $('#em_edi_select_direccion').empty();  

                res.nombre_cargo.forEach(nombre_cargo => {
                    $('#em_edi_select_cargo').append(
                        $('<option>',{
                            value: nombre_cargo.idcargo,
                            text: nombre_cargo.nombre_cargo
                        })
                    );
                });
                
                res.nombre_tipo_contrato.forEach(nombre_tipo_contrato => {
                    $('#em_edi_tipo_contrato').append(
                        $('<option>',{
                            value: nombre_tipo_contrato.idtipo_contrato,
                            text: nombre_tipo_contrato.nombre_tipo_contrato
                        })
                    );
                });
                
                res.nombre_direccion.forEach(nombre_direccion => {
                    $('#em_edi_select_direccion').append(
                        $('<option>',{
                            value: nombre_direccion.iddireccion_oficina,
                            text: nombre_direccion.nombre_direccion
                        })
                    );
                });

                $('#em_edi_dia').val(res.fecha_cunpleaños);
                $('#em_edi_mes').val(res.mes_cumpleaños.toUpperCase());
                $('#em_edi_select_cargo').val(res.idcargo);
                $('#em_edi_tipo_contrato').val(res.idtipo_contrato);
                $('#em_edi_select_direccion').val(res.iddireccion_oficina);
            })
        }
    );

})


