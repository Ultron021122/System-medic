<?php
    require_once("../php/connection.php");
    require_once("../controller/ControllerSesion.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch ($tipo_consulta) {
        case 'iniciar':
            $Username   = $_POST['Username'];
            $Password   = $_POST['Password'];
            $inicio     = new session();
            $inicio->iniciar($Username, $Password);
            break;
        default:
            # code...
            break;    
    }
?>