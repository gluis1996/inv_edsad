$(document).ready(function() {
    listar_adquisicion();
    adq_llenar_select_area();
    adq_llenar_select_beneficiario();
    adq_llenar_select_equipo();
    adq_llenar_select_meta();

    $('.btn_adq_limpiar').click(function (e) {
        e.preventDefault();
        limpiar_adq();

    })

    $('.btn_adq_guardar').click(function (e) {
        e.preventDefault();
        var idarea = $('#ad_selec_area').val();
        var idbeneficiario = $('#ad_selec_beneficiario').val();
        var idequipo = $('#ad_selec_equipo').val();
        var idmeta = $('#ad_selec_meta').val();
        var fecha = $('#ad_fecha').val();
        var cantidad = $('#ad_cantidad').val();

        if (fecha) {
            var date = new Date(fecha);
            var year = date.getFullYear();
            var month = date.getMonth() + 1; // Los meses van de 0 a 11, sumamos 1
            var day = date.getDate();
        } else {
            alert('Por favor, selecciona una fecha.');
        }


        
    
        const data = {
            adq_registrar: 'adq_registrar',
            idarea: idarea,
            idbeneficiario: idbeneficiario,
            idequipo: idequipo,
            idmeta: idmeta,
            fecha: fecha,
            year: year,
            month: month,
            day: day,
            cantidad: cantidad,
        };
        console.log(data);

    })

});


function adq_llenar_select_area() {
    const data = {
        ad_area : "ad_area",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_area").append(
                    '<option value="' + fila.id_area_usuaria + '">' + fila.nombres + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_beneficiario() {
    const data = {
        ad_beneficiario : "ad_beneficiario",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_beneficiario").append(
                    '<option value="' + fila.idbeneficiario + '">' + fila.nombre + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_equipo() {
    const data = {
        ad_equipo : "ad_equipo",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_equipo").append(
                    '<option value="' + fila.idequipos + '">' + fila.descripcion + " - " + fila.modelo + " - " + fila.nombre + "</option>"
                );
            });
        },
    });
}

function adq_llenar_select_meta() {
    const data = {
        ad_meta : "ad_meta",
    };
    $.ajax({
        type: "POST",
        data: data,
        url: "Assets/ajax/Ajax.adquisicion.php",
        success: function (respose) {
            //console.log(respose);
            var js = JSON.parse(respose);
            $.each(js, function (index, fila) {
                $("#ad_selec_meta").append(
                    '<option value="' + fila.idmeta + '">' + fila.nombre + "</option>"
                );
            });
        },
    });
}

function limpiar_adq() {
    $('#ad_selec_area').val(0);
    $('#ad_selec_beneficiario').val(0);
    $('#ad_selec_equipo').val(0);
    $('#ad_selec_meta').val(0);
    $('#ad_fecha').val('');
    $('#ad_cantidad').val('');
}


//listara todo
function listar_adquisicion() {
    const data = {
        ad_listar: "ad_listar",
    };

    $.ajax({
        url: "Assets/ajax/Ajax.adquisicion.php",
        data: data,
        type: 'POST',
        success: function (response) {
            //console.log(response);
        }
    })


    $("#tbl_detalle_adquisicion").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.adquisicion.php",
            type: "POST",
            data: data,
        },
        paging: true, // Quitar paginación
        searching: true, // Quitar barra de búsqueda
        info: true, // Quitar información de registros
        ordering: true, // Quitar la capacidad de ordenar
        pageLength: 10, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "id", className: "text-center", },
            { data: "area_nombre" },
            { data: "beneficiario_nombre" },
            { data: "equipo" },
            { data: "meta_nombre" },
            { data: "año" },
            { data: "cantidad", className: "text-center", },
            { data: "accion", className: "text-center", },
        ],
        dom: "lfrtip", // Eliminar algunos elementos de la interfaz
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando página _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
    });
}



