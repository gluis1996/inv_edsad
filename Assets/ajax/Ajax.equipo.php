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
    public $modelo;
    public $descripcion;
    public $fecha_registro;
    public $idmarca;

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
    public function ajax_equipo_registrar_equipo(){
        if ($this->accion== 'registrar_equipo') {
            $data = array(
                'p_modelo' => $this->modelo,
                'p_descripcion' => $this->descripcion,
                'p_fecha_registro' => $this->fecha_registro,
                'p_idmarca' => $this->idmarca
            );

            $response = controller_equipo::c_registrar($data);
            echo $response;
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


if (isset($_POST['registrar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['registrar_equipo'];
    $res->modelo = $_POST['e_modelo'];
    $res->descripcion = $_POST['e_descripcion'];
    $res->fecha_registro = $_POST['e_fecha'];
    $res->idmarca = $_POST['e_marca'];
    $res->ajax_equipo_registrar_equipo();
}