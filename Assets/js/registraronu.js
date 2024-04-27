var selectedObject = "";
var olt_id = "olt_id";
var pon_type = "pon_type";
var board = "board";
var port = "port";
var sn = "sn";
var onu_type_name = "onu_type_name";
var pon_description= "pon_description";
var busquedaRealizada = false;

$(document).ready(function () {
    mostrar_resultados();
    //capturarOLT();
    var varoCheck;
    // var tipoOLT='SmartOLT'; 

    $("#Mac").keypress(function (event) {

        if (event.keyCode === 13) { // Si se presiona Enter
            event.preventDefault();
            var mac = $("#Mac").val();
            consultarApi(mac);
        }  

    });
   
    function sitecombo() {
        let FILIAL = $('#FL').val();
        if (FILIAL == 1 || FILIAL ==2) {
            return 'SmartOLT';
        } else {
            return 'FiberHome';
        }
    }
    //Registrar instalacion
    $('.guardar').click(function (e) {//inicio
        e.preventDefault();
        
            $("#loading-icon-sv").show();

            let encargado = document.getElementById('usuario_sesion');
            let en = encargado.getAttribute('data-usu');

            let FILIAL = $('#FL').val();
            let tipoOnt = $('#sl_tipoont').val();
            let os = $('#os').val();
            let codAcceso = $('#codAcceso').val();
            let CAJA = $('#Caja').val();
            let BORNE = $('#Borne').val();
            let PREC = 'A' + $('#Precinto').val();
            let MAC = $('#Mac').val();
            let codAbonado = $('#codAbonado').val();
            var vlan = $('#Vlan').val();
            var mega = $('#Speed').val();
            
            var nuevomega = mega+'M';
            var nuevopondescripcion ;
            var nuevoSpeed;
            var tipoOLT= sitecombo();
            var onu_mode2;
            if (tipoOnt === 'CATV1') {
                onu_mode2 = 'Bridging';
            }else if (tipoOnt === 'CABLEPERU') {
                onu_mode2 = 'Routing';
            }
    
            if (pon_description == '') {
                nuevopondescripcion = 'ANTARES';
            }else{
                nuevopondescripcion = pon_description;
            }
            
            if (varoCheck == 'habilitado') {
                nuevoSpeed = 'CATV';
            }else if(varoCheck == 'inahabilitado'){
                nuevoSpeed = nuevomega;
            }else{
                nuevoSpeed = nuevomega;
            }
            
        
            const data = {
                operador : en,
                FILIAL : FILIAL,
                os : os,
                codAbonado: codAbonado,
                nodo: codAcceso,
                CAJA : CAJA,
                BORNE : BORNE,
                PREC : PREC,
                MAC : MAC,
                OLT : tipoOLT,
                
                autorisarONU: 'autorisar',
                olt_id: olt_id || 'olt_id',
                pon_type: pon_type || 'pon_type',
                board: board || 'board',
                port: port || 'port',
                sn: sn || 'sn',
                onu_type_name: onu_type_name || 'onu_type_name',
                vlan: vlan || 'vlan',
                onu_type : tipoOnt,
                zone: nuevopondescripcion || 'nuevopondescripcion',
                name: codAcceso || 'codAcceso',
                onu_mode: onu_mode2,
                onu_external_id: sn || 'sn',
                upload_speed_profile_name: nuevoSpeed || 'subida',
                download_speed_profile_name: nuevoSpeed || 'bajada',
                address_or_comment : 'caja '+CAJA+' Borne '+BORNE+ ' Precinto '+PREC,
            }
            console.log(data);
            

            Swal.fire({
                title: "Desea Registrar?",
                text: "Se va a registrara "+ MAC +' con el plan de '+ nuevoSpeed,
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

                        if (response === "[]ok" || response === "ok") {
                            // Mostrar la alerta de éxito
                            Swal.fire({
                                title: "Exito!",
                                text: "Se registro satisfactoriamente",
                                icon: "success"
                            });
                            limpiar();
                            listardatos2();

                            $('#defaultCheck1').prop('checked', false);
                            $('#codAcceso').prop('readonly', true);
                            $("#btnenviar").prop("disabled", true);
                            $("#mostrar_datos_seleccionado").empty();
                            
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
    
        })//fin



    $('#CATV').click(function () {
        // Si el checkbox está marcado, deshabilita el input
        if ($(this).is(':checked')) {
          $('#Speed').prop('disabled', true);
          console.log('habilitado');
          varoCheck = 'habilitado';
        } else {
          // Si el checkbox está desmarcado, habilita el input
          $('#Speed').prop('disabled', false);
          console.log('inahabilitado');
          varoCheck = 'inahabilitado';
        }
      });

      //funcion que muestra las instalacion realizadas
      function mostrar_resultados() {
        let encargado = document.getElementById('usuario_sesion');
        let en = encargado.getAttribute('data-usu');
        var dash = document.getElementById('dashboard');
        const data = {
            card_listar: 'card_listar',
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
                title.textContent = item.nombre;
    
                var number = document.createElement("div");
                number.className = "number";
                number.textContent = item.cantidad;
                
                box.appendChild(title);
                box.appendChild(number);
                
                dash.appendChild(box);
            });
        });
    }
    
})



