$(document).ready(function () {


    //registrar Comentario
    $("#detalles_ticket").on('click','.btn_añadir_comentario', function (e) {
        e.preventDefault();
        //console.log($("#text_area_comentario").val());

        var fechaActual = new Date();
        var año = fechaActual.getFullYear();
        var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript van de 0 a 11
        var dia = fechaActual.getDate();
        var hora = fechaActual.getHours();
        var minutos = fechaActual.getMinutes();
        var segundos = fechaActual.getSeconds();
        var id_usuario = $("#usuario_sesion").attr("id_lg_usuario");
        var fechaHoraFormateada = año + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia) + " " +
                                (hora < 10 ? "0" + hora : hora) + ":" + (minutos < 10 ? "0" + minutos : minutos) + ":" +
                                (segundos < 10 ? "0" + segundos : segundos);

        if ($("#text_area_comentario").val() == "") {            
            Swal.fire("Campo vacio..!!!");
            return "Campo vacio...";
        }

        const data = {
            event_registrar_comentario  : 'event_registrar_comentario',            
            content :{
                ticket_id                   : $("#id_ticket_oculto").val(),
                user_id                     : id_usuario,
                comment                     : $("#text_area_comentario").val(),
                created_atmestamp           : fechaHoraFormateada,
                },
        }

        console.log(data);
        $.post("Assets/ajax/Ajax.Incidencias.Comment.php", data,
            function (response) {
                console.log(response);
                if (response.trim() !== '"ok"') {
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
                    $("#text_area_comentario").val("");

                }
            }
        );

    });


})