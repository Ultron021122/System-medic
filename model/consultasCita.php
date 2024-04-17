<?php
    require_once("../php/connection.php");
    require_once("../controller/ControllerCita.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch($tipo_consulta){
        case 'guardar':
            $PacienteID         = $_POST['NombreP'];
            $Fecha              = $_POST['Fecha'];
            $Hora               = $_POST['Hora'];
            $Medico_ID          = $_POST['NombreM'];
            $Motivo             = $_POST['Motivo'];
            $Recepcionista_ID   = $_POST['Recepcionista_ID'];
            $consultas = new cita();
            $ejecutar = $consultas->set_registro($PacienteID, $Fecha, $Hora, $Medico_ID, $Motivo, $Recepcionista_ID);
            echo json_encode($ejecutar);
            break;
        case 'editar':
            $ID = $_POST['id'];
            $consultas = new cita();
            $ejecutar = $consultas->search_editar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'update':
            $ID                 = $_POST['ID'];
            $PacienteID         = $_POST['NombreP'];
            $Fecha              = $_POST['Fecha'];
            $Hora               = $_POST['Hora'];
            $Medico_ID          = $_POST['NombreM'];
            $Motivo             = $_POST['Motivo'];
            $Recepcionista_ID   = $_POST['Recepcionista_ID'];
            $consultas = new cita();
            $ejecutar = $consultas->modificar_registro($ID, $PacienteID, $Fecha, $Hora, $Medico_ID, $Motivo, $Recepcionista_ID);
            echo json_encode($ejecutar);
            break;
        case 'eliminar':
            $ID = $_POST['id'];
            $consultas = new cita();
            $ejecutar = $consultas->eliminar_registro($ID);
            echo json_encode($ejecutar);
            break;
        case 'buscar':
            $Nombre = $_POST['nombre_cita'];
            $consultas = new cita();
            $ejecutar = $consultas->search_registro($Nombre);
            echo json_encode($ejecutar);
            break;
        default:
            # code...
            break;
    }
?>