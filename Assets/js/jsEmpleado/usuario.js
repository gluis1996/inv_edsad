$(document).ready(function () {
    listarU();

    $('#btn_registrar_usuario').click(function (e) {
        e.preventDefault();
        var nombre_usuario = $('#nombre_usuario').val();
        var user = $('#user').val();
        var contraseña = $('#contraseña').val();

        const data = {
            registro_usuario: 'registro_usuario',
            nombre_usuario: nombre_usuario,
            user: user,
            contra: contraseña,

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
                listarU();
            }
            // console.log(data);
        })
    })

    //llenar datos en el modal editar usuario
    $('#tb_lista_usuario').on("click", ".btn_edit_usuario", function (e) {
        e.preventDefault();
        var idusuario = $(this).attr('edit_id');
        var nombre = $(this).attr('edit_nombre');
        var user = $(this).attr('edit_user');
        var pass = $(this).attr('edit_pass');
       // console.log(idusuario);  // ver el el id que captura
        $('#modal_edit_id_usuario').val(idusuario);
        $('#modal_edit_nombre_usuario').val(nombre);
        $('#modal_edit_user_usuario').val(user);
        $('#modal_edit_user_contraseña').val(pass);



    })








    //editar
    $('#btn_modal_editar_usuario').click(function (e) {
        e.preventDefault();
        //INPUT
        var e_idusuario = $('#modal_edit_id_usuario').val();
        var e_nombreusu = $('#modal_edit_nombre_usuario').val();
        var e_userusu = $('#modal_edit_user_usuario').val();
        var e_contraseñausu = $('#modal_edit_user_contraseña').val();

        const data = {
            editar_usuario: 'editar_usuario',
            e_idusuario: e_idusuario,
            e_nombreusu: e_nombreusu,
            e_userusu: e_userusu,
            e_contraseñausu: e_contraseñausu,
        };

        console.log(data);

        $.post("Assets/ajax/Ajax.usuario.php", data, function (response) {
            console.log(response);
            if (response != "ok") {
                Swal.fire({
                    title: "Oppps....",
                    text: response,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Success",
                    text: "Editado exitosamente el equipo",
                    icon: "success",
                });
                $("#modal_editar_usuario").modal('hide');
            }
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
            { data: "acciones", className: "text-center", }, // Centrar el contenido de la columna

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
//llenar datos en el modal editar registro  /// captura los id de lo botones
$('#tb_lista_usuario').on("click", ".btn_eliminar_usuario", function (e) {
    e.preventDefault();
    var id = $(this).attr('id_usuario_ls');
    //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
    const data = {
        eliminar_usuario: 'eliminarUsuario',
        idusuario: id,
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
            $.post('Assets/ajax/Ajax.usuario.php', data, function (response) {
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
                        var table = $('#tb_lista_usuario').DataTable();
                        table.row(row).remove().draw();
                    }, 500); // Esperar a que la animación termine
                }

            })
        }
    })
})