

$(document).ready(function () { 
    listarB ();

    $('#btn_registrarBeneficiario').click(function (e) {
        e.preventDefault();
        var nombre_beneficiario = $('#nombre_beneficiario').val();
        
        const data = {
            registro_beneficiario : 'registro_beneficiario',
            nombre_beneficiario : nombre_beneficiario,
        }

        $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
            console.log(response);

            if (response.trim() !== "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Beneficiario registrado exitosamente",
                    icon: "success",
                });
                listarB();
            }  

        })
    })

})

//listar beneficiario
function listarB (){
    const data={
        listar_beneficiario: 'listar_beneficiario',
    };

    $.ajax({
        url: "Assets/ajax/Ajax.beneficiario.php",
        data: data,
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    })
    
    $("#tb_lista_beneficiario").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.beneficiario.php",
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
            { data: "idbeneficiario", className: "text-center", },
            { data: "nombre" },
            {data: "acciones",className: "text-center",}, // Centrar el contenido de la columna
            
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