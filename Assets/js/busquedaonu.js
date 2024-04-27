// var selectedObject = "";
// var olt_id = "olt_id";
// var pon_type = "pon_type";
// var board = "board";
// var port = "port";
// var sn = "sn";
// var onu_type_name = "onu_type_name";
// var pon_description= "pon_description";

// $(document).ready(function () {

//         $("#Mac").keypress(function (event) {

//             if (event.keyCode === 13) { // Si se presiona Enter
//                 event.preventDefault();
//                 var mac = $("#Mac").val();
//                 consultarApi(mac);
//             }  
    
//         });
    


//     function consultarApi(mac) {
//         $("#loading-icon").show();
//         var elemtotext = document.getElementById("codAcceso");
//         const data = {
//             consultaonu : 'consultaonu',
//             mac : mac,
//         };
        
//         $.ajax({
//         type: "POST",
//         url: "Assets/interacciones.php",
//         data: data,
//         beforeSend: function () {
//             // Puedes agregar más lógica aquí si es necesario
//         },
//         success: function (response) {
//             // Decodificar la respuesta JSON
//             var data = JSON.parse(response);
//             console.log(data);
//             // // Obtener el valor de "sn"
//             $("#mostrar_resultado").empty();

//                 // Iterar sobre cada resultado y agregarlo al contenedor
//                 for (var key in data) {
//                     if (data.hasOwnProperty(key)) {
//                         var obj = data[key];
//                         var snValue = "SN :" + obj.sn + " - DESCRIPCION :"+obj.pon_description + " - TARJETA :"+obj.board + " - PON:"+obj.port;
//                         var snElemenet = $("<button>")
//                                         .text(snValue)
//                                         .attr("data-id",key)
//                                         .addClass("btn btn-secondary")
//                                         .addClass("col-sm")
//                                         .css({"font-size": "20px",margin: "3px"});
                        
//                         $("#mostrar_resultado").append(snElemenet);
//                         $("#mostrar_datos_seleccionado").empty();
//                         //Funcion para darle enter y buscar mac.
//                         snElemenet.click(function (h) {
//                             h.preventDefault();
//                             var clickedid= $(this).attr("data-id");
//                             console.log("ID elemento clikeado: "+clickedid);
//                             $("#mostrar_resultado").empty();
//                             selectedObject = data[clickedid];
//                             olt_id = selectedObject.olt_id;
//                             pon_type = selectedObject.pon_type;
//                             board = selectedObject.board;
//                             port = selectedObject.port;
//                             sn = selectedObject.sn;
//                             onu_type_name = selectedObject.onu_type_name;
//                             pon_description = selectedObject.pon_description;
                            
//                              //parse del codigo
//                             var longitudboard = board.toString().length;
//                             var longitudport = port.toString().length;
//                             var newboard = '';
//                             var newport = '';
//                             console.log(longitudboard);
//                             if (longitudboard == 1){
//                                 newboard = '0'+board.toString();
//                             }else if (longitudboard == 2) {
//                                 newboard = board.toString();
//                             }

//                             if (longitudport==1) {
//                                 newport = '0'+port.toString();
//                             }else if (longitudport == 2) {
//                                 newport = port.toString();
//                             }
//                             //fin parse del codigo
                            
//                             var databoard = $("<input>")
//                                 .attr("type", "text")
//                                 .addClass("form-control")
//                                 .val("board: " + board)
//                                 .css({
//                                     "font-weight": "bold",
//                                     "color": "red"})
//                                 .prop("readonly", true);

//                             var dataport = $("<input>")
//                                 .attr("type", "text")
//                                 .addClass("form-control")
//                                 .val("port: "+port)
//                                 .css({
//                                     "font-weight": "bold",
//                                     "color": "red"})
//                                 .prop("readonly", true);
                            


//                             var boardDiv  = $("<div>")
//                                 .addClass("col-sm")
//                                 .append(databoard);

                                            
//                             var portDiv  = $("<div>")
//                                 .addClass("col-sm")
//                                 .append(dataport);

//                             $("#mostrar_datos_seleccionado").append(boardDiv,portDiv,);

//                             $("#btnenviar").prop("disabled", false);
//                             var codiactual = elemtotext.value;
//                             var nd = codiactual+newboard+newport;
//                             elemtotext.value = nd;
//                         })
                    
                    
//                     }
//                 }
//         },
//         error: function (xhr, status, error) {
//             console.error("Error en la solicitud AJAX:", xhr.responseText);
//             alert("Error al realizar la consulta. Consulta la consola para más detalles.");
//         },
//         complete: function () {
//             // Ocultar el ícono de carga después de completar la solicitud
//             $("#loading-icon").hide();
//         }
//         });
//     }

//     // Agrega cualquier otro código JavaScript que necesites aquí
// });
