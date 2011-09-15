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

// Password
var reglas_password = {
    required: true,
    maxlength: 10
};
