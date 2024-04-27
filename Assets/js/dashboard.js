$(document).ready(function () {

    listardatos_todo_fo();
    listardatos_todo_eoc()
    listar_atenciones();
})

function listardatos_todo_fo() {

    const data = {
        dash_listar_instalacion_fo: 'dash_listar_instalacion_fo',
    };

    $('#tb_dash_instalacion_fo').DataTable({
        destroy: true,
        ajax: {
            url: "Assets/tablas.dash.php",
            type: "POST",
            data: data
        },
        
        "style": "plain",      // Quitar estilos por defecto
        //"searching": false,    // Quitar barra de búsqueda
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 7,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        columns: [
            { data: "id" },
            { data: "fecha" },
            { data: "operador" },
            { data: "filial" },
            { data: "os" },
            { data: "abonado" },
            { data: "codigo_abonado" },
            { data: "caja" },
            { data: "borne" },
            { data: "precinto" },
            { data: "mac" },
            { data: "acciones" }
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


function listardatos_todo_eoc() {

    const data = {
        dash_listar_instalacion_eoc: 'dash_listar_instalacion_eoc',
    };

    $('#tb_dash_instalacion_eoc').DataTable({
        destroy: true,
        ajax: {
            url: "Assets/tablas.dash.php",
            type: "POST",
            data: data
        },
        
        "style": "plain",      // Quitar estilos por defecto
        //"searching": false,    // Quitar barra de búsqueda
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 7,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        columns: [
            { data: "id" },
            { data: "fecha" },
            { data: "operador" },
            { data: "filial" },
            { data: "os" },
            { data: "abonado" },
            { data: "codigo_abonado" },
            { data: "mac" },
            { data: "coordenadas" },
            { data: "acciones" }
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

function listar_atenciones() {

    const data = {
        dash_atenciones: 'dash_atenciones',
    };

    $('#tb_dash_atenciones').DataTable({
        destroy: true,
        ajax: {
            url: "Assets/tablas.dash.php",
            type: "POST",
            data: data
        },
        
        "style": "plain",      // Quitar estilos por defecto
        //"searching": false,    // Quitar barra de búsqueda
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 7,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        columns: [
            { data: "id" },
            { data: "os" },
            { data: "operador" },
            { data: "abonado" },
            { data: "orden" },
            { data: "fecha" },
            { data: "area" },
            { data: "acciones" }
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