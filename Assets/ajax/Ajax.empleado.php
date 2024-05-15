<?php
//controlador
require_once ('../../Controllers/Controller.empleado.php');

//Modelo
require_once ('../../Model/Modelo.empleado.php');


class ajax_sede{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_empleado(){
        if ($this->accion=='registro_empleado') {
            echo 'se va registrar' . $this->nombre;
        }

    }

}


if (isset($_POST['registro_empleado'])) {
    $res = new ajax_sede();
    $res->accion = $_POST['registro_empleado'];
    $res->nombre = $_POST['nombre_empleado'];
    $res->ajax_registrar_empleado();
    
}