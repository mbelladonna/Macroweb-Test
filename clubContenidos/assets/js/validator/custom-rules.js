/*
** Validador "empieza con"
*/

jQuery.validator.addMethod("startsWith", function(value, element, param) {
    return this.optional(element) || ($.trim(value).indexOf(param) == 0);
}, "Debe empezar con {0}.");

/*
** Reglas de validacion
*/

// Movil
var reglas_movil = {
    required: true,
    digits: true,
    maxlength: 9,
    startsWith: 6
};

// Password
var reglas_password = {
    required: true,
    digits: true,
    maxlength: 6
};

// Terminos y condiciones
var reglas_terminos = {
    required: true,
    messages: {
        required: "Debe aceptar los Terminos y Condiciones."
    }
};
