<?php
    // header('Content-Type: application/json');
    require_once("../php/connection.php");
    require_once("ControllerMedico.php");
    session_start();

    $ID = $_SESSION['id'];

    $medico = new medico();
    $MedicoID = $medico->agenda_medico_usuario($ID);
    $array = array();
    $num = 0;
    foreach ($MedicoID as $row) {
        $_SESSION['id_medico'] = $row['ID'];
        $array[$num]["title"]='Cita médica '.$row['Hora'];
        $array[$num]["start"]=$row['Fecha'].'T'.$row['Hora'];
        $array[$num]["description"]=$row['Motivo'];
        $array[$num]["url"]="expediente_medico.php?paciente=".$row['ID_paciente'];
        // $array[$num]["color"]=randomColor();
        $num ++;
    }

    function randomColor(){
        $str = "#";
        for($i = 0 ; $i < 6 ; $i++){
        $randNum = rand(0, 15);
        switch ($randNum) {
        case 10: $randNum = "A"; 
        break;
        case 11: $randNum = "B"; 
        break;
        case 12: $randNum = "C"; 
        break;
        case 13: $randNum = "D"; 
        break;
        case 14: $randNum = "E"; 
        break;
        case 15: $randNum = "F"; 
        break; 
        }
        $str .= $randNum;
        }
        return $str;
    }

    echo json_encode($array);
?>
