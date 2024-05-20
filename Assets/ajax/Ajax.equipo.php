<?php

//controlador
require_once('../../Controllers/Controller.equipo.php');

//Modelo
require_once('../../Model/Modelo.equipo.php');


class ajax_equipo{
    public $accion;
    public $id_equipo;
    public $nombre;

    public function ajax_lista_equipo(){
        if ($this->accion = 'listar_equipo') {
            $response = controller_equipo::c_listar();
            echo json_encode($response);
        }
    }

}


if (isset($_POST['listar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['listar_equipo'];
    $res->ajax_lista_equipo();
}