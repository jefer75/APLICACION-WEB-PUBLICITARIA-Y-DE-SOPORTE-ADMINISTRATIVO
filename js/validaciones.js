// Función para validar cédula
function validarCedula() {
    var cedulaInput = document.getElementById('cedula').value;
    var regex = /^\d{8,10}$/; // Expresión regular para validar cédula con un mínimo de 8 y un máximo de 10 dígitos

    // Verificar si la cédula cumple con la expresión regular
    if (!regex.test(cedulaInput)) {
        alert("Por favor ingresa una cédula válida.");
        return false;
    }
    return true;
}

// Función para validar contraseña
function validarContrasena() {
    var contrasenaInput = document.getElementById('contrasena').value;

    // Verificar si la contraseña tiene entre 8 y 11 caracteres
    if (contrasenaInput.length < 8 || contrasenaInput.length > 11) {
        alert("La contraseña debe tener entre 8 y 11 caracteres.");
        return false;
    }
    return true;
}

// Función para validar el formulario antes de enviarlo
function validarFormulario() {
    return validarCedula() && validarContrasena();
}

// Agregar eventos de escucha para validar cédula y contraseña al perder el foco de los campos correspondientes
document.getElementById('cedula').addEventListener('blur', validarCedula);
document.getElementById('contrasena').addEventListener('blur', validarContrasena);




