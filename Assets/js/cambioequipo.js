$(document).ready(function () {
    mostrar_resultados_ateciones();

    $('.cerrarmodal').click(function (e) {
        $('#ce_select').empty();
    })

    $('.cerrarmodalatc').click(function (e) {
        $('#atc_select2').empty();
    })

    
    ///evento para gestion registrar atencion
    // $(document).on('click', function (events) {
    //     if (!$(event.target).closest('modal_registrar_atc').length) {
    //        $('#modal_registrar_atc').modal('hide');
    //        $('#atc_select2').empty();
    //     }

        
    //     $('#modal_registrar_atc').on('click', function(event) {
    //         // Detener la propagación del evento para evitar que se cierre el modal
    //         event.stopPropagation();
    //     });

    // })

    //BUSQUEDA POR BOTON
    $('.btn_buscar_abonado').click(function (e) {
        e.preventDefault();

        let codigo = $('#codAbonado').val();
        
        listardatos_radcheck(codigo)

    })


    //BUSQUEDA POR ENTER
    $("#codAbonado").keypress(function (event) {

        if (event.keyCode === 13) { // Si se presiona Enter
            event.preventDefault();
            var codAbonado = $("#codAbonado").val();
            listardatos_radcheck(codAbonado)
        }  

    });


    //gsetion de equipo.
    $('#tbl_radcheck').on("click",".tbl_radcheck",function (e) {
        e.preventDefault();
        
        let iduser = $(this).attr("iduser");
        let cod = $(this).attr("username");
        let mac = $(this).attr("value");
        var plan = $(this).attr("plan");   
        var onuID = $(this).attr("onuID"); 
        //elemento.innerHTML=cod;

        console.log(onuID);
        // const data = {
        //     detalle_instalacion : "detalle_instalacion",
        //     codigo: cod,
        //     plan: plan,
        // };
        listar_grupo_select();
        $("#c_iduser").val(iduser);
        $("#c_username").val(cod);
        $("#c_mac").val(mac);
        $("#ce_select").val(plan);
        $("#c_sn").val(onuID);

        

    })





    //boton actualizar abonado
    $('.btn_actualizar_radius').click(function (e) {
        e.preventDefault();
        var iduser = $("#c_iduser").val();
        var user = $("#c_username").val();
        var mac = $("#c_mac").val();
        var plan = $("#ce_select").val();

        const data = {
            av_cambiodeplan: 'av_cambiodeplan',
            av_user: user,
            groupname: plan,
            iduser: iduser,
            mac: mac,
        }

        console.log(data);

        Swal.fire({
            title: "Desea Registrar?",
            text: "Se va a cambiar de plan "+ user +' con el plan de '+ plan,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Hacer la petición al servidor y manejar la respuesta
                $.post('Assets/tablas.radius.php', data, function (response) {
                    
                    console.log(response);

                        if (response === "[]ok" || response === "ok") {
                            // Mostrar la alerta de éxito
                            Swal.fire({
                                title: "Exito!",
                                text: "Se registro satisfactoriamente",
                                icon: "success",
                                timer: 2000, // Tiempo en milisegundos (2 segundos)
                                timerProgressBar: true, // Barra de progreso del temporizador
                                showConfirmButton: false // Ocultar botón de confirmación
                            });

                            
                            
                        } else{
                            alert(response);
                        }

                });
                $('#modal_detalle_cambioEquipo').modal('hide');
            } else {

            }
        });


    })//Fin


    //Eliminar abonado del Radius
    $('#tbl_radcheck').on("click",".btnEliminarRadius",function (e) {
        e.preventDefault();
        let cod = $(this).attr("deleteusername");
        //elemento.innerHTML=cod;

        const data = {
            sce_elimnarusuario : "sce_elimnarusuario",
            username: cod,
        };

        console.log(data);

        Swal.fire({
            title: "Desea Eliminar?",
            text: "Se va a Eliminar a "+ cod ,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Hacer la petición al servidor y manejar la respuesta
                //console.log('exitos');
                $.post('Assets/interacciones.php',data,function (response){
                    // var js = JSON.parse(response);
                    // console.log(js);
                    
                    console.log(response);

                    if (response === "[]ok" || response === "ok") {
                        // Mostrar la alerta de éxito
                        Swal.fire({
                            title: "Exito!",
                            text: "Se Elimino satisfactoriamente",
                            icon: "success"
                        });

                        listardatos_radcheck(cod);
                    } else{
                        alert(response);
                    }

                    $("#loading-icon-sv").hide();
                });
            } else {
                // El usuario canceló la operación
                $("#loading-icon-sv").hide();
            }
        });






        // $.post('Assets/interacciones.php',data,function (response){
        //     console.log(response);
        // })

    })


    //Consulatar cosumo de abonado
    $('#tbl_radcheck').on("click",".btn_raddact",function (e){
        e.preventDefault();

        var cod = $(this).attr("username");

        listardatos_raddacct(cod);

    })

    //registrar atencion de averia.
    $('#tbl_radcheck').on('click','.btn_registrar_atc',function(e){
        e.preventDefault();
        $('#atc_registrar_averia').prop('disabled', false);
        
        listar_grupo_select_averia();
        var cod = $(this).attr("username");
        var miLabel = document.getElementById('abonado');
        miLabel.textContent= cod;
        miLabel.style.color = 'blue';
        
        
    })//fin

    $('#atc_registrar_averia').click(function (e) {
        e.preventDefault();
        let encargado = document.getElementById('usuario_sesion');
        let en = encargado.getAttribute('data-usu');
        var miLabel = document.getElementById('abonado');
        var valorLabel = miLabel.textContent;
        var orden = $('#atc_os').val();
        var tipo = $('#atc_select2').val();
        var area = $('#atc_area').val();
        const data = {
            atc_registrar : 'atc_registrar',
            operador : en,
            abonado : valorLabel,
            orden : orden,
            t_orden : tipo,
            area : area,
        }
        console.log(data);

        Swal.fire({
            title: "Desea Registrar?",
            text: "Se va a registrara la Atencion",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.post('Assets/interaccion.averia.php', data, function (response) {
                       
                        if (response == 'ok') {
                            Swal.fire({
                                title: "Exito!",
                                text: "Se registro satisfactoriamente",
                                icon: "success",
                                timer: 1000, // Tiempo en milisegundos (2 segundos)
                                timerProgressBar: true, // Barra de progreso del temporizador
                                showConfirmButton: false // Ocultar botón de confirmación
                            })
                            mostrar_resultados_ateciones();
                        }else{
                            alert(response);
                        }
                });
                $('#modal_registrar_atc').modal('hide');
                $(this).prop('disabled', true);
            } else {
                // El usuario canceló la operación
                alert("Registro fallido");
            }
        });


    })

    //Actualizar Catv
    $('#tbl_radcheck').on("click","#estdo_catv",function (e){
        e.preventDefault();

        var sn = $(this).attr("on_sn");
        var estado = $(this).attr("estado");
        var usuario = document.getElementById('abonado');

        const data = {
            actualizarCatv : 'actualizarCatv',
            sn : sn,
            estado : estado,
        }

        Swal.fire({
            title: "Desea Actualizar?",
            text: "Se va a cambiar el estado de cable al usuario "+usuario,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Cargando...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // Hacer la petición al servidor y manejar la respuesta
                $.post('Assets/tablas.radius.php', data, function (response) {
                     // Ocultar el loader
                    console.log(response);

                    if (response == 'succes') {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'La actualización se realizó correctamente.'
                        });
                    }


                });
            } else {

            }
        });

    })
    
    //Actualizar onu sn
    $('.btn_actualizar_sn').click((function (e) {
        e.preventDefault();

        var valor_onu_id = $('#c_sn').val();
        var user = $("#c_username").val();
        const data ={
            'pg_ce_abn_onu' :'pg_ce_abn_onu',
            valor_onu_id:valor_onu_id,  
            username: username,
            filial : filial,
        }
        
        Swal.fire({
            title: "Desea Actualizar?",
            text: "Se va a cambiar la onu ID ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Cargando...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // Hacer la petición al servidor y manejar la respuesta
                $.post('Assets/tablas.radius.php', data, function (response) {
                     // Ocultar el loader
                    console.log(response);

                    if (response == 'succes') {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'La actualización se realizó correctamente.'
                        });
                    }


                });
            } else {

            }
        });



    }))

})

   //funcion que muestra resumende atencione en card

