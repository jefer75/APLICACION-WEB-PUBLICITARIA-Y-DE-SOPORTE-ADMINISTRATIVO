    function validarFormulario() {
        var tipoArticulo = document.getElementById('inputTipoArticulo');
        var errorTipoArticulo = document.getElementById('error_tipo_articulo');
        
        if (tipoArticulo.value === '') {
            tipoArticulo.classList.add('is-invalid');
            errorTipoArticulo.style.display = 'block';
            return false;
        } else {
            tipoArticulo.classList.remove('is-invalid');
            errorTipoArticulo.style.display = 'none';
        }

        var nombreArticulo = document.getElementById('nombreArticulo');
        var errorNombreArticulo = document.getElementById('error_nombreArticulo');
        var nombre = nombreArticulo.value.trim();

        if (nombre.length < 4 || nombre.length > 30 || !/^[a-zA-Z]+$/.test(nombre)) {
            nombreArticulo.classList.add('is-invalid');
            errorNombreArticulo.style.display = 'block';
            return false;
        } else {
            nombreArticulo.classList.remove('is-invalid');
            errorNombreArticulo.style.display = 'none';
        }

        var descripcion = document.getElementById('descripcion');
        var errorDescripcion = document.getElementById('error_descripcion');
        var descripcionValue = descripcion.value.trim();

        if (descripcionValue.length < 10 || descripcionValue.length > 80) {
            descripcion.classList.add('is-invalid');
            errorDescripcion.style.display = 'block';
            return false;
        } else {
            descripcion.classList.remove('is-invalid');
            errorDescripcion.style.display = 'none';
        }

        var cantidad = document.getElementById('cantidad');
        var errorCantidad = document.getElementById('error_cantidad');
        var cantidadValue = cantidad.value.trim();

        if (cantidadValue === '' || isNaN(cantidadValue) || cantidadValue < 1 || cantidadValue > 200) {
            cantidad.classList.add('is-invalid');
            errorCantidad.style.display = 'block';
            return false;
        } else {
            cantidad.classList.remove('is-invalid');
            errorCantidad.style.display = 'none';
        }

        var valor = document.getElementById('valor');
        var errorValor = document.getElementById('error_valor');
        var valorValue = valor.value.trim();

        if (valorValue === '' || isNaN(valorValue) || valorValue.length > 8) {
            valor.classList.add('is-invalid');
            errorValor.style.display = 'block';
            return false;
        } else {
            valor.classList.remove('is-invalid');
            errorValor.style.display = 'none';
        }

        return true; // Submit del formulario si todas las validaciones son correctas
    }