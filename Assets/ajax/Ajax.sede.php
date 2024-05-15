<?php
//Modelo
require_once ('../Model/Modelo.sede.php');

//controlador
require_once ('../Controllers/Controlller.sede.php');

class ajax_sede{
    public $id;
    public $nombre;
    public $estado;

    public function ajax_listar_sede(){
        if ($_POST['listar_sede']) {
            $res = controller_sede::controller_listar();
            echo json_encode($res);
        }
    }


}


if (isset($_POST['listar_sede'])) {
    $res = new ajax_sede();
    $res->estado = $_POST['listar_sede'];
    $res->ajax_listar_sede();
    
}