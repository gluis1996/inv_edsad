<?php

require_once('../../Controllers/Contorller.adquisicion.php');
require_once('../../Controllers/Controller.beneficiario.php');
require_once('../../Controllers/Controller.area.php');
require_once('../../Controllers/controller.meta.php');
require_once('../../Controllers/Controller.equipo.php');


require_once('../../Model/Modeo.adquisicion.php');
require_once('../../Model/Modelo.beneficiario.php');
require_once('../../Model/Modelo.area.php');
require_once('../../Model/Modelo.meta.php');
require_once('../../Model/Modelo.equipo.php');

class ajax_adquisicion{

    public $accion;
    public $id;

    public function ajax_adquisicion_listar(){
        if ($this->accion=='ad_listar') {
            $response = controller_adquisicion::c_listar();
            $json = array();

            if (empty($response)) {
                $json['data'][]= array(
                    'id'=>'-',
                    'area_nombre'=>'-',
                    'beneficiario_nombre'=>'-',
                    'equipo'=>'-',
                    'meta_nombre'=>'-',
                    'año'=>'-',
                    'cantidad'=>'-',
                    'accion'=>'-',
                );
            }else {
                foreach ($response as $value) {
                    $json['data'][]= array(
                        'id'=> $value['id'],
                        'area_nombre'=>$value['area_nombre'],
                        'beneficiario_nombre'=> $value['beneficiario_nombre'],
                        'equipo'=>$value['equipo'],
                        'meta_nombre'=>$value['meta_nombre'],
                        'año'=>$value['año'],
                        'cantidad'=>$value['cantidad'],
                        'accion'=> '--'
                    );
                }
            }
            echo json_encode($json);

        }
    }


    public function ajax_adquisicion_beneficiario(){
        if ($this->accion == 'ad_beneficiario') {
            $response = controller_beneficiario::controller_listar();
            echo json_encode($response);
        }
    }
    public function ajax_adquisicion_area(){
        if ($this->accion == 'ad_area') {
            $response = controller_area::c_listar();
            echo json_encode($response);
        }
    }
    public function ajax_adquisicion_meta(){
        if ($this->accion == 'ad_meta') {
            $response = controller_meta::controller_listar();
            echo json_encode($response);
        }
    }
    public function ajax_adquisicion_equipo(){
        if ($this->accion == 'ad_equipo') {
            $response = controller_equipo::c_listar();
            echo json_encode($response);
        }
    }

}///final clase

if (isset($_POST['ad_listar'])) {
    $res = new ajax_adquisicion();
    $res->accion=$_POST['ad_listar'];
    $res->ajax_adquisicion_listar();
}

if (isset($_POST['ad_beneficiario'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_beneficiario'];
    $res->ajax_adquisicion_beneficiario();
}

if (isset($_POST['ad_area'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_area'];
    $res->ajax_adquisicion_area();
}

if (isset($_POST['ad_equipo'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_equipo'];
    $res->ajax_adquisicion_equipo();
}

if (isset($_POST['ad_meta'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_meta'];
    $res->ajax_adquisicion_meta();
}