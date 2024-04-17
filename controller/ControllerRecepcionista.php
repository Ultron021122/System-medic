<?php

    class recepcionista extends connection {
        
        protected $ID;
        protected $Curp;
        protected $Nombre;
        protected $Apellidos;
        protected $Sexo;
        protected $Fecha_nacimiento;
        protected $Fecha_contratacion;
        protected $Direccion;
        protected $Telefono;
        protected $Email;
        protected $Password;

        public function __construct(){
            parent::__construct();
        }

        public function set_registro($Curp, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Password){            
            $sql = "SELECT * FROM recepcionista WHERE CURP = '$Curp'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if(!$respuesta){
                $encriptar = password_hash($Password, PASSWORD_BCRYPT);
                $usuario = "INSERT INTO usuario VALUES (NULL, '$Curp', '$encriptar', '2')";
                $realizar = $this->_db->query($usuario);
                # Obtención de ID
                $ID = $this->select_usuario($Curp);
                $pertenece = $ID['0']['ID'];

                $sql3 = "INSERT INTO recepcionista(CURP, Nombre, Apellidos, Sexo, Fecha_nacimiento, Direccion, Telefono, Email, Fecha_contratacion, ID_user)VALUES('$Curp', '$Nombre', '$Apellidos', '$Sexo', '$Fecha_nacimiento', '$Direccion', '$Telefono', '$Email', '$Fecha_contratacion', '$pertenece')";
                if($this->_db->query($sql3)) {
                    $resultado = $this->select_recepcionista();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function select_recepcionista(){
            $sql = "SELECT * FROM recepcionista";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function select_usuario($Curp){
            $sql = "SELECT * FROM usuario WHERE Username = '$Curp'";
            $resultado = $this->_db->query($sql);
            return $array =$resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function search_registro($Nombre) {
            $sql = "SELECT * FROM recepcionista WHERE Nombre LIKE '%$Nombre%' OR Apellidos LIKE '%$Nombre%'";
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
            $sql = "SELECT * FROM recepcionista WHERE ID = '$ID'";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion){
            $sql = "UPDATE recepcionista SET Nombre='$Nombre', Apellidos='$Apellidos', Sexo='$Sexo', Fecha_nacimiento='$Fecha_nacimiento', Direccion='$Direccion', Telefono='$Telefono', Email='$Email', Fecha_contratacion='$Fecha_contratacion' WHERE ID = '$ID'";    
            if($this->_db->query($sql)){
                $resultado = $this->select_recepcionista();
                return $resultado;
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function eliminar_registro($ID){
            $sql = "DELETE FROM usuario WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_recepcionista();
                return $resultado;
            } else {
                return "error";
            }
        }
    }
?>