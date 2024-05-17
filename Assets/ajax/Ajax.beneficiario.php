
<?php
//controlador
require_once('../../Controllers/Controller.beneficiario.php');

//Modelo
require_once('../../Model/Modelo.beneficiario.php');


class ajax_beneficiario
{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_benficiario()
    {
        if ($this->accion == 'registro_beneficiario') {
            echo 'se va registrar ' . $this->nombre;
        } else {
            echo 'incorrecto';
        }
    }
}

if (isset($_POST['registro_beneficiario'])) {
    $res = new ajax_beneficiario();
    $res->accion = $_POST['registro_beneficiario'];
    $res->nombre = $_POST['nombresede'];
    $res->ajax_registrar_benficiario();
}
