<?php
    date_default_timezone_set('America/Mexico_City');

    class expediente extends connection {

        protected $ID;
        protected $FechaTiempo_creacion;
        protected $ID_paciente;

        public function __construct(){
            parent::__construct();
        }

        public function nuevo_expediente($ID_paciente) {
            $resultado = $this->search_registro($ID_paciente);
            if (!$resultado) {
                $FechaTiempo_creacion = date('y-m-d h:i:s');
                $sql = "INSERT INTO expediente VALUES ( NULL, '$FechaTiempo_creacion', '$ID_paciente')";
                if ($this->_db->query($sql)) {
                    $result = $this->search_registro($ID_paciente);
                    return $result;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function search_registro($ID_paciente) {
            $sql = "SELECT * FROM expediente WHERE ID_paciente='$ID_paciente'";
            $consulta = $this->_db->query($sql);
            if ($consulta) {
                return $consulta->fetch_all(MYSQLI_ASSOC);
                $consulta->close();
                $this->_db->close();
            }
        }

        public function cargar_datos($ID_paciente) {
            $sql = "SELECT expediente.ID, expediente.FechaTiempo_creación, expediente.ID_paciente, paciente.ID AS Identificacion, paciente.CURP, paciente.Nombre, paciente.Apellidos, paciente.Sexo, paciente.Fecha_nacimiento, paciente.Direccion, paciente.Telefono, paciente.Email FROM expediente INNER JOIN paciente ON expediente.ID_paciente = paciente.ID WHERE expediente.ID_paciente = '$ID_paciente'";
            $consulta = $this->_db->query($sql);
            if ($consulta) {
                return $consulta->fetch_all(MYSQLI_ASSOC);
                $consulta->close();
                $this->_db->close();
            }
        }

        public function select_expedientes() {
            $sql = "SELECT * FROM expediente";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function imprimir_expediente($ID) {
            $sql = "SELECT expediente.ID, expediente.FechaTiempo_creación, expediente.ID_paciente, paciente.ID AS Identificacion, paciente.CURP,TIMESTAMPDIFF(YEAR,paciente.Fecha_nacimiento,CURDATE()) AS Edad, paciente.Nombre, paciente.Apellidos, paciente.Sexo, paciente.Fecha_nacimiento, paciente.Direccion, paciente.Telefono, paciente.Email FROM expediente INNER JOIN paciente ON expediente.ID_paciente = paciente.ID WHERE expediente.ID = '$ID'";
            $consulta = $this->_db->query($sql);
            if ($consulta) {
                return $consulta->fetch_all(MYSQLI_ASSOC);
                $consulta->close();
                $this->_db->close();
            }
        }
    }
?>