<?php
    date_default_timezone_set('America/Mexico_City');

    class medico extends connection {
        
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
        protected $Especialidad;
        protected $Cedula;

        public function __construct(){
            parent::__construct();
        }

        public function set_registro($Curp, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Password, $Especialidad, $Cedula){            
            $sql = "SELECT * FROM medico WHERE CURP = '$Curp'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if(!$respuesta){
                $encriptar = password_hash($Password, PASSWORD_BCRYPT);
                $usuario = "INSERT INTO usuario VALUES (NULL, '$Curp', '$encriptar', '3')";
                $realizar = $this->_db->query($usuario);
                # Obtención de ID
                $ID = $this->select_usuario($Curp);
                $pertenece = $ID['0']['ID'];

                $sql3 = "INSERT INTO medico(CURP, Nombre, Apellidos, Sexo, Fecha_nacimiento, Direccion, Telefono, Email, Fecha_contratacion, Especialidad, Cedula_medica, ID_user)VALUES('$Curp', '$Nombre', '$Apellidos', '$Sexo', '$Fecha_nacimiento', '$Direccion', '$Telefono', '$Email', '$Fecha_contratacion', '$Especialidad', '$Cedula', '$pertenece')";
                if($this->_db->query($sql3)) {
                    $resultado = $this->select_medico();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function select_medico(){
            $sql = "SELECT * FROM medico";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function select_usuario($Curp){
            $sql = "SELECT * FROM usuario WHERE Username = '$Curp'";
            $resultado = $this->_db->query($sql);
            return $array =$resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function search_registro($Nombre) {
            $sql = "SELECT * FROM medico WHERE Nombre LIKE '%$Nombre%' OR Apellidos LIKE '%$Nombre%'";
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
            $sql = "SELECT * FROM medico WHERE ID = '$ID'";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function agenda_medico_usuario($ID) {
            $sql = "SELECT medico.ID AS ID, medico.Nombre AS Nombre, medico.Apellidos AS Apellidos,
                    medico.Especialidad AS Especialidad, medico.Cedula_medica AS Cedula_medica, citas.ID AS ID_cita,
                    citas.Fecha AS Fecha, citas.Hora AS Hora, citas.Motivo AS Motivo, citas.Paciente_ID AS ID_paciente, paciente.Nombre AS N_paciente, paciente.Apellidos AS A_paciente
                    FROM medico INNER JOIN citas ON citas.Medico_ID= medico.ID INNER JOIN paciente ON paciente.ID = citas.Paciente_ID
                        WHERE medico.ID_user='$ID' AND citas.Fecha >= CURDATE();";
            $result = $this->_db->query($sql);
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
                $result->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email, $Fecha_contratacion, $Especialidad, $Cedula){
            $sql = "UPDATE medico SET Nombre='$Nombre', Apellidos='$Apellidos', Sexo='$Sexo', Fecha_nacimiento='$Fecha_nacimiento', Direccion='$Direccion', Telefono='$Telefono', Email='$Email', Fecha_contratacion='$Fecha_contratacion', Especialidad='$Especialidad', Cedula_medica='$Cedula' WHERE ID = '$ID'";    
            if($this->_db->query($sql)){
                $resultado = $this->select_medico();
                return $resultado;
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function eliminar_registro($ID) {
            $sql = "DELETE FROM usuario WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->select_medico();
                return $resultado;
            } else {
                return "error";
            }
        }
    }
?>