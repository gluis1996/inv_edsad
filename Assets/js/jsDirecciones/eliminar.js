$(document).ready(function () {
    //cargar cargo en modal
    $("#tb_lista_direccion").on("click", "#btn_eliminar_direccion", function (e) {
        e.preventDefault();
        //console.log($(this).attr("iddireccion_oficina_el"));

        const data = {
            eliminar_direccion          :   'eliminar_direccion',
            id_direccion                :   $(this).attr("iddireccion_oficina_el"),
        }

        //console.log(data);

        //una solicitud POS es lo que se envia al servidor
        Swal.fire({
            title: "Estas seguro",
            text: "¡No podrás revertir esto!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar esto!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("Assets/ajax/Ajax.direccion.php", data, function (response) {
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
                        var row = $(e.target).closest("tr");
                        row.addClass("fade-out");
                        setTimeout(function () {
                            var table = $("#tb_lista_direccion").DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                });
            }
        });

    })
})