function validarFormulario() {
    var descripcionInput = document.getElementById('descripcionInput');
    var errorDescripcion = document.getElementById('error_descripcion');
    var descripcion = descripcionInput.value.trim();

    // Validar la longitud de la descripción
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