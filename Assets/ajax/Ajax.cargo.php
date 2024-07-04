<?php

require_once('../../Controllers/Controller.cargo.php');
require_once('../../Model/Modelo.cargo.php');

class ajax_cargo{
    public $id;
    public $nombre;
    public $accion;
    public $registro;



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
                    //$unique_id = "id_cargo_buscar_" . $value['idcargo'];
                    $botones = "<div class='form-row' style='display: flex; gap: 5px;' ><button type='button' class='btn btn-primary btn-sm btn_cargar_cargo' id ='id_cargo_buscar' nombre_cargo='".$value['nombre_cargo']."' id_cargo='".$value['idcargo']."' data-toggle='modal' data-target='#modal_editar_cargo' ><i class='fas fa-pencil-alt' aria-hidden='true'></i></button><button type='button' class='btn btn-danger btn-sm' id='btn_eliminar_cargo' id_cargo_el='" . $value['idcargo'] . "' ><i class='fas fa-trash-alt'></i></button></div>";
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
        if ($this->accion == 'editar_cargo') {
            $response = controller_cargo::c_editar($this->registro);
            echo $response;
        }   
    }

    //Editar
    public function ajax_registrar_cargo(){
        if ($this->accion == 'registrar_cargo') {
            $response = controller_cargo::c_registrar($this->nombre);
            echo $response;
        }    
    }
    
    //Editar
    public function ajax_eliminar_cargo(){
        if ($this->accion == 'eliminar_cargo') {
            $response = controller_cargo::c_eliminar($this->id);
            echo $response;
        }    
    }

}


//Listar
if (isset($_POST['listar_cargo'])) {
    $res = new ajax_cargo();
    $res->accion = $_POST['listar_cargo'];
    $res->listar_cargo_tbl();
}

//registrar
if (isset($_POST['registrar_cargo'])) {
    $res = new ajax_cargo();
    $res->accion = $_POST['registrar_cargo'];
    $res->nombre = $_POST['registrar_nombre'];
    $res->ajax_registrar_cargo();
}

//Editar
if (isset($_POST['editar_cargo'])) {
    $res            = new ajax_cargo();
    $res->accion    = $_POST['editar_cargo'];
    $res->registro  = $_POST['datos'];
    $res->ajax_editar_cargo();
}

//Eliminar
if (isset($_POST['eliminar_cargo'])) {
    $res            = new ajax_cargo();
    $res->accion    = $_POST['eliminar_cargo'];
    $res->id        = $_POST['id_cargo'];
    $res->ajax_eliminar_cargo();
}