$(document).ready(function () {
    
    listardatosEoC();
    mostrar_resultados_eoc();

    $('#eoc_abonado').on('input', function () {
        let eoc_abonado =  $('#eoc_abonado').val();
        let codAccesoValue = '';        
        codAccesoValue = eoc_abonado + '@'; 
        $('#eoc_nodo').val(codAccesoValue);
    })

    $('.btn_instalarEoC').click(function (e) {
        e.preventDefault();
        
        let encargado = document.getElementById('usuario_sesion');
        let en = encargado.getAttribute('data-usu');
        let filial = $('#FL').val();
        let eoc_abonado = $('#eoc_abonado').val();
        let eoc_os = $('#eoc_os').val();
        let eoc_nodo = $('#eoc_nodo').val();
        let eoc_mac = $('#eoc_mac').val();
        let eoc_coordenadas = $('#eoc_coordenadas').val();

        const data = {
            eoc_instalacion : 'eoc_instalacion',
            filial : filial,
            eoc_os : eoc_os,
            operador : en,
            eoc_abonado : eoc_abonado,
            eoc_nodo : eoc_nodo,
            eoc_vlan : '--',
            eoc_mac : eoc_mac,
            eoc_speed : '--',
            eoc_coordenadas : eoc_coordenadas,
        }

        console.log(data);

        Swal.fire({
            title: "Desea Registrar?",
            text: "Se va a registrara "+ eoc_mac,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Hacer la petición al servidor y manejar la respuesta
                $.post('Assets/interacciones.php', data, function (response) {
                    // var js = JSON.parse(response);
                    // console.log(js);
                    
                    console.log(response);

                    if (response === "ok") {
                        // Mostrar la alerta de éxito
                        Swal.fire({
                            title: "Exito!",
                            text: "Se registro satisfactoriamente",
                            icon: "success"
                        });
                        limpiar_eoc();
                        listardatosEoC();
                        mostrar_resultados_eoc();
                        
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



    })

  

      //Listar cantidad de instalaciones :
    function mostrar_resultados_eoc() {
        let encargado = document.getElementById('usuario_sesion');
        let en = encargado.getAttribute('data-usu');
        var dash = document.getElementById('dashboard_eoc');

        const data = {
            card_listarEOC: 'card_listarEOC',
            operador: en,
        }

        // Antes de agregar nuevos elementos, eliminemos los existentes
        $('.box_eoc').remove(); // Esto eliminará todos los elementos con la clase 'box_eoc'


        $.post('Assets/tablas.php', data, function(response) {
            console.log(response);
            var data = JSON.parse(response);

            data.data.forEach(function(item) {
                var box = document.createElement("div");
                box.className = "box_eoc";

                var title = document.createElement("h2");
                title.textContent = item.nombre;

                var number = document.createElement("div");
                number.className = "number_eoc";
                number.textContent = item.cantidad;
                
                box.appendChild(title);
                box.appendChild(number);
                
                dash.appendChild(box);
            });
        });
    }


})


function listardatosEoC(){
    let encargado = document.getElementById('usuario_sesion');
    let en = encargado.getAttribute('data-usu');
    const data = {
        listarinstalacionEoC: 'listarinstalacionEoC',
        operador : en,
    }
    // console.log(data);
    $.ajax({
        url: "Assets/tablas.php",
        data: data,
        type: 'POST',
        success:function(response){
            //console.log(response);
        }
    })
    $('#tbl_instalacionesEoC').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        //"paging": false,       // Quitar paginación
        //"searching": false,    // Quitar barra de búsqueda
        "info": false,         // Quitar información de registros
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 10,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "columns": [
            { "data": "codigo"},
            { "data": "filial"},
            { "data": "fecha"},
            { "data": "acciones"}
        ]
    });
}


function limpiar_eoc() {
    $('#FL').val('');
    $('#eoc_abonado').val('');
    $('#eoc_os').val('');
    $('#eoc_nodo').val('');
    $('#eoc_mac').val('');
    $('#eoc_vlan').val('');
    $('#eoc_speed').val('');
    $('#eoc_coordenadas').val('');
}







//Listar informacion de consumo de datos
function listardatos_raddacct_instalacion(codigo){

    const data={
        consultaDatos2 : 'consultaDatos2',
        username : codigo,
    }
    $('#tbl_raddact_estado_instalacion').DataTable({
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
