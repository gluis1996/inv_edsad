$(document).ready(function () {
    //cargar cargo en modal
    $("#tb_lista_cargo").on("click", "#btn_eliminar_cargo", function (e) {
        e.preventDefault();
        console.log($(this).attr("id_cargo_el"));

        const data = {
            eliminar_cargo      :   'eliminar_cargo',
            id_cargo            :   $(this).attr("id_cargo_el"),
        }

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
                $.post("Assets/ajax/Ajax.cargo.php", data, function (response) {
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
                            var table = $("#tb_lista_cargo").DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                });
            }
        });

    })
})