document.addEventListener("DOMContentLoaded", function() {
    const showContainerButton = document.getElementById('showContainerButton');
    const containerWrapper = document.getElementById('containerWrapper');

    showContainerButton.addEventListener('click', function() {
        // Crear un nuevo contenedor
        const newContainer = document.createElement('div');
        newContainer.className = 'new-container';

        // Añadir contenido al nuevo contenedor
        newContainer.innerHTML = `
        <h4>Seccion de alquiler</h4>

        <div class="col-md-6">
        <label for="inputEmail5" class="form-label">Seleccione articulo</label>
        <select class="form-control" name="paquete">
            <option value ="">Seleccione</option>
            
            <?php
                $control = $con -> prepare ("SELECT * from articulos Where id_articulo != 0");
                $control -> execute();
            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<option value=" . $fila['id_articulo'] . ">"
                . $fila['nombre_A'] . "</option>";
            } 
            ?>
        </select>
        </div>

        <div id="col-md-6">
        <label for="inputEmail5" class="form-label">Seleccione la cantidad</label>
        <select class="form-control" name="cantidad_arti">
            <option value ="">Seleccione</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Precio</label>
          <input  class="form-control" type="number" name="precio" placeholder="Precio" readonly required>
        </div>
        `;

        // Añadir el nuevo contenedor al contenedor principal
        containerWrapper.appendChild(newContainer);
    });
});