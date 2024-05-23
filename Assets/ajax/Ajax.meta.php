<?php
//controlador
require_once ('../../Controllers/controller.meta.php');

//Modelo
require_once ('../../Model/Modelo.meta.php');


class ajax_meta{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_meta(){
        if ($this->accion=='registrometa') {
            $data = array(
                'nombremeta'=> $this->nombre
            );

            $response = controller_meta::controller_agregar_meta($data);
            echo $response;
        }

    }

    public function ajax_listar_meta(){
        if ($this->accion=='listameta') {
           $response = controller_meta::controller_listar();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idmet" => "--",
                    "nombremt" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_mt='".$value['idmeta']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_empleado' id_meta_ls='".$value['idmeta']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idmet" => $value['idmeta'],
                        "nombremt" =>  $value['nombre'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }



    
    public function ajax_eliminar_empleado(){
        if ($this->accion=='te_extraño') {
            $data = array(
                'tambien_te_Extraña'=>$this->id
            );
            $response = controller_empleado::c_eliminar_empleado($data);
            echo $response;
        }
    }

}

//registrar
if (isset($_POST['registro_meta'])) {
    $res = new ajax_meta();
    $res->accion = $_POST['registro_meta'];
    $res->nombre = $_POST['nombre_meta'];
    $res->ajax_registrar_meta();
    
}

//listar
if (isset($_POST['lista_meta'])) {
    $res = new ajax_meta();
    $res->accion = $_POST['lista_meta'];
    $res->ajax_listar_meta();
    
}

//eliminar
if (isset($_POST['id_eliminar_empleado'])) { //
    $res = new ajax_empleado();
    $res->accion = $_POST['id_eliminar_empleado']; //accion= 'te quirerop',
    $res->id = $_POST['idempleado'];
    $res->ajax_eliminar_empleado();
    
}

