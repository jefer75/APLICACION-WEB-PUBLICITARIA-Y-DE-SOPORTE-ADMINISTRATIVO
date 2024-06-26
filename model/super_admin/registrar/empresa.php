<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db->conectar();

    if (isset($_POST['registrar'])){
        $nit = $_POST['nit'];
        $nombre_emp = $_POST['nombre_emp'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        // Verifica si hay datos vacíos
        if (empty($nit) || empty($nombre_emp) || empty($telefono) || empty($direccion)) {
            echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
            echo '<script>window.location="./read_empresa.php";</script>';
        } else {
            $sql = $con->prepare("SELECT * FROM empresa WHERE nit = $nit");
        $sql->execute();
        $fila = $sql->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            echo '<script>alert("Esta empresa ya tiene una licencia");</script>';
            echo '<script>window.location="../read_empresa.php";</script>';
        } else {
            // Usa parámetros en la consulta para prevenir SQL Injection
            $insertSQL = $con->prepare("INSERT INTO empresa (nit, nombre_emp, telefono, direccion) VALUES ($nit, '$nombre_emp', $telefono, '$direccion')");

            $insertSQL->execute();
                echo '<script>alert("REGISTRO EXITOSO");</script>';
                echo '<script>window.location="../read_empresa.php";</script>';
        }
        }
    }