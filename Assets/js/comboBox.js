$(document).ready(function () { //inicio
    llenadoCBXFilial();    
    //listarselect2();


    

    $('#codAbonado').on('input', function () {
        actualizarCodAcceso();
    })


    $('.area_filial').on('change', '#FL', function () {
        selectedSite = $('#FL option:selected').attr("site");
        id = $('#FL option:selected').attr("value");
        console.log(selectedSite+"    "+id);
        if (id == 1 && id != 2) {
            $("#codAcceso").prop("readonly", true);
        }else{
            $("#codAcceso").prop("readonly", false);
            $("#btnenviar").prop("disabled", false);
        }
        actualizarCodAcceso();
    });


    function actualizarCodAcceso() {
        let codAbonado = $('#codAbonado').val();
        selectedSite = $('#FL option:selected').attr("site");

        let codAccesoValue = '';
        
        codAccesoValue = codAbonado + '@'+selectedSite;       
        

        $('#codAcceso').val(codAccesoValue);
    }


    // function listarselect2() {
    //     const data = {
    //         FILIAL: 'FILIAL',
    //     }; 

    //     $.ajax({
    //         type : 'POST',
    //         data : data,
    //         url : 'Assets/interacciones.php',
    //         success:function (response) {
    //             var js = JSON.parse(response);
    //             $.each(js, function(indice,fila) {
    //                 $('#FL').append('<option site="'+fila.site+'" value="'+fila.id+'">'+fila.nombre+'</option>');
    //             })
    //             $('#FL').select2();
    //         }
    //     })
    // }

    function llenadoCBXFilial() {
        const data = {
            FILIAL: 'FILIAL',
        };
    
        $.post('Assets/interacciones.php', data, function (response) {
            var js = JSON.parse(response);
    
            // Crear el select dinámico
            var selectHtml = '<select class="form-control slfilial" id="FL">' +
                                '  <option value="">Seleccione</option>' +
                                '</select>';
    
    
            $('.area_filial').html(selectHtml);
    
            // Agregar opciones al select
            js.forEach(funoperador);
    
            function funoperador(item, index) {
                $("#FL").append(
                    '<option site="'+item.site+'" value="'+item.id+'">'+item.nombre+'</option>'
                );
            }
    
           
        });
    }


})//fin




