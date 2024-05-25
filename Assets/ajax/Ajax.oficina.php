<?php
//controlador
require_once('../../Controllers/Controller.oficina.php');
require_once('../../Controllers/Controlller.sede.php');

//Modelo
require_once('../../Model/Modelo.oficina.php');
require_once('../../Model/Modelo.sede.php');


class ajax_oficina
{
    public $id;
    public $nombre;
    public $idsede;
    public $accion;

    public function ajax_registrar_oficina()
    {
        if ($this->accion == 'registroOficina') {
            $data = array(
                'nombre_oficina' =>$this->nombre,
                'idsede' =>$this->idsede,
            );
           $response = controller_oficina::controller_agregar_oficina($data);
           echo $response; 
        } 
    }

    public function ajax_listar_ofina(){
        if ($this->accion=='listaoficina') {
           $response = controller_oficina::controller_listar();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idofi" => "--",
                    "nombreofi" => "--",
                    "nombresede" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_ofi='".$value['idoficinas']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_oficina' id_ofi_el='".$value['idoficinas']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idofi" => $value['idoficinas'],
                        "nombreofi" =>  $value['nombre_oficina'],
                        "nombresede" =>  $value['nombre_sede'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_select_sede(){
        if ($this->accion == 'listarsedeofi') {
            $response = controller_sede::controller_listar();
            echo json_encode($response);
        }
    }

    public function ajax_eliminar_oficina(){
        if ($this->accion=='eliminaroficina') {
            $data = array(
                'idofi'=>$this->id
            );
            $response = controller_oficina::controller_eliminar_oficina($data);
            echo $response;
        }
    }

}

if (isset($_POST['registro_oficina'])) {
    $res = new ajax_oficina();
    $res->accion = $_POST['registro_oficina'];
    $res->nombre = $_POST['nombre_oficina'];
    $res->idsede = $_POST['id_sede'];
    $res->ajax_registrar_oficina();
}

//listar
if (isset($_POST['lista_oficina'])) {
    $res = new ajax_oficina;
    $res->accion = $_POST['lista_oficina'];
    $res->ajax_listar_ofina();
    
}
//listar select sede oficina
if (isset($_POST['listar_sede_oficina'])) {
    $res = new ajax_oficina;
    $res->accion = $_POST['listar_sede_oficina'];
    $res->ajax_select_sede();
    
}
//eliminar
if (isset($_POST['eliminar_oficina'])) { //
    $res = new ajax_oficina();
    $res->accion = $_POST['eliminar_oficina']; //accion= 'te quirerop',
    $res->id = $_POST['id_ofi'];
    $res->ajax_eliminar_oficina();
    
}
