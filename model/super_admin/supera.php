<?php

include 'plantilla.php';

?>
    <title>ELITECH</title>
    <link rel="stylesheet" href="css/tabl.css">
    <link rel="stylesheet" href="css/regis.css">
    <style>
    dialog{
        width: 60%;
        height: 70vh;
        padding: 5vh 10vh;
        border: 0;
        margin: 5% 20%;
        }  
        .modal_close{
            padding: 2vh;
            background-color: red;
            float:right;
            margin-bottom: 2%;
            border-radius: 1vh;
            border: 0;
            }
    
    </style>
</head>
<body>


        <div class="dash-content">
            
            <div class="activity">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">Super Administradores</span>
                </div>
                <input type="submit" class="hiper" id="añadir" value="+" onclick="opendialog();">
    
                <dialog class="añadir_cont" id="añadir_cont">
                    <form method="post" action="registrar/suadmin.php" class="signup-form" autocomplete="off">
                    <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                <div class="form-row">
                    <div class="form-column">
                        <div class="form-floating">
                            <label for="nombres">Nombres</label>
                            <input class="form-control" type="text" name="nombre" id="nombres" placeholder="Digite Nombre" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-floating">
                            <label for="apellidos">Apellidos</label>
                            <input class="form-control" type="text" name="apellido" id="apellidos" placeholder="Apellidos" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-floating">
                            <label for="documento">N° Documento</label>
                            <input class="form-control" type="text" name="cedula" id="documento" placeholder="Digite Documento" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-floating">
                            <label for="telefono">Contacto</label>
                            <input class="form-control" type="text" name="celular" id="telefono" placeholder="Digite Telefono" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-floating">
                            <label for="correo">Correo</label>
                            <input class="form-control" type="email" name="correo" id="correo" placeholder="Digite Correo" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-floating">
                            <label for="contrasena">Contraseña</label>
                            <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" name="registrarse">Registro</button>
                <input type="hidden" name="MM_insert" value="formreg">
            </form>

                </dialog>
                <div class="formulario">
                <br>
                
                <form method="POST" action="">
                
                <table class="custom-table">
                <tr class="buscarable">
                        <th><b>Cedula</b></th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                        <?php
                            $con_paquetes = $con->prepare("SELECT usuarios.cedula, usuarios.nombre AS nombre_usuario, usuarios.celular, usuarios.correo, estados.estado
                            FROM usuarios
                            INNER JOIN estados ON estados.id_estado = usuarios.id_estado
                            WHERE usuarios.id_tipo_user = 4;");
                            $con_paquetes->execute();
                            $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($paquetes as $fila) {
                                $cedula = $fila['cedula'];
                                $nombre = $fila['nombre_usuario'];
                                $celular = $fila['celular'];
                                $correo = $fila['correo'];
                                $estado = $fila['estado'];
                            ?>
                        <tr>
                        <td><?php echo $cedula ?></td>
                                <td><?php echo $nombre ?></td>
                                <td><?php echo $celular ?></td>
                                <td><?php echo $correo ?></td>
                                <td><?php echo $estado?></td>
                                <td><a href="" class="boton" onclick="window.open
                                ('actualizar y eliminar/admin.php?id=<?php echo $cedula ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i>
                                <i class="uil uil-edit"></i>
                                </a></td>

                        </tr>
                            <?php
                            }
                            ?>
        </table>

        </form>   
            </div>
        </div>
        <br><br>
        <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>ELITECH JYDT</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://yourwebsite.com/">Your Company</a>
        </div>
    </footer>
    </section>
    <script src="../../js/modal.js"></script>
    <script>
        function validarFormulario() {
            var nombres = document.getElementById('nombres').value.trim();
            var apellidos = document.getElementById('apellidos').value.trim();
            var documento = document.getElementById('documento').value.trim();
            var telefono = document.getElementById('telefono').value.trim();
            var correo = document.getElementById('correo').value.trim();
            var contrasena = document.getElementById('contrasena').value.trim();

            // Validación de nombres y apellidos (solo letras y espacios, máximo 30 caracteres)
            if (!/^[a-zA-Z\s]{1,30}$/.test(nombres) || !/^[a-zA-Z\s]{1,30}$/.test(apellidos)) {
                alert('Los nombres y apellidos deben contener solo letras y espacios, con un máximo de 30 caracteres cada uno.');
                return false;
            }

            // Validación de documento (solo números, mínimo 8 y máximo 10 caracteres)
            if (!/^\d{8,10}$/.test(documento)) {
                alert('El número de documento debe contener solo números y tener entre 8 y 10 caracteres.');
                return false;
            }

            // Validación de teléfono (solo números, exactamente 10 caracteres)
            if (!/^\d{10}$/.test(telefono)) {
                alert('El teléfono debe contener exactamente 10 dígitos numéricos.');
                return false;
            }

            // Validación de correo electrónico (formato de correo válido)
            if (!/\S+@\S+\.\S+/.test(correo)) {
                alert('El correo electrónico no tiene un formato válido.');
                return false;
            }

            // Validación de contraseña (mínimo 8 y máximo 11 caracteres)
            if (contrasena.length < 8 || contrasena.length > 11) {
                alert('La contraseña debe tener entre 8 y 11 caracteres.');
                return false;
            }

            return true; // Si todas las validaciones pasan, se envía el formulario
        }
    </script>