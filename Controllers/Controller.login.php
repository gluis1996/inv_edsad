<?php


class ControllerLogin{

    public static function login(){
        if (isset($_POST["ingUsuario"])) {
            $usu = $_POST["ingUsuario"];
            $pas = $_POST["ingPassword"];

            $response = ModeloLogin::ModelLogin($usu,$pas); //asi se llama a la clase estatica

            if ($response) {
                if ($response['user'] == $_POST["ingUsuario"] && $response['contraseña']==$_POST["ingPassword"]) {
                        $_SESSION['iniciarsesion'] = 'ok';
                        $_SESSION['usu'] = $response['user'];
                        $_SESSION['pass'] = $response['contraseña'];
    
                        echo '<script>
                                window.location="instalacionfo";
                            </script>';
                }else {
                    echo '<br><div class="alert alert-danger">Error al ingresar, Vuelve a Intentarlo</div>';
                }
            }else {
                echo '<br><div class="alert alert-danger">Error al ingresar, Vuelve a Intentarlo</div>';
            }
        }

    }


}