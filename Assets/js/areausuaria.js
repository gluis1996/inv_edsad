

$(document).ready(function () { 

    listarAU();

    $('#btn_registrarAreaUsuaria').click(function (e) {
        e.preventDefault();
        var nombre_ausu = $('#nombre_a_usuaria').val();
        
        const data = {
            registro_ausuria : 'registroareausu',
            nombrexareausu : nombre_ausu,
        }

        $.post('Assets/ajax/Ajax.area.usuaria.php', data, function (response) {
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
                    text: "Area usuaria registrado exitosamente",
                    icon: "success",
                });
                listarAU();
                $('#nombre_a_usuaria').val('');
            }  

        })
    })

})

//listara todo
function listarAU() {
    const data = {
        lista_area_usuaria: "lista_areausu",
    };
    //verificar
//    console.log(data);
//     $.ajax({
//         url: "Assets/ajax/Ajax.area.usuaria.php",
//         data: data,
//         type: 'POST',
//         success: function (response) {
//             console.log(response);
//         }
//     })

    $("#tb_lista_area").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.area.usuaria.php",
            type: "POST",
            data: data,
        },
        paging: true, // Quitar paginación
        searching: true, // Quitar barra de búsqueda
        info: true, // Quitar información de registros
        ordering: true, // Quitar la capacidad de ordenar
        pageLength: 3, // Establecer el número de registros por página a 3
        lengthChange: false,
        responsive: true, // Hacer la tabla responsiva
        columns: [
            { data: "idareausu", className: "text-center", },
            { data: "nombreareausu" },
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

//ELIMINAR
    /// captura los id de lo botones
    $('#tb_lista_area').on("click", ".btn_eliminar_area_usua", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_area_u');
        console.log(id); // ---> se utiliza para verificar si le esta asignando el id del empleado
        const data = {
            eliminar_Ausuaria : 'eliminar_areausu',
            idareausua : id,
        }
        //una solicitud POS es lo que se envia al servidor 
        Swal.fire({
            title: "Estas seguro",
            text: "¡No podrás revertir esto!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar esto!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('Assets/ajax/Ajax.area.usuaria.php', data, function (response) {
                    if (response != "ok") {
                        Swal.fire({
                            title: "Oppps....",
                            text: response,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted",
                            text: "Eliminado exitosamente",
                            icon: "success",
                        });
                        // Eliminar la fila con transición
                        var row = $(e.target).closest('tr');
                        row.addClass('fade-out');
                        setTimeout(function () {
                            var table = $('#tb_lista_area').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }            
        
                })
            }
        })
     })



