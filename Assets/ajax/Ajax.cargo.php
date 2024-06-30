<?php

require_once('../../Controllers/Controller.cargo.php');
require_once('../../Model/Modelo.cargo.php');

class ajax_cargo{
    public $id;
    public $nombre;
    public $accion;



    public function listar_cargo_tbl(){
        if ($this->accion == 'listar_cargo') {
            $response = controller_cargo::c_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idcargo" => "--",
                    "nombre_cargo" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $unique_id = "id_cargo_buscar_" . $value['idcargo'];
                    $botones = "<div class='form-row' style='display: flex; gap: 5px;' ><button type='button' class='btn btn-primary btn-sm btn_cargar_cargo' id ='".$unique_id."' id_cargo='".$value['idcargo']."' data-toggle='modal' data-target='#modal_editar_cargo' ><i class='fas fa-pencil-alt' aria-hidden='true'></i></button><button type='button' class='btn btn-danger btn_eliminar_cargo btn-sm' id_cargo_el='" . $value['idcargo'] . "' ><i class='fas fa-trash-alt'></i></button></div>";
                    $datosjason['data'][] = array(
                        "idcargo" => $value['idcargo'],
                        "nombre_cargo" =>  $value['nombre_cargo'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    //Editar

    public function ajax_editar_cargo(){
        
    }

}


//Listar
if (isset($_POST['listar_cargo'])) {
    $res = new ajax_cargo();
    $res->accion = $_POST['listar_cargo'];
    $res->listar_cargo_tbl();
}

if (isset($_POST['eitar_cargo'])) {
    $res = new ajax_cargo();
    $res->accion = $_POST['eitar_cargo'];
    $res->ajax_editar_cargo();
}