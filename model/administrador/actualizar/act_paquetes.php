
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>

</head>
<body>
    

<div class="modal fade" id="editar<?php echo $fila['id_paquetes']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar el registro de <?php echo $fila['nombre_paquete']; ?></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="../funciones/fun_paquetes.php" method="POST">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Paquete</label>
                                <input type="text" id="paquete" name="nombre_p" class="form-control" value="<?php echo $fila['nombre_paquete']; ?>" required>

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Edad minima</label>
                                <input type="text" id="edad_min" name="edad_min" class="form-control" value="<?php echo $fila['edad_min']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Edad maxima</label>
                        <input type="text" name="edad_max" id="edad_max" class="form-control" value="<?php echo $fila['edad_max']; ?>" >

                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Alquiler</label>
                        <input type="text" name="valor" id="descripcion" class="form-control" value="<?php echo $fila['valor']; ?>" >

                    </div>

                    <input type="hidden" name="editar" value="editar">
                    <input type="hidden" name="id_paquetes" value="<?php echo $fila['id_paquetes']; ?>">
                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>


            </form>
        </div>
    </div>
</div>


</body>
</html>