<?php

//controlador
require_once('../../Controllers/Controller.equipo.php');
require_once('../../Controllers/Controller.marca.php');
//Modelo
require_once('../../Model/Modelo.equipo.php');
require_once('../../Model/Modelo.marca.php');


class ajax_equipo{
    public $accion;
    public $id_equipo;
    public $nombre;

    public function ajax_lista_equipo(){
        if ($this->accion = 'listar_equipo') {
            $response = controller_equipo::c_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idequipos" => "--",
                    "modelo" => "--",
                    "descripcion" => "--",
                    "fecha_registro" => "--",
                    "nombre" => "--", 
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $idequipo = "idequipo_".$value['idequipos'];
                    $botones = "<div class='col'><button type='button' class='btn btn-primary' id='".$idequipo."' data-toggle='modal' data-target='#modal_equipo_editar'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idequipos" => $value['idequipos'],
                        "modelo" =>  $value['modelo'],
                        "descripcion" =>  $value['descripcion'],
                        "fecha_registro" =>  $value['fecha_registro'],
                        "nombre" =>  $value['nombre'],
                        "acciones" => $botones
                    );
                }
            }
            
            echo json_encode($datosjason);

        }
    }

    public function ajax_equipo_listarmarca(){
        if ($this->accion== 'equipos_llenar_select_marca') {
            $response = controller_marca::c_marca_listar();
            echo json_encode($response);
        }
    }

}


if (isset($_POST['listar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['listar_equipo'];
    $res->ajax_lista_equipo();
}

if (isset($_POST['equipos_llenar_select_marca'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['equipos_llenar_select_marca'];
    $res->ajax_equipo_listarmarca();
}