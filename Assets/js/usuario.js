$(document).ready(function () { 
    listarU() ;

    $('#btn_registrar_usuario').click(function (e) {
        e.preventDefault();
        var nombre_usuario = $('#nombre_usuario').val();
        var user = $('#user').val();
        var contraseña = $('#contraseña').val();
        
        const data = {
            registro_usuario : 'registro_usuario',
            nombre_usuario : nombre_usuario,
            user : user,
            contra : contraseña,

        }
        $.post('Assets/ajax/Ajax.usuario.php', data, function (response) {
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
                    text: "Usuario registrado exitosamente",
                    icon: "success",
                });
                listarU() ;
            } 
            // console.log(data);
        })
    })
})


//listara todo
function listarU() {
    const data = {
        lista_usuario: "listausuario",
    };

    $("#tb_lista_usuario").DataTable({
        destroy: true,
        ajax: {
            url: "Assets/ajax/Ajax.usuario.php",
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
            { data: "idusuario", className: "text-center", },
            { data: "nombres" },
            { data: "user" },
            { data: "contraseña" },
            { data: "acciones", className: "text-center",}, // Centrar el contenido de la columna
            
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