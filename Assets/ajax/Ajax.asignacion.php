<?php
//controlador
require_once ('../../Controllers/Controller.asignacion.php');
require_once ('../../Controllers/Controlller.sede.php');
require_once ('../../Controllers/Controller.oficina.php');

//Modelo
require_once ('../../Model/Modelo.detalleAsignacion.php');
require_once ('../../Model/Modelo.sede.php');
require_once ('../../Model/Modelo.oficina.php');

class ajax_asignacion{

    public $accion;
    public $id_sede;

    public function ajax_listar(){
        if ($this->accion == 'listarAE') {
            $response = controller_asignacion::c_listar();
            
            $datosjason = array();
        
                if (empty($response)) {
                    $datosjason['data'][] = array(
                        "id_detalle_asignacion" => "--",
                        "sede_nombres" => "--",
                        "oficina_nombres" => "--",
                        "equipo" => "--",
                        "usuario_nombre" => "--",
                        "cod_patrimonial" => "--",
                        "vida_util" => "--",
                        "estado" => "--",
                        "fecha_asignacion" => "--",
                        "acciones" => "--"
                    );
                } else {
                    foreach ($response as $value) {
                        
                        $botones = "<div class='col'>  <button type='button' class='btn btn-dark tbl_radcheck ' ><i class='fas fa-eye'></i></button> <button    type='button' class='btn btn-primary btn_raddact' ></i></button> <button type='button'    class='btn btn-warning btn_registrar_atc' ></i></button><button type='button' class='btn btn-danger btnEliminarRadius' ></i></button></div>";

                        $datosjason['data'][] = array(
                            "id_detalle_asignacion" => $value['id_detalle_asignacion'],
                            "sede_nombres" => $value['sede_nombres'],
                            "oficina_nombres" => $value['oficina_nombres'],
                            "equipo" => $value['equipo'],
                            "usuario_nombre" => $value['usuario_nombre'],
                            "cod_patrimonial" => $value['cod_patrimonial'],
                            "vida_util" => $value['vida_util'],
                            "estado" => $value['estado'],
                            "fecha_asignacion" => $value['fecha_asignacion'],
                            "acciones" => $botones
                        );
                    }
                }
                echo json_encode($datosjason);

        }
    }


    public function ajax_listar_sede(){
        if ($this->accion == 'listar_sede_en_select') {
            $response = controller_sede::controller_listar();
            echo json_encode($response);
        }
    }
    
    public function ajax_listar_oficinas(){
        if ($this->accion == 'listar_oficinas_por_sede') {
            $response = controller_oficina::c_listar_oficina($this->id_sede);
            echo json_encode($response);
        }
    }

}

if (isset($_POST['listarAE'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listarAE'];
    $res->ajax_listar();
}

if (isset($_POST['listar_sede_en_select'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_sede_en_select'];
    $res->ajax_listar_sede();
}

if (isset($_POST['listar_oficinas_por_sede'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_oficinas_por_sede'];
    $res->id_sede = $_POST['id_sede'];
    $res->ajax_listar_oficinas();
}