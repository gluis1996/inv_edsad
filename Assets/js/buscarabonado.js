$(document).ready(function () {

    $(".btn_ba_abonado").click(function (e) {
        e.preventDefault();
        var codigoTexto = document.getElementById("ba_abonado").value;
        var estadocheck = $("#flexSwitchCheckDefault").prop("checked");
        var tipo;
        if (estadocheck != true) {
            tipo = 'no smart'
        }else{
            tipo = 'SmartOlt';
        }

        // Dividir los códigos por coma y eliminar espacios en blanco
        var codigosArray = codigoTexto.split(',').map(function(codigo) {
            return codigo.trim();
        });

        // Crear una cadena con la estructura deseada
        var cadenaResultado = "'" + codigosArray.join("','") + "'";

        console.log(cadenaResultado);

        buscar_abonado(cadenaResultado,tipo);

    })


    $(".btn_ba_mac").click(function (e) {
        e.preventDefault();
        var codigoTexto = document.getElementById("ba_mac").value;
        var estadocheck = $("#flexSwitchCheckDefault").prop("checked");
        var tipo;
        if (estadocheck != true) {
            tipo = 'no smart'
        }else{
            tipo = 'SmartOlt';
        }

        // Dividir los códigos por coma y eliminar espacios en blanco
        var codigosArray = codigoTexto.split(',').map(function(codigo) {
            return codigo.trim();
        });

        // Crear una cadena con la estructura deseada
        var cadenaResultado = "'" + codigosArray.join("','") + "'";

        console.log(cadenaResultado);

        buscar_abonado_por_mac(cadenaResultado,tipo);

    })

    
    $(".btn_ba_nodo").click(function (e) {
        e.preventDefault();
        var codigoTexto = document.getElementById("ba_nodo").value;
        var estadocheck = $("#flexSwitchCheckDefault").prop("checked");
        var tipo;
        if (estadocheck != true) {
            tipo = 'no smart'
        }else{
            tipo = 'SmartOlt';
        }
        // Dividir los códigos por coma y eliminar espacios en blanco
        var codigosArray = codigoTexto.split(',').map(function(codigo) {
            return codigo.trim();
        });

        // Crear una cadena con la estructura deseada
        var cadenaResultado = "'" + codigosArray.join("','") + "'";

        console.log(cadenaResultado);

        buscar_abonado_por_nodo(cadenaResultado,tipo);

    })




     //Actualizar Catv
     $('#tbl_ba_resultado').on("click","[id^='estdo_catv_1']",function (e){
        e.preventDefault();
        var id = $(this).attr("id");
        var sn = $(this).attr("on_sn");
        var estado = $(this).attr("estado");
        var usuario = document.getElementById('abonado');
        
        // Mostrar el indicador de carga específico para este elemento
        var loader = $("#" + id).parent().find('.loader');
        loader.show();

       
        const data = {
            actualizarCatv : 'actualizarCatv',
            sn : sn,
            estado : estado,
        }

        $.post('Assets/tablas.radius.php', data, function (response) {
            // Ocultar el loader
           console.log(response);

           if (response == 'succes') {
               // Obtener el estado actual del interruptor
                var switchState = $("#" + id).prop('checked');

                // Cambiar el estado del interruptor
                $("#" + id).prop('checked', !switchState);
                loader.hide();
           }


       });


    })
    



})

//Funcion buscar por codigo abonado
function buscar_abonado(codigo, tipo ){

    const data = {
        ba_abonado: 'ba_abonado',
        tipo: tipo,
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
    $('#tbl_ba_resultado').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.radius.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        "paging": false,       // Quitar paginación
        "searching": true,    // Quitar barra de búsqueda
        "info": true,         // Quitar información de registros
        "ordering": true,     // Quitar la capacidad de ordenar
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
            
        ],        
        responsive: 'true',
        dom: '<"top"iBfrtlp><"clear">', // Colocar información de registros al principio
        buttons: [
            {
                extend: 'excelHtml5',
                text:   '<i class="fas fa-file-excel"></i>',
                tittleAttr: 'export a excel',
                className: 'btn btn-success' 
            }
        ]
    });
}


//Funcion buscar por codigo mac
function buscar_abonado_por_mac(codigo, tipo){

    const data = {
        ba_abonado_mac: 'ba_abonado_mac',
        tipo: tipo,
        username: codigo,
    }
    console.log(data);
    $.ajax({
        url: "Assets/tablas.radius.php",
        data: data,
        type: 'POST',
        success:function(response){
            console.log(response);
        }
    })
    $('#tbl_ba_resultado').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.radius.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        "paging": false,       // Quitar paginación
        "searching": true,    // Quitar barra de búsqueda
        "info": true,         // Quitar información de registros
        "ordering": true,     // Quitar la capacidad de ordenar
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
            
        ],        
        responsive: 'true',
        dom: '<"top"iBfrtlp><"clear">', // Colocar información de registros al principio
        buttons: [
            {
                extend: 'excelHtml5',
                text:   '<i class="fas fa-file-excel"></i>',
                tittleAttr: 'export a excel',
                className: 'btn btn-success' 
            }
        ]
    });
}


//Funcion buscar por codigo mac
function buscar_abonado_por_nodo(codigo,tipo){

    const data = {
        ba_abonado_nodo: 'ba_abonado_nodo',
        tipo: tipo,
        username: codigo,
    }
    console.log(data);
    $.ajax({
        url: "Assets/tablas.radius.php",
        data: data,
        type: 'POST',
        success:function(response){
            console.log(response);
        }
    })
    $('#tbl_ba_resultado').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.radius.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        "paging": false,       // Quitar paginación
        "searching": true,    // Quitar barra de búsqueda
        "info": true,         // Quitar información de registros
        "ordering": true,     // Quitar la capacidad de ordenar
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
            
        ],        
        responsive: 'true',
        dom: '<"top"iBfrtlp><"clear">', // Colocar información de registros al principio
        buttons: [
            {
                extend: 'excelHtml5',
                text:   '<i class="fas fa-file-excel"></i>',
                tittleAttr: 'export a excel',
                className: 'btn btn-success' 
            }
        ]
    });
}