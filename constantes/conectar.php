<?php 

    require "constantes.php";

    $usuario = USER;
    $password = PASS;
    $servidor = SERVER;
    $basededatos = DB;

    $conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);

    if (!$conexion) {
        $alert1 = "Error: No se pudo conectar a MySQL." . PHP_EOL;
        $alert1 .= "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        $alert1 .= "error de depuración: " . mysqli_connect_error() . PHP_EOL . " Por favor ponerse en contacto con el administrador de sistemas.";
        echo $alert1;
        exit;
    }else{
        //echo "conecto";
    }

?>