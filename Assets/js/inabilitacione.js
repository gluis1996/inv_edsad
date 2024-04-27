// document.addEventListener('DOMContentLoaded', function() {
//   var varoCheck;
//   var os = document.getElementById('os');
//   var codAbonado = document.getElementById('codAbonado'); 
//   var botonEnviar = document.getElementById('btnenviar');
//   var CATV = document.getElementById('CATV');

//   var caja = document.getElementById('Caja');
//   var borne = document.getElementById('Borne');
//   var prec = document.getElementById('Precinto');

//   var api_vlan = document.getElementById('Vlan');
//   var api_megas = document.getElementById('Speed');

//   os.addEventListener('input', function() {
//     validarCampos();
//   });

//   codAbonado.addEventListener('input', function() {
//     validarCampos();
//   });

//   caja.addEventListener('input', function() {
//     validarCampos();
//   });

//   borne.addEventListener('input', function() {
//     validarCampos();
//   });

//   prec.addEventListener('input', function() {
//     validarCampos();
//   });


//   api_vlan.addEventListener('input', function() {
//     validarCampos();
//   });


  
//   // campoTexto.addEventListener('input', function() {
//   //   // Habilitar el botón si el campo de texto no está vacío
//   //   botonEnviar.disabled = campoTexto.value.trim() === '';
//   // });

//   function validarCampos() {
//     // Lógica de validación específica para cada campo de texto
//     var campoTextoValido = os.value.trim()!=='';
//     var codAbonadoValido = codAbonado.value.trim()!=='';
//     var cajavalido = caja.value.trim()!=='';
//     var bornevalido = borne.value.trim()!=='';
//     var precvalido = prec.value.trim()!=='';
//     var api_vlanvalido = api_vlan.value!=='';

//     // Lógica para habilitar o deshabilitar el botón
//     if (campoTextoValido && codAbonadoValido && cajavalido && bornevalido && precvalido && api_vlanvalido) {
//           botonEnviar.disabled = false;
//        // Habilitar el botón
//     } else {
//       botonEnviar.disabled = true; // Deshabilitar el botón
//     }
//   }


// });

