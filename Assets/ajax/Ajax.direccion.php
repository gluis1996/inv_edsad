<?php

require_once('../../Controllers/Controller.direccion.php');
require_once('../../Model/Modelo.direccion.php');

class ajax_cargo{
    public $id;
    public $nombre;
    public $accion;
    public $registro;

    public function listar_cargo_tbl(){
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
                    $botones = "<div class='form-row' style='display: flex; gap: 5px;' ><button type='button' class='btn btn-primary btn-sm' id ='id_direccion_buscar' nombre_direccion='".$value['nombre_direccion']."' iddireccion_oficina='".$value['iddireccion_oficina']."' data-toggle='modal' data-target='#modal_editar_cargo' ><i class='fas fa-pencil-alt' aria-hidden='true'></i></button><button type='button' class='btn btn-danger btn-sm' id='btn_eliminar_cargo' iddireccion_oficina_el='" . $value['iddireccion_oficina'] . "' ><i class='fas fa-trash-alt'></i></button></div>";
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


}


//Listar
if (isset($_POST['listar_direcciones'])) {
    $res = new ajax_cargo();
    $res->accion = $_POST['listar_direcciones'];
    $res->listar_cargo_tbl();
}