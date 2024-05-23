
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
                <h3 class="modal-title" id="exampleModalLabel">Estas seguro que quieres eliminar el paquete <?php echo $fila['nombre_paquete']; ?></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="../funciones/fun_paquetes.php" method="POST">

                    <input type="hidden" name="eliminar" value="Eliminar">
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