function validarFormulario() {
    var nombrePaqueteInput = document.getElementById('nombre_paquete');
    var errorNombrePaquete = document.getElementById('error_nombre_paquete');
    var nombrePaquete = nombrePaqueteInput.value.trim();
    var regexNombre = /^[a-zA-Z]+(?: [a-zA-Z]+){0,2}$/;
    if (!regexNombre.test(nombrePaquete) || nombrePaquete.length > 20) {
        nombrePaqueteInput.classList.add('is-invalid');
        errorNombrePaquete.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        nombrePaqueteInput.classList.remove('is-invalid');
        errorNombrePaquete.style.display = 'none';
    }

    var edadMinInput = document.getElementById('edad_min');
    var errorEdadMin = document.getElementById('error_edad_min');
    var edadMin = edadMinInput.value.trim();
    var regexEdadMin = /^(?!0\d)\d{1,2}$/;
    if (!regexEdadMin.test(edadMin) || parseInt(edadMin) < 1 || parseInt(edadMin) > 20) {
        edadMinInput.classList.add('is-invalid');
        errorEdadMin.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        edadMinInput.classList.remove('is-invalid');
        errorEdadMin.style.display = 'none';
    }

    var edadMaxInput = document.getElementById('edad_max');
    var errorEdadMax = document.getElementById('error_edad_max');
    var edadMax = edadMaxInput.value.trim();
    var regexEdadMax = /^(?!0\d)\d{1,2}$/;
    if (!regexEdadMax.test(edadMax) || parseInt(edadMax) < 5 || parseInt(edadMax) > 20) {
        edadMaxInput.classList.add('is-invalid');
        errorEdadMax.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        edadMaxInput.classList.remove('is-invalid');
        errorEdadMax.style.display = 'none';
    }

    var valorInput = document.getElementById('valor');
    var errorValor = document.getElementById('error_valor');
    var valor = valorInput.value.trim();
    var regexValor = /^\d{1,11}$/;
    if (!regexValor.test(valor) || parseInt(valor) < 50000 ) {
        valorInput.classList.add('is-invalid');
        errorValor.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        valorInput.classList.remove('is-invalid');
        errorValor.style.display = 'none';
    }

    // Si todas las validaciones pasan, se envía el formulario
    return true;
}