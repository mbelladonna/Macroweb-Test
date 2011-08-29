/*
** Validador "empieza con"
*/

jQuery.validator.addMethod("startsWith", function(value, element, param) {
    return this.optional(element) || ($.trim(value).indexOf(param) == 0);
}, "Debe empezar con {0}.");

/*
** Reglas de validacion
*/

// Telefonos
var reglas_telefono = {
    required: true,
    digits: true,
    maxlength: 9,
    startsWith: 6
};

// Mensajes
var reglas_mensaje = {
    required: true,
    maxlength: 300
};

// Terminos y condiciones
var reglas_terminos = {
    required: true,
    messages: {
        required: "Debe aceptar los Terminos y Condiciones."
    }
};

// PIN
var reglas_pin = {
    required: true,
    digits: true,
    maxlength: 4
};

// Password
var reglas_password = {
    required: true,
    digits: true,
    maxlength: 6
};
