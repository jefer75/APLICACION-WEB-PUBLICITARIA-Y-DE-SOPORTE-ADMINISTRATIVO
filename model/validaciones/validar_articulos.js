function validarFormulario() {
    var tipoArticuloInput = document.getElementById('inputTipoArticulo');
    var errorTipoArticulo = document.getElementById('error_tipo_articulo');

    // Validar selección de tipo de artículo
    if (tipoArticuloInput.value === '') {
        tipoArticuloInput.classList.add('is-invalid');
        errorTipoArticulo.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        tipoArticuloInput.classList.remove('is-invalid');
        errorTipoArticulo.style.display = 'none';
    }

    var nombreArticuloInput = document.getElementById('nombreArticulo');
    var errorNombreArticulo = document.getElementById('error_nombreArticulo');
    var nombreArticulo = nombreArticuloInput.value.trim();
    var regexNombreArticulo = /^[a-zA-Z\s]{4,30}$/;

    // Validar nombre del artículo
    if (!regexNombreArticulo.test(nombreArticulo)) {
        nombreArticuloInput.classList.add('is-invalid');
        errorNombreArticulo.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        nombreArticuloInput.classList.remove('is-invalid');
        errorNombreArticulo.style.display = 'none';
    }

    var descripcionInput = document.getElementById('descripcion');
    var errorDescripcion = document.getElementById('error_descripcion');
    var descripcion = descripcionInput.value.trim();

    // Validar descripción
    if (descripcion.length < 10 || descripcion.length > 80) {
        descripcionInput.classList.add('is-invalid');
        errorDescripcion.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        descripcionInput.classList.remove('is-invalid');
        errorDescripcion.style.display = 'none';
    }

    var cantidadInput = document.getElementById('cantidad');
    var errorCantidad = document.getElementById('error_cantidad');
    var cantidad = cantidadInput.value.trim();

    // Validar cantidad
    if (isNaN(cantidad) || cantidad < 1 || cantidad > 200) {
        cantidadInput.classList.add('is-invalid');
        errorCantidad.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        cantidadInput.classList.remove('is-invalid');
        errorCantidad.style.display = 'none';
    }

    var valorInput = document.getElementById('valor');
    var errorValor = document.getElementById('error_valor');
    var valor = valorInput.value.trim();

    // Validar valor
    if (isNaN(valor) || valor.length > 8) {
        valorInput.classList.add('is-invalid');
        errorValor.style.display = 'block';
        return false; // Evitar envío del formulario
    } else {
        valorInput.classList.remove('is-invalid');
        errorValor.style.display = 'none';
    }
}