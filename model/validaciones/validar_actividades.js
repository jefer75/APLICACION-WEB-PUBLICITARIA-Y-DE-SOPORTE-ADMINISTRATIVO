
function validarFormulario() {
    var nombreInput = document.getElementById('nombre');
    var errorNombre = document.getElementById('error_nombre');
    var nombre = nombreInput.value.trim();
    var regexNombre = /^[a-zA-Z]+(?: [a-zA-Z]+){0,2}$/;
    if (!regexNombre.test(nombre) || nombre.length > 20 || nombre.length < 4) {
        nombreInput.classList.add('is-invalid');
        errorNombre.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        nombreInput.classList.remove('is-invalid');
        errorNombre.style.display = 'none';
    }

    var descripcionInput = document.getElementById('descripcionInput');
    var errorDescripcion = document.getElementById('error_descripcion');
    var descripcion = descripcionInput.value.trim();
    // La descripción debe tener entre 10 y 100 caracteres.
    if (descripcion.length < 10 || descripcion.length > 100) {
        descripcionInput.classList.add('is-invalid');
        errorDescripcion.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        descripcionInput.classList.remove('is-invalid');
        errorDescripcion.style.display = 'none';
    }


    // Si todas las validaciones pasan, se envía el formulario
    return true;
}