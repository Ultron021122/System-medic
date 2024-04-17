<?php
    class paciente extends connection {

        protected $ID;
        protected $Curp;
        protected $Nombre;
        protected $Apellidos;
        protected $Sexo;
        protected $Fecha_nacimiento;
        protected $Direccion;
        protected $Telefono;
        protected $Email;

        public function __construct(){
            parent::__construct();
        }

        public function set_registro($Curp, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email){
            $sql = "SELECT * FROM paciente WHERE CURP = '$Curp'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if(!$respuesta){
                $sql = "INSERT INTO paciente(CURP, Nombre, Apellidos, Sexo, Fecha_nacimiento, Direccion, Telefono, Email)VALUES('$Curp', '$Nombre', '$Apellidos', '$Sexo', '$Fecha_nacimiento', '$Direccion', '$Telefono', '$Email')";
                if($this->_db->query($sql)) {
                    $resultado = $this->select_paciente();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function select_paciente() {
            $sql = "SELECT * FROM paciente";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function search_registro($Nombre) {
            $sql = "SELECT * FROM paciente WHERE Nombre LIKE '%$Nombre%' OR Apellidos LIKE '%$Nombre%'";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function search_editar_registro($ID) {
            $sql = "SELECT * FROM paciente WHERE ID = '$ID'";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email) {
            $sql = "UPDATE paciente SET Nombre='$Nombre', Apellidos='$Apellidos', Sexo='$Sexo', Fecha_nacimiento='$Fecha_nacimiento', Direccion='$Direccion', Telefono='$Telefono', Email='$Email' WHERE ID='$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_paciente();
                return $resultado;
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function eliminar_registro($ID) {
            $sql = "DELETE FROM paciente WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_paciente();
                return $resultado;
            } else {
                return "error";
            }
        }
    }
?>