<?php
//controlador
require_once('../../Controllers/Controlller.sede.php');

//Modelo
require_once('../../Model/Modelo.sede.php');

class ajax_sede
{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_sede(){
        if ($this->accion == 'registroSede') {
           $data = array(
            'nombre_sede' =>$this->nombre
           );
        }
        $response  = controller_sede::controller_agregar_sede($data);
        echo $response;
    }
    
    public function ajax_listar_sede(){
        if ($this->accion=='listasede') {
           $response = controller_sede::controller_listar_sede();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idsede" => "--",
                    "nombresed" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_sed='".$value['idsedes']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_sede' id_sedels='".$value['idsedes']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idsede" => $value['idsedes'],
                        "nombresed" =>  $value['nombres'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_eliminar_sede(){
        if ($this->accion=='eliminarsede') {
            $data = array(
                'idsd'=>$this->id
            );
            $response = controller_sede::controller_eliminar_sede($data);
            echo $response;
        }
    }

}

//registrar SEDE
if (isset($_POST['registro_sede'])) {
    $res = new ajax_sede();
    $res->accion = $_POST['registro_sede'];
    $res->nombre = $_POST['nombrexsede'];
    $res->ajax_registrar_sede();
}
//listar SEDE
if (isset($_POST['lista_sede'])) {
    $res = new ajax_sede();
    $res->accion = $_POST['lista_sede'];
    $res->ajax_listar_sede();
    
}

//eliminar SEDE
if (isset($_POST['eliminar_sede'])) { //
    $res = new ajax_sede();
    $res->accion = $_POST['eliminar_sede']; //accion= 'te quirerop',
    $res->id = $_POST['idsede'];
    $res->ajax_eliminar_sede();
    
}

