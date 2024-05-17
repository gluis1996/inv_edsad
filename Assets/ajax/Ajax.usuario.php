<?php
//controlador
//require_once ('../../Controllers/controller.usuario.php');

//Modelo
//require_once ('../../Model/Modelo.usuario.php');


class ajax_usuario{
    public $id;
    public $nombre;
    public $user;
    public $contraseña;
    public $accion;

    public function ajax_registrar_usuario(){
        if ($this->accion == 'registro_usuario') {
            // echo '<ul>';
            // echo '<li>Nombre: ' . $this->nombre . '</li>';
            // echo '<li>Usuario: ' . $this->user . '</li>';
            // echo '<li>Contraseña: ' . $this->contraseña . '</li>';
            // echo '</ul>';
            echo 'se va registrar ' . $this->user;
        } else {
            echo 'incorrecto';
        }
    }
    

}

if (isset($_POST['registro_usuario'])) {
    $res = new ajax_usuario();
    $res->accion = $_POST['registro_usuario'];
    $res->nombre = $_POST['nombre_usuario'];
    $res->user = $_POST['user'];
    $res->contraseña = $_POST['contra'];
    $res->ajax_registrar_usuario();
    
}