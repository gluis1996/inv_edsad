<?php

require_once('../../Controllers/Controller.direccion.php');
require_once('../../Model/Modelo.direccion.php');

class ajax_direccion{
    public $id;
    public $nombre;
    public $accion;
    public $dato;
    public $registro;

    public function listar_direccion_tbl(){
        if ($this->accion == 'listar_direcciones') {
            $response = controller_direccion::c_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "iddireccion_oficina"   => "--",
                    "nombre_direccion"      => "--",
                    "acciones"              => "--"
                );
            } else {
                foreach ($response as $value) {
                    //$unique_id = "id_cargo_buscar_" . $value['idcargo'];
                    $botones = "<div class='form-row' style='display: flex; gap: 5px;' ><button type='button' class='btn btn-primary btn-sm' id ='id_direccion_buscar' nombre_direccion='".$value['nombre_direccion']."' iddireccion_oficina='".$value['iddireccion_oficina']."' data-toggle='modal' data-target='#modal_editar_direccion' ><i class='fas fa-pencil-alt' aria-hidden='true'></i></button><button type='button' class='btn btn-danger btn-sm' id='btn_eliminar_direccion' iddireccion_oficina_el='" . $value['iddireccion_oficina'] . "' ><i class='fas fa-trash-alt'></i></button></div>";
                    $datosjason['data'][] = array(
                        "iddireccion_oficina"   => $value['iddireccion_oficina'],
                        "nombre_direccion"      =>  $value['nombre_direccion'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function registrar_direccion(){
        if ($this->accion == 'registrar_direccion') {
            $response = controller_direccion::c_registrar($this->nombre);
            echo $response;
        }
    }

    public function editar_direccion(){
        if ($this->accion == 'editar_direccion') {
            $response = controller_direccion::c_editar($this->dato);
            echo $response;
        }
    }

    public function eliminar_direccion(){
        if ($this->accion == 'eliminar_direccion') {
            $response = controller_direccion::c_eliminar($this->id);
            echo $response;
        }
    }

}


//Listar
if (isset($_POST['listar_direcciones'])) {
    $res = new ajax_direccion();
    $res->accion = $_POST['listar_direcciones'];
    $res->listar_direccion_tbl();
}

//Editar
if (isset($_POST['registrar_direccion'])) {
    $res = new ajax_direccion();
    $res->accion = $_POST['registrar_direccion'];
    $res->nombre = $_POST['txt_registrar_direccion'];
    $res->registrar_direccion();
}

//Editar
if (isset($_POST['editar_direccion'])) {
    $res = new ajax_direccion();
    $res->accion = $_POST['editar_direccion'];
    $res->dato = $_POST['dato'];
    $res->editar_direccion();
}

//Eliminar
if (isset($_POST['eliminar_direccion'])) {
    $res = new ajax_direccion();
    $res->accion = $_POST['eliminar_direccion'];
    $res->id = $_POST['id_direccion'];
    $res->eliminar_direccion();
}