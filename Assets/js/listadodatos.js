$(document).ready(function () {
    //inicio
    listardatos2();    

    //lista informacion de instalacion en modal
    $('#tb_instalaciones').on("click",".btn_detale_instalacion",function (e) {
        e.preventDefault();
        let cod = $(this).attr("idinstalacion");
        //elemento.innerHTML=cod;

        const data = {
            detalle_instalacion : "detalle_instalacion",
            codigo: cod,
        };

        $.post('Assets/interacciones.php',data,function (response) {
            //console.log(response);
            datosjs = JSON.parse(response);
            var nodo = datosjs[0].codabonado;
            var Caja = datosjs[0].caja;
            var Borne = datosjs[0].borne;
            var Precinto = datosjs[0].precinto;
            var Plan = datosjs[0].mac;
            var Filial = datosjs[0].filial;

            $("#nodo").val(nodo);
            $("#caja").val(Caja);
            $("#borne").val(Borne);
            $("#precinto").val(Precinto);
            $("#plan").val(Plan);
            $("#filial").val(Filial);

        })
        
    })

    //muestra la conexion del usuario
    $('#tb_instalaciones').on("click",".btn_estado_instalacion",function (e) {
        e.preventDefault();
        let cod = $(this).attr("idabonado");
        
        console.log(cod);
        listardatos_raddacct_instalacion(cod);
        
    })

    //edita informacion del usario

    $('.btn_instalacion_fo_editar').click(function (e) {
        e.preventDefault();
        var cod = $(this).attr("idinstalacion");
        var nodo =  $("#nodo").val();
        var caja =    $("#caja").val();
        var borne =    $("#borne").val();
        var prec =    $("#precinto").val();
        var mac =    $("#plan").val();

        const data = {
            editarinstalacionFO : 'editarinstalacionFO',
            cod:cod ,
            nodo: nodo,
            caja:caja,
            borne: borne,
            prec :prec,
            mac:mac,
        }

        console.log(data);
        $.post('Assets/interacciones.php', data, function (response){

        })
        
    })
})

function listardatos2() {
    let encargado = document.getElementById('usuario_sesion');
    let en = encargado.getAttribute('data-usu');
    console.log(en);
    const data = {
        listarinstalacionfo: 'listarinstalacionfo',
        operador: en,
    };

    $('#tb_instalaciones').DataTable({
        destroy: true,
        ajax: {
            url: "Assets/tablas.php",
            type: "POST",
            data: data
        },
        
        "style": "plain",      // Quitar estilos por defecto
        //"searching": false,    // Quitar barra de búsqueda
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 7,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        columns: [
            { data: "Abonado" },
            { data: "Filial" },
            { data: "Fecha" },
            { data: "Accion" }
        ],        
        responsive: 'true',
        dom: 'Bfrtilp',
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

