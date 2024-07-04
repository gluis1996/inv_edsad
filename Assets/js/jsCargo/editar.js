$(document).ready(function () {
    //cargar cargo en modal
    $("#tb_lista_cargo").on("click", "#id_cargo_buscar", function (e) {
        e.preventDefault();
        console.log($(this).attr("id_cargo"));
        $("#txt_editar_cargo").val($(this).attr("nombre_cargo"));
        $("#txt_editar_id").val($(this).attr("id_cargo"));
    });

    //editar cargo
    $("#btn_editar_cargo").click(function (e) {
        e.preventDefault();
        const data = {
        editar_cargo: "editar_cargo",
        datos: {
            txt_editar_cargo: $("#txt_editar_cargo").val(),
            txt_editar_id: $("#txt_editar_id").val(),
        },
        };
        console.log(data);

        $.post("Assets/ajax/Ajax.cargo.php", data, function (response) {
            if (response != "ok") {
                Swal.fire({
                title: "Oppsss...!",
                text: response,
                icon: "error",
                });
            } else {
                Swal.fire({
                title: "Exito...!",
                text: "Cambio Realizado!",
                icon: "success",
                });
                listarcargo20();
                $("#txt_editar_cargo").val("");
                $("#txt_editar_id").val("");
            }
        });
    });
});
