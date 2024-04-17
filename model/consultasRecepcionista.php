<?php
    require_once("../php/connection.php");
    require_once("../controller/ControllerRecepcionista.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch ($tipo_consulta) {
        case 'guardar':
            $CURP               = $_POST['Curp'];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Fecha_contratacion = $_POST['Fecha_contratacion'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $Password           = $_POST['Password'];
            $consultas = new recepcionista();
            $ejecutar = $consultas->set_registro(strtoupper($CURP), $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Password);
            echo json_encode($ejecutar);
            break;
        case 'editar':
            $ID = $_POST['id'];
            $consultas = new recepcionista();
            $ejecutar = $consultas->search_editar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'update':
            $ID                 = $_POST["ID"];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Fecha_contratacion = $_POST['Fecha_contratacion'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $consultas = new recepcionista();
            $ejecutar = $consultas->modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion);
            echo json_encode($ejecutar);
            break;
        case 'eliminar':
            $ID = $_POST['id'];
            $consultas = new recepcionista();
            $ejecutar = $consultas->eliminar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'buscar':
            $Nombre = $_POST['nombre_recepcionista'];
            $consultas = new recepcionista();
            $ejecutar = $consultas->search_registro($Nombre);
            echo json_encode($ejecutar);
            break;
            default:
            # code...
            break;
    }

?>