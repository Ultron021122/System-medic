<?php
    require_once("../php/connection.php");
    require_once("../controller/ControllerMedico.php");
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
            $Especialidad       = $_POST['Especialidad'];
            $Cedula             = $_POST['Cedula'];
            $consultas = new medico();
            $ejecutar = $consultas->set_registro(strtoupper($CURP), $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Password, $Especialidad, $Cedula);
            echo json_encode($ejecutar);
            break;
        case 'editar':
            $ID = $_POST['id'];
            $consultas = new medico();
            $ejecutar = $consultas->search_editar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'update':
            $ID                 = $_POST['ID'];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Fecha_contratacion = $_POST['Fecha_contratacion'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $Especialidad       = $_POST['Especialidad'];
            $Cedula             = $_POST['Cedula'];
            $consultas = new medico();
            $ejecutar = $consultas->modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Especialidad, $Cedula);
            echo json_encode($ejecutar);
            break;
        case 'eliminar':
            $ID = $_POST['id'];
            $consultas = new medico();
            $ejecutar = $consultas->eliminar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'buscar':
            $Nombre = $_POST['nombre_medico'];
            $consultas = new medico();
            $ejecutar = $consultas->search_registro($Nombre);
            echo json_encode($ejecutar);
            break;
        case 'mostrar':
            $consultas = new medico();
            $ejecutar = $consultas->select_medico();
            echo json_encode($ejecutar);
            break;
        default:
            # code...
            break;
    }

?>