function mostrar_resultados_ateciones() {
    let encargado = document.getElementById('usuario_sesion');
    let en = encargado.getAttribute('data-usu');
    var dash = document.getElementById('dashboard_cambioequipo');
    const data = {
        card_listar_atenciones: 'card_listar_atenciones',
        operador: en,
    }
    $('.box').remove();
    $.post('Assets/tablas.php', data, function(response) {
        //console.log(response);
        var data = JSON.parse(response);

        data.data.forEach(function(item) {
            var box = document.createElement("div");
            box.className = "box";

            var title = document.createElement("h2");
            title.textContent = item.orden_o_area;

            var number = document.createElement("div");
            number.className = "number";
            number.textContent = item.cantidad;
            
            box.appendChild(title);
            box.appendChild(number);
            
            dash.appendChild(box);
            });
        });
}

function listar_grupo_select() {
    const data = {
        sce_radgroupreply: 'sce_radgroupreply',
    };
    $.ajax({
        type : 'POST',
        data : data,
        url : 'Assets/interacciones.php',
        success:function (respose) {
            var js = JSON.parse(respose);

            $.each(js, function (index, fila) { 
                $("#ce_select").append('<option value="'+fila.groupname+'">'+fila.groupname+'</option>');
            });
            $("#ce_select").select2();
        }
    })
}

