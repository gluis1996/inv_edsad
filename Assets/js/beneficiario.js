

$(document).ready(function () { 

    $('#btn_registrarBeneficiario').click(function (e) {
        e.preventDefault();
        var nombre_beneficiario = $('#nombre_beneficiario').val();
        
        const data = {
            registro_beneficiario : 'registro_beneficiario',
            nombresede : nombre_beneficiario,
        }

        $.post('Assets/ajax/Ajax.beneficiario.php', data, function (response) {
            console.log(response);

        })
    })

})