function limpiar() {
    $('#FL').val('');
    $('#os').val('');
    $('#codAcceso').val('');
    $('#Caja').val('');
    $('#Borne').val('');
    $('#Precinto').val('');
    $('#Mac').val('');
    $('#codAbonado').val('');
    $('#Vlan').val('');
    $('#Speed').val('');
}

function consultarApi(mac) {
    $("#loading-icon").show();
    var elemtotext = document.getElementById("codAcceso");
    const data = {
        consultaonu : 'consultaonu',
        mac : mac,
    };
    
    $.ajax({
    type: "POST",
    url: "Assets/interacciones.php",
    data: data,
    beforeSend: function () {
        // Puedes agregar más lógica aquí si es necesario
    },
    success: function (response) {
        // Decodificar la respuesta JSON
        var data = JSON.parse(response);
        console.log(data);
        // // Obtener el valor de "sn"
        $("#mostrar_resultado").empty();

            // Iterar sobre cada resultado y agregarlo al contenedor
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    var obj = data[key];
                    var snValue = "OLT :" + obj.olt_name + " - SN:" + obj.sn + " - DESCRIPCION :"+obj.pon_description + " - TARJETA :"+obj.board + " - PON:"+obj.port;
                    var snElemenet = $("<button>")
                                    .text(snValue)
                                    .attr("data-id",key)
                                    .addClass("btn btn-success")
                                    .addClass("col-sm")
                                    .css({"font-size": "20px",margin: "3px"});
                    
                    $("#mostrar_resultado").append(snElemenet);
                    $("#mostrar_datos_seleccionado").empty();
                    //Funcion para darle enter y buscar mac.
                    snElemenet.click(function (h) {
                        h.preventDefault();
                        var clickedid= $(this).attr("data-id");
                        console.log("ID elemento clikeado: "+clickedid);
                        $("#mostrar_resultado").empty();
                        selectedObject = data[clickedid];
                        olt_id = selectedObject.olt_id;
                        olt_name = selectedObject.olt_name;
                        pon_type = selectedObject.pon_type;
                        board = selectedObject.board;
                        port = selectedObject.port;
                        sn = selectedObject.sn;
                        onu_type_name = selectedObject.onu_type_name;
                        pon_description = selectedObject.pon_description;
                        
                         //parse del codigo
                        var longitudboard = board.toString().length;
                        var longitudport = port.toString().length;
                        var newboard = '';
                        var newport = '';
                        console.log(longitudboard);
                        if (longitudboard == 1){
                            newboard = '0'+board.toString();
                        }else if (longitudboard == 2) {
                            newboard = board.toString();
                        }

                        if (longitudport==1) {
                            newport = '0'+port.toString();
                        }else if (longitudport == 2) {
                            newport = port.toString();
                        }
                        //fin parse del codigo
                        
                        var databoard = $("<input>")
                            .attr("type", "text")
                            .addClass("form-control")
                            .val("board: " + board)
                            .css({
                                "font-weight": "bold",
                                "color": "red",
                                "width": "100px"})
                            .prop("readonly", true);

                        var dataport = $("<input>")
                            .attr("type", "text")
                            .addClass("form-control")
                            .val("port: "+port)
                            .css({
                                "font-weight": "bold",
                                "color": "red",
                                "width": "100px"})
                            .prop("readonly", true);
                        
                        var dataolt = $("<input>")
                            .attr("type", "text")
                            .addClass("form-control")
                            .val("OLT: "+olt_name)
                            .css({
                                "font-weight": "bold",
                                "color": "red",
                                "width": "300px"})
                            .prop("readonly", true);



                        var dataSN = $("<input>")
                            .attr("type", "text")
                            .addClass("form-control")
                            .val("SN: "+sn)
                            .css({
                                "font-weight": "bold",
                                "color": "red",
                                "width": "200px"})
                            .prop("readonly", true);

                        var boardDiv  = $("<div>")
                            .addClass("col")
                            .append(databoard);
                                        
                        var portDiv  = $("<div>")
                            .addClass("col")
                            .append(dataport);

                        var oltDiv  = $("<div>")
                            .addClass("col")
                            .append(dataolt);

                        $("#mostrar_datos_seleccionado").append(oltDiv, boardDiv,portDiv,dataSN);

                        $("#btnenviar").prop("disabled", false);
                        var codiactual = elemtotext.value;
                        var nd = codiactual+newboard+newport;
                        elemtotext.value = nd;
                    })
                
                
                }
            }
    },
    error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", xhr.responseText);
        alert("Error al realizar la consulta. Consulta la consola para más detalles.");
    },
    complete: function () {
        // Ocultar el ícono de carga después de completar la solicitud
        $("#loading-icon").hide();
    }
    });
}