//Listar informacion de consumo de datos
function listar_grupo_select_averia() {
    const data = {
        select_averia: 'select_averia',
    };
    $.ajax({
        type : 'POST',
        data : data,
        url : 'Assets/interaccion.averia.php',
        success:function (response) {
            console.log(response);
            var js = JSON.parse(response);

            $.each(js, function (index, fila) { 
                $("#atc_select2").append('<option value="'+fila.nombre+'">'+fila.nombre+'</option>');
            });
        }
    })
}


function listardatos_radcheck(codigo){

    const data = {
        radcheck: 'radcheck',
        username: codigo,
    }
    // console.log(data);
    $.ajax({
        url: "Assets/tablas.radius.php",
        data: data,
        type: 'POST',
        success:function(response){
            //console.log(response);
        }
    })
    $('#tbl_radcheck').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.radius.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        "paging": false,       // Quitar paginación
        "searching": false,    // Quitar barra de búsqueda
        "info": false,         // Quitar información de registros
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 10,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "columns": [
            { "data": "id"},
            { "data": "username"},
            { "data": "value"},
            { "data": "plan"},
            { "data": "estado"},
            { "data": "OLT"},
            { "data": "NIVELES"},
            { "data": "VLAN"},
            { "data": "CATV"},
            { "data": "acciones"}
            
        ]
    });
}

//Listar informacion de consumo de datos
function listardatos_raddacct(codigo){

    const data={
        consultaDatos : 'consultaDatos',
        username : codigo,
    }
    // console.log(data);
    $('#tbl_raddact').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.raddact.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        "paging": false,       // Quitar paginación
        "searching": false,    // Quitar barra de búsqueda
        "info": false,         // Quitar información de registros
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 10,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "columns": [
            { "data": "IPaddrress"},
            { "data": "start_time"},
            { "data": "Stop_time"},
            { "data": "Total_time"},
            { "data": "upload"},
            { "data": "download"},
            { "data": "Termination"},
            { "data": "nas_ip_address"}
            
        ],"createdRow": function (row, data, index) {
            var uploadValue = data.upload;
    
            if (uploadValue === '0 Bytes') {
                $(row).css('background-color', '#c8e6c9'); // Fondo verde
            }
        }
    });
}
