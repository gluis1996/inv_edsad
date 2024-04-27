$(document).ready(function () {
    listarperfiles();
    listarRadgroupreply();

    $('.btnregistrarperfil').click(function (e) {
        e.preventDefault();

        let vlan = $("#vlan").val();
        let megas = $("#megas").val();
        let grupo = $("#grupo").val();
        let filial = $("#perfiles_select").val();
        const data = {
            perfiles : 'perfiles',
            vlan : vlan,
            megas : megas,
            grupo : grupo,
            filial :filial,
        }

        console.log(data);

        Swal.fire({
            title: "Desea Registrar el Perfil",
            text: "Se va a registrara "+ grupo ,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Hacer la petición al servidor y manejar la respuesta
                $.post('Assets/interacciones.php', data, function (response) {
                                       
                    console.log(response);
                    if (response === "ok") {
                        // Mostrar la alerta de éxito
                        Swal.fire({
                            title: "Exito!",
                            text: "Se registro satisfactoriamente",
                            icon: "success"
                        });
                        listarperfiles();
                    } else{
                        alert(response);
                    }
                    
                });
            } else {
                // El usuario canceló la operación
            }
        });
    })     
})

function listarperfiles(){

    const data = {
        listadoperfileslocal: 'listadoperfileslocal',
    }
    //console.log(data);
    $.ajax({
        url: "Assets/tablas.php",
        data: data,
        type: 'POST',
        success:function(response){
            //console.log(response);
        }
    })
    $('#tablaperfillocal').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        //"paging": false,       // Quitar paginación
        //"searching": false,    // Quitar barra de búsqueda
        "info": false,         // Quitar información de registros
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 20,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "columns": [
            { "data": "Vlan"},
            { "data": "Megas"},
            { "data": "Perfil"}
        ]
    });
};

function listarRadgroupreply(){

    const data = {
        listarRadgroupreply: 'listarRadgroupreply',
    }
    // console.log(data);
    // $.ajax({
    //     url: "Assets/tablas.php",
    //     data: data,
    //     type: 'POST',
    //     success:function(response){
    //         //console.log(response);
    //     }
    // })
    $('#tablaRadgroupreply').DataTable({
        "destroy":true,
        "ajax" : {
            "url": "Assets/tablas.php",
            "type": "POST",
            "data": data
        },
        "style": "plain",      // Quitar estilos por defecto
        //"paging": false,       // Quitar paginación
        //"searching": false,    // Quitar barra de búsqueda
        "info": false,         // Quitar información de registros
        "ordering": false,     // Quitar la capacidad de ordenar
        "pageLength": 20,       // Establecer el número de registros por página a 3
        "lengthChange": false,
        "columns": [
            { "data": "id"},
            { "data": "groupname"},
            { "data": "value"}
        ]
    });
};