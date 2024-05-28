<?php
//controlador
require_once('../../Controllers/Controller.area.usuaria.php');

//Modelo
require_once('../../Model/Modelo.areaUsuaria.php');

class ajax_area_usuaria
{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_areausu(){
        if ($this->accion == 'registroareausu') {
           $data = array(
            'nombre_area_u' =>$this->nombre
           );
        }
        $response  = controller_area_usuaria::controller_agregar_areausu($data);
        echo $response;
    }
    
    public function ajax_listar_areausu(){
        if ($this->accion=='lista_areausu') {
           $response = controller_area_usuaria::controller_listar_areausu();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idareausu" => "--",
                    "nombreareausu" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {

                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_sed='".$value['id_area_usuaria']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_area_usua' id_area_u='".$value['id_area_usuaria']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idareausu" => $value['id_area_usuaria'],
                        "nombreareausu" =>  $value['nombres'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_eliminar_area_usuaria(){
        if ($this->accion=='eliminar_areausu') {
            $data = array(
                'id_a_usu'=>$this->id
            );
            $response = controller_area_usuaria::controller_eliminar_areausu($data);
            echo $response;
        }
    }

}

//registrar area usuaria
if (isset($_POST['registro_ausuria'])) {
    $res = new ajax_area_usuaria;
    $res->accion = $_POST['registro_ausuria'];
    $res->nombre = $_POST['nombrexareausu'];
    $res->ajax_registrar_areausu();
}
//listar area usuaria
if (isset($_POST['lista_area_usuaria'])) {
    $res = new ajax_area_usuaria();
    $res->accion = $_POST['lista_area_usuaria'];
    $res->ajax_listar_areausu();
    
}
//eliminar
if (isset($_POST['eliminar_Ausuaria'])) { //
    $res = new ajax_area_usuaria();
    $res->accion = $_POST['eliminar_Ausuaria']; //accion= 'te quirerop',
    $res->id = $_POST['idareausua'];
    $res->ajax_eliminar_area_usuaria();
    
}

