$(document).ready(function () {
   
    llenar_datos_select_cargo();

    llenar_datos_select_tipo_contrato();
    llenar_datos_select_direccion_oficina();


    
    //ELIMINAR
    //llenar datos en el modal editar registro  /// captura los id de lo botones
    $("#tb_registrar_empleados").on("click", ".btn_eliminar_empleado", function (e) {
        e.preventDefault();
        var id = $(this).attr("id_empleado_el");
        //console.log(id);  ---> se utiliza para verificar si le esta asignando el id del empleado
        const data = {
            id_eliminar_empleado: "te_extraño",
            idempleado: id,
        };
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
                $.post("Assets/ajax/Ajax.empleado.php", data, function (response) {
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
                            var table = $("#tb_registrar_empleados").DataTable();
                            table.row(row).remove().draw();
                        }, 500); // Esperar a que la animación termine
                    }
                });
            }
        });
    }
    );
});

function llenar_datos_select_cargo() {
    const data = { llenar_campo_cargo: "llenar_campo_cargo" };

    $.post("Assets/ajax/Ajax.empleado.php", data, function (response) {
        var cargo_json = JSON.parse(response);
        //console.log(cargo_json);
        $("#em-select-cargo").append(
            '<option selected disabled value="">Seleccioe un cargo</option>'
        );
        $.each(cargo_json, function (index, fila) {
            $("#em-select-cargo").append(
                '<option value="' + fila.idcargo + '">' + fila.nombre_cargo + "</option>"
            );
        });
    });
}

function llenar_datos_select_tipo_contrato() {
    const data = { llenar_campo_tipo_contrato: "llenar_campo_tipo_contrato" };

    $.post("Assets/ajax/Ajax.empleado.php", data, function (response) {
        var cargo_json = JSON.parse(response);
        //console.log(cargo_json);
        $("#em-tipo_contrato").append(
            '<option selected disabled value="">Seleccioe un cargo</option>'
        );
        $.each(cargo_json, function (index, fila) {
            $("#em-tipo_contrato").append(
                '<option value="' + fila.idtipo_contrato + '">' + fila.nombre_tipo_contrato + "</option>"
            );
        });
    });
}

function llenar_datos_select_direccion_oficina() {
    const data = { llenar_campo_direccion_oficina: "llenar_campo_direccion_oficina" };

    $.post("Assets/ajax/Ajax.empleado.php", data, function (response) {
        var cargo_json = JSON.parse(response);
        //console.log(cargo_json);
        $("#em-select-direccion").append(
            '<option selected disabled value="">Seleccioe un cargo</option>'
        );
        $.each(cargo_json, function (index, fila) {
            $("#em-select-direccion").append(
                '<option value="' + fila.iddireccion_oficina + '">' + fila.nombre_direccion + "</option>"
            );
        });
    });
}




