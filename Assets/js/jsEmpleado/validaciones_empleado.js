// Función para validar campos y activar botón de registro
// Llamar a validarCampos al cargar la página para establecer el estado inicial del botón
$(document).ready(function () {
    validarCampos();
});


function validarCampos() {
    var dni = $("#em_dni").val();
    var nombre = $("#em_nombre_empleado").val();
    var apellido = $("#em_apellido_empleado").val();
    var numero = $("#em_numero").val();
    var fecha = $("#em_fecha").val();
    var correoPersonal = $("#em_correo_personal").val();
    var correoInstitucional = $("#em_correo-institucional").val();
    var cargo = $("#em-select-cargo").val();
    var tipoContrato = $("#em-tipo_contrato").val();
    var direccion = $("#em-select-direccion").val();

    var dniValido = /^\d{8}$/.test(dni);
    var nombreValido = /^[a-zA-Z]{3,}$/.test(nombre) && nombre.trim() !== "";
    var apellidoValido = /^[a-zA-Z]{3,}$/.test(apellido) && apellido.trim() !== "";
    var numeroValido = /^\d{9}$/.test(numero);
    var fechaValida = fecha !== "";
    var correoPersonalValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoPersonal);
    var correoInstitucionalValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoInstitucional);
    var cargoSeleccionado = cargo !== null;
    var tipoContratoSeleccionado = tipoContrato !== null;
    var direccionSeleccionada = direccion !== null;

    if (
        dniValido && nombreValido && apellidoValido && numeroValido && fechaValida &&
        correoPersonalValido && correoInstitucionalValido && cargoSeleccionado &&
        tipoContratoSeleccionado && direccionSeleccionada
    ) {
        $("#btn_registrarEmpleado").prop("disabled", false);
    } else {
        $("#btn_registrarEmpleado").prop("disabled", true);
    }
}

// Evento input para validar cada campo en tiempo real
$("#em_dni, #em_nombre_empleado, #em_apellido_empleado, #em_numero, #em_fecha, #em_correo_personal, #em_correo-institucional").on("input", function () {
    var id = $(this).attr("id");
    var value = $(this).val();

    switch (id) {
        case "em_dni":
            validarCampoRegex(value, /^\d{8}$/, id, "DNI");
            break;
        case "em_nombre_empleado":
            validarCampoRegex(value, /^[a-zA-Z]{3,}$/, id, "Nombre del Empleado");
            break;
        case "em_apellido_empleado":
            validarCampoRegex(value, /^[a-zA-Z]{3,}$/, id, "Apellido del Empleado");
            break;
        case "em_numero":
            validarCampoRegex(value, /^\d{9}$/, id, "Número");
            break;
        case "em_fecha":
            validarCampoFecha(value, id, "Fecha");
            break;
        case "em_correo_personal":
            validarCampoRegex(value, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, id, "Correo Personal");
            break;
        case "em_correo-institucional":
            validarCampoRegex(value, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, id, "Correo Institucional");
            break;
        default:
            break;
    }

    // Llamar a la función para validar campos y activar/desactivar el botón de registro
    validarCampos();
});

// Evento change para validar campos select en tiempo real
$("#em-select-cargo, #em-tipo_contrato, #em-select-direccion").on("change", function () {
    var id = $(this).attr("id");
    var value = $(this).val();

    switch (id) {
        case "em-select-cargo":
            validarCampoSelect(value, id, "Cargo");
            break;
        case "em-tipo_contrato":
            validarCampoSelect(value, id, "Tipo Contrato");
            break;
        case "em-select-direccion":
            validarCampoSelect(value, id, "Dirección");
            break;
        default:
            break;
    }

    // Llamar a la función para validar campos y activar/desactivar el botón de registro
    validarCampos();
});

// Función para validar campo con expresión regular
function validarCampoRegex(value, regex, id, campo) {
    var isValid = regex.test(value.trim());

    if (isValid) {
        $("#" + id).removeClass("is-invalid").addClass("is-valid");
        $("#" + id).siblings(".invalid-feedback").text("");
    } else {
        $("#" + id).removeClass("is-valid").addClass("is-invalid");
        $("#" + id).siblings(".invalid-feedback").text(campo + " INCORRECTO!!");
        $("#" + id).siblings(".valid-feedback").text("");
    }
}

// Función para validar campo de fecha
function validarCampoFecha(value, id, campo) {
    if (value !== "") {
        $("#" + id).removeClass("is-invalid").addClass("is-valid");
        $("#" + id).siblings(".invalid-feedback").text("");
    } else {
        $("#" + id).removeClass("is-valid").addClass("is-invalid");
        $("#" + id).siblings(".invalid-feedback").text(campo + " INCORRECTO!!");
        $("#" + id).siblings(".valid-feedback").text("");
    }
}

// Función para validar campo select
function validarCampoSelect(value, id, campo) {
    if (value !== "") {
        $("#" + id).removeClass("is-invalid").addClass("is-valid");
        $("#" + id).siblings(".invalid-feedback").text("");
    } else {
        $("#" + id).removeClass("is-valid").addClass("is-invalid");
        $("#" + id).siblings(".invalid-feedback").text(campo + " INCORRECTO!!");
        $("#" + id).siblings(".valid-feedback").text("");
    }
}

