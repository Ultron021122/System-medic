<?php
    class cita extends connection {

        protected $ID;
        protected $Paciente_ID;
        protected $Fecha;
        protected $Hora;
        protected $Medico_ID;
        protected $Motivo;
        protected $Recepcionista_ID;

        public function __construct(){
            parent::__construct();
        }

        public function set_registro($Paciente_ID, $Fecha, $Hora, $Medico_ID, $Motivo, $Recepcionista_ID) {
            $sql = "SELECT * FROM citas WHERE Fecha='$Fecha' AND Hora='$Hora' AND Medico_ID='$Medico_ID' OR Fecha='$Fecha' AND Paciente_ID='$Paciente_ID'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if (!$respuesta){
                $ID = $this->select_recep($Recepcionista_ID);
                $pertenece = $ID['0']['ID'];
                $sql = "INSERT INTO citas(Fecha, Hora, Motivo, Medico_ID, Paciente_ID, Recepcionista_ID)VALUES('$Fecha', '$Hora', '$Motivo', '$Medico_ID', '$Paciente_ID', '$pertenece')";
                if ($this->_db->query($sql)) {
                    $resultado = $this->select_cita();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function select_recep($ID_user){
            $sql = "SELECT * FROM recepcionista WHERE ID_user = '$ID_user'";
            $resultado = $this->_db->query($sql);
            return $array =$resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function select_cita() {
            $sql = "SELECT citas.ID, citas.Fecha, citas.Hora, citas.Motivo, citas.Medico_ID, citas.Paciente_ID, citas.Recepcionista_ID, recepcionista.Nombre AS Nombre_recepcionista, recepcionista.Apellidos AS Apellidos_recepcionista, medico.Nombre AS Nombre_medico, medico.Apellidos AS Apellidos_medico, paciente.Nombre AS Nombre_paciente, paciente.Apellidos AS Apellidos_paciente FROM citas INNER JOIN recepcionista ON citas.Recepcionista_ID = recepcionista.ID INNER JOIN paciente ON citas.Paciente_ID = paciente.ID INNER JOIN medico ON citas.Medico_ID = medico.ID";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function search_editar_registro($ID) {
            $sql = "SELECT citas.ID, citas.Fecha, citas.Hora, citas.Motivo, citas.Medico_ID, citas.Paciente_ID, citas.Recepcionista_ID, recepcionista.Nombre AS Nombre_recepcionista, recepcionista.Apellidos AS Apellidos_recepcionista, medico.Nombre AS Nombre_medico, medico.Apellidos AS Apellidos_medico, paciente.Nombre AS Nombre_paciente, paciente.Apellidos AS Apellidos_paciente FROM citas INNER JOIN recepcionista ON citas.Recepcionista_ID = recepcionista.ID INNER JOIN paciente ON citas.Paciente_ID = paciente.ID INNER JOIN medico ON citas.Medico_ID = medico.ID WHERE citas.ID ='$ID'";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $Paciente_ID, $Fecha, $Hora, $Medico_ID, $Motivo, $Recepcionista_ID) {
            $sql = "SELECT * FROM citas WHERE Fecha='$Fecha' AND Hora='$Hora' AND ID!='$ID' AND Medico_ID='$Medico_ID' OR Fecha='$Fecha' AND Paciente_ID='$Paciente_ID' AND ID!='$ID'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if (!$respuesta){
                $sql = "UPDATE citas SET Hora='$Hora', Fecha='$Fecha', Motivo='$Motivo', Paciente_ID='$Paciente_ID', Medico_ID='$Medico_ID', Recepcionista_ID='$Recepcionista_ID' WHERE ID='$ID'";
                if ($this->_db->query($sql)) {
                    $resultado = $this->select_cita();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function eliminar_registro($ID) {
            $sql = "DELETE FROM citas WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_cita();
                return $resultado;
            } else {
                return "error";
            }
        }

        public function search_registro($Nombre){
            $sql = "SELECT citas.ID, citas.Fecha, citas.Hora, citas.Motivo, citas.Medico_ID, citas.Paciente_ID, citas.Recepcionista_ID, medico.Nombre AS Nombre_medico, medico.Apellidos AS Apellidos_medico, paciente.Nombre AS Nombre_paciente, paciente.Apellidos AS Apellidos_paciente FROM citas INNER JOIN paciente ON citas.Paciente_ID = paciente.ID INNER JOIN medico ON citas.Medico_ID = medico.ID WHERE paciente.Nombre LIKE '%$Nombre%' OR paciente.Apellidos LIKE '%$Nombre%' OR medico.Nombre LIKE '%$Nombre%' OR medico.Apellidos LIKE '%$Nombre%'";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }
    }
?>