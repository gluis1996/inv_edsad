<?php
//controlador
require_once ('../../Controllers/Controlller.sede.php');

//Modelo
require_once ('../../Model/Modelo.sede.php');


class ajax_sede{
    public $id;
    public $nombre;
    public $estado;

    public function ajax_registrar_sede(){
        if ($this->estado=='registro_sede') {
            echo 'se va registrar' . $this->nombre;
        }else{
            echo 'incorrecto';
        }

    }

}




if (isset($_POST['registro_sede'])) {
    $res = new ajax_sede();
    $res->estado = $_POST['registro_sede'];
    $res->nombre = $_POST['nombre_sede'];
    $res->ajax_registrar_sede();
    
}