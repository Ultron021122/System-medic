<?php

    class session extends Connection {

        protected $username;
        protected $password;

        public function __construct(){
            parent::__construct();
        }

        public function iniciar($username, $password){
            session_start();
            $_SESSION['login'] = false;

            $sql = "SELECT * FROM usuario WHERE Username = '$username'";
            
            $consulta = $this->_db->query($sql);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
            if ($resultado) {
                if (password_verify($password, $resultado[0]['Password']) or $password == $resultado[0]['Password']) {
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $resultado[0]['ID'];
                    $_SESSION['username'] = $resultado[0]['Username'];
                    $_SESSION['rol'] = $resultado[0]['ID_user_role'];
                    switch ($_SESSION['rol']) {
                        case 1:
                            header('Location: ../menu_admin.php');
                            break;
                            case 2:
                                header('Location: ../menu_recepcionista.php');
                                break;
                                case 3:
                                    header('Location: ../menu_medico.php');
                                    break;
                        
                        default:
                            # code...
                            break;
                    }
                } else {
                    header('Location: ../index.php');
                }
            } else {
                header('Location: ../index.php');
            }
        }
    }
?>