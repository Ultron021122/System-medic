<?php
    require_once("../php/connection.php");
    require_once ("../controller/ControllerPaciente.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch ($tipo_consulta) {
        case 'guardar':
            $CURP               = $_POST['Curp'];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $consultas  = new paciente();
            $ejecutar = $consultas->set_registro(strtoupper($CURP), $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email);
            echo json_encode($ejecutar);
        break;
        case 'editar':
            $ID = $_POST['id'];
            $consultas = new paciente();
            $ejecutar = $consultas->search_editar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'update':
            $ID                 = $_POST['ID'];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $consultas = new paciente();
            $ejecutar = $consultas->modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email);
            echo json_encode($ejecutar);
            break;
        case 'eliminar':
            $ID = $_POST['id'];
            $consultas = new paciente();
            $ejecutar = $consultas->eliminar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'buscar':
            $Nombre = $_POST['nombre_paciente'];
            $consultas = new paciente();
            $ejecutar = $consultas->search_registro($Nombre);
            echo json_encode($ejecutar);
            break;
        default:
            # code...
            break;
    }

?>