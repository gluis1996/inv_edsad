<?php
//controlador
require_once ('../../Controllers/Controller.asignacion.php');

//Modelo
require_once ('../../Model/Modelo.detalleAsignacion.php');

class ajax_asignacion{

    public $estado;

    public function ajax_listar(){
        if ($this->estado == 'listarAE') {
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
                    foreach ($response as $item) {
                        

                        $botones = "<div class='col'>  <button type='button' class='btn btn-dark tbl_radcheck ' ><i class='fas fa-eye'></i></button> <button    type='button' class='btn btn-primary btn_raddact' ></i></button> <button type='button'    class='btn btn-warning btn_registrar_atc' ></i></button><button type='button' class='btn btn-danger btnEliminarRadius' ></i></button></div>";

                        $datosjason['data'][] = array(
                            "id_detalle_asignacion" => $item['id_detalle_asignacion'],
                            "sede_nombres" => $item['sede_nombres'],
                            "oficina_nombres" => $item['oficina_nombres'],
                            "equipo" => $item['equipo'],
                            "usuario_nombre" => $item['usuario_nombre'],
                            "cod_patrimonial" => $item['cod_patrimonial'],
                            "vida_util" => $item['vida_util'],
                            "estado" => $item['estado'],
                            "fecha_asignacion" => $item['fecha_asignacion'],
                            "acciones" => $botones
                        );
                    }
                }
                echo json_encode($datosjason);

        }
    }

    

}

if (isset($_POST['listarAE'])) {
    $res = new ajax_asignacion();
    $res->estado = $_POST['listarAE'];
    $res->ajax_listar();
}