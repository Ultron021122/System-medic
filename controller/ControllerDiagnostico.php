<?php
    date_default_timezone_set('America/Mexico_City');

    class diagnostico extends connection {

        protected $ID;
        protected $FechaTiempo_diagnostico;
        protected $Medicacion;
        protected $Observaciones;
        protected $Examen_fisico;
        protected $ID_medico;
        protected $ID_expediente;

        public function __construct(){
            parent::__construct();
        }

        public function select_diagnostico($ID_expediente) {
            $sql = "SELECT diagnostico.ID AS ID_diagnostico, DATE_FORMAT(diagnostico.FechaTiempo_diagnostico, '%d/%m/%Y - %H:%i:%s %p') AS FechaD,
                    diagnostico.Medicacion AS Medicacion, diagnostico.Observaciones AS Observaciones, diagnostico.Examen_fisico AS Examen_fisico,
                    diagnostico.ID_medico AS MedicoID, medico.Nombre AS Nombre, medico.Apellidos AS Apellidos, diagnostico.ID_expediente AS ID_expediente,
                    medico.Especialidad AS Especialidad FROM diagnostico INNER JOIN medico ON diagnostico.ID_medico = medico.ID WHERE diagnostico.ID_expediente=$ID_expediente;";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function imprimir_diagnostico($ID) {
            $sql = "SELECT diagnostico.ID AS ID, TIMESTAMPDIFF(YEAR,paciente.Fecha_nacimiento,CURDATE()) AS Edad, expediente.ID AS ID_expediente, paciente.ID AS ID_paciente, paciente.CURP AS CURP, paciente.Nombre AS Nombre, paciente.Apellidos AS Apellidos, paciente.Sexo AS Sexo, paciente.Fecha_nacimiento AS FechaN, paciente.Direccion AS Direccion, paciente.Telefono AS Telefono, paciente.Email AS Email FROM diagnostico INNER JOIN expediente ON diagnostico.ID_expediente = expediente.ID INNER JOIN paciente ON expediente.ID_paciente = paciente.ID WHERE diagnostico.ID = $ID;";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function set_registro($Medicacion, $Observaciones, $Examen_fisico, $ID_medico, $ID_expediente) {
            $FechaTiempo_diagnostico = date('y-m-d h:i:s');
            $sql = "INSERT INTO diagnostico VALUES (NULL, '$FechaTiempo_diagnostico', '$Medicacion', '$Observaciones', '$Examen_fisico', '$ID_medico', '$ID_expediente')";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_diagnostico($ID_expediente);
                return $resultado;
                $this->_db->close();
            } else {
                return "ocurrio";
            }
        }

        public function search_editar_registro($ID) {
            $sql = "SELECT diagnostico.ID AS ID_diagnostico, diagnostico.FechaTiempo_diagnostico AS FechaD,
            diagnostico.Medicacion AS Medicacion, diagnostico.Observaciones AS Observaciones, diagnostico.Examen_fisico AS Examen_fisico,
            diagnostico.ID_medico AS MedicoID, medico.Nombre AS Nombre, medico.Apellidos AS Apellidos, diagnostico.ID_expediente AS ID_expediente,
            medico.Especialidad AS Especialidad FROM diagnostico INNER JOIN medico ON diagnostico.ID_medico = medico.ID WHERE diagnostico.ID =$ID;";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $Medicacion, $Observaciones, $Examen_fisico, $ID_expediente) {
            $sql = "UPDATE diagnostico SET Medicacion='$Medicacion', Observaciones='$Observaciones', Examen_fisico='$Examen_fisico' WHERE ID='$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_diagnostico($ID_expediente);
                return $resultado;
                $this->_db->close();
            } else {
                return "ocurrio";
            }
        }

        public function eliminar_registro($ID, $ID_expediente) {
            $sql = "DELETE FROM diagnostico WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_diagnostico($ID_expediente);
                return $resultado;
            } else {
                return "error";
            }
        }

    }
?>
