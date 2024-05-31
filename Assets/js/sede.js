
$(document).ready(function () { 

    listarS();

    $('#btn_registrarSede').click(function (e) {
        e.preventDefault();
        var nombre_sede = $('#nombre_sede').val();
        
        const data = {
            registro_sede : 'registroSede',
            nombrexsede : nombre_sede,
        }

        $.post('Assets/ajax/Ajax.sede.php', data, function (response) {
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
                    text: "Sede registrado exitosamente",
                    icon: "success",
                });
                listarS();
            }  

        })
    })

})

//listara todo
function listarS() {
    const data = {
        lista_sede: "listasede",
    };

    $("#tb_lista_sede_oficina").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.sede.php",
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
            { data: "idsede", className: "text-center", },
            { data: "nombresed" },
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
    //llenar datos en el modal eliminar /// captura los id de lo botones
    $('#tb_lista_sede_oficina').on("click", ".btn_eliminar_sede", function (e) {
        e.preventDefault();
        var id = $(this).attr('id_sedels');
        //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
        const data = {
            eliminar_sede : 'eliminarsede',
            idsede : id,
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
                $.post('Assets/ajax/Ajax.sede.php', data, function (response) {
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
                            var table = $('#tb_lista_sede_oficina').DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }            
        
                })
            }
        })
    })
