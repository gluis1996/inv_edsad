<?php

require_once('../../Controllers/Contorller.adquisicion.php');


require_once('../../Model/Modeo.adquisicion.php');

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

}

if (isset($_POST['ad_listar'])) {
    $res = new ajax_adquisicion();
    $res->accion=$_POST['ad_listar'];
    $res->ajax_adquisicion_listar();
}
