<?php
//controlador
require_once('../../Controllers/Controller.oficina.php');

//Modelo
require_once('../../Model/Modelo.oficina.php');


class ajax_oficina
{
    public $id;
    public $nombre;
    public $idsede;
    public $accion;

    public function ajax_registrar_oficina()
    {
        if ($this->accion == 'registro_oficina') {
            echo 'se va registrar ' . $this->nombre;
        } else {
            echo 'incorrecto';
        }
    }
}

if (isset($_POST['registro_oficina'])) {
    $res = new ajax_oficina();
    $res->accion = $_POST['registro_oficina'];
    $res->nombre = $_POST['nombre_oficina'];
    $res->idsede = $_POST['id_sede'];
    $res->ajax_registrar_oficina();
}
