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
//SEDE
    public function ajax_registrar_sede()
    {
        if ($this->accion == 'registroSede') {
           $data = array(
            'nombre_sede' =>$this->nombre
           );
        }
        $response  = controller_oficina::controller_agregar_sede($data);
        echo $response;
    }
    
    public function ajax_listar_sede(){
        if ($this->accion=='listasede') {
           $response = controller_oficina::controller_listar_sede();
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
            $response = controller_oficina::controller_eliminar_sede($data);
            echo $response;
        }
    }



//OFICINA
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

    public function ajax_listar_area_usu(){
        if ($this->accion=='listarAU') {
           $response = controller_oficina::controller_listar_area_usuaria();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idAreaU" => "--",
                    "nombreusuaria" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_mt='".$value['id_area_usuaria']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_empleado' id_meta_ls='".$value['id_area_usuaria']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idAreaU" => $value['id_area_usuaria'],
                        "nombreusuaria" =>  $value['nombres'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

}
//registrar SEDE
if (isset($_POST['registro_sede'])) {
    $res = new ajax_oficina();
    $res->accion = $_POST['registro_sede'];
    $res->nombre = $_POST['nombrexsede'];
    $res->ajax_registrar_sede();
}
//listar SEDE
if (isset($_POST['lista_sede'])) {
    $res = new ajax_oficina();
    $res->accion = $_POST['lista_sede'];
    $res->ajax_listar_sede();
    
}

//eliminar SEDE
if (isset($_POST['eliminar_sede'])) { //
    $res = new ajax_oficina();
    $res->accion = $_POST['eliminar_sede']; //accion= 'te quirerop',
    $res->id = $_POST['idsede'];
    $res->ajax_eliminar_sede();
    
}
//////////////////////////////////////////////////////////////////////////
//REGISTRAR OFICINA
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

//listar area usuaria
//listar
if (isset($_POST['listar_area_usuaria'])) {
    $res = new ajax_oficina();
    $res->accion = $_POST['listar_area_usuaria'];
    $res->ajax_listar_area_usu();
    
}