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
    public $area;
    public $beneficiario;
    public $equipo;
    public $meta;
    public $añoadquisicion;
    public $cantidad;

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
                    $unique_id = "id_adquisicion_" . $value['id'];
                    $elimianr_id = "id_eliminar_" . $value['id'];
                    $botones = "<div class='col'><button type='button' class='btn btn-primary' id ='".$unique_id."' id_adquisicion_buscar='".$value['id']."' data-toggle='modal' data-target='#modal_adquisicion_editar'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_detalle_asignacion' id='".$elimianr_id."' id_adquisicion_eliminar='".$value['id']."'><i class='fas fa-trash-alt'></i></button></div>";
                    
                    $json['data'][]= array(
                        'id'=> $value['id'],
                        'area_nombre'=>$value['area_nombre'],
                        'beneficiario_nombre'=> $value['beneficiario_nombre'],
                        'equipo'=>$value['equipo'],
                        'meta_nombre'=>$value['meta_nombre'],
                        'año'=>$value['año'],
                        'cantidad'=>$value['cantidad'],
                        'accion'=> $botones
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

    public function ajax_adquisicion_registrar(){
        if ($this->accion == 'ad_registrar') {
            $data = array(
                'p_id_area_usuaria' => $this->area,
                'p_idbeneficiario' => $this->beneficiario,
                'p_idequipos' => $this->equipo,
                'p_idmeta' => $this->meta,
                'p_anio_aquisicion' => $this->añoadquisicion,
                'p_cantidad' => $this->cantidad
            );

            $response = controller_adquisicion::c_registrar($data);
            echo $response;

        }
    }

    public function ajax_adquisicion_eliminar(){
        if ($this->accion == 'ad_eliminar') {
            $response = controller_adquisicion::c_eliminar($this->id);
            echo $response;
        }
    }

    public function ajax_adquisicion_buscar(){
        if ($this->accion == 'ad_buscar') {
            $response = controller_adquisicion::c_buscar($this->id);
            echo json_encode($response);
        }
    }

    public function ajax_adquisicion_editar(){
        if ($this->accion == 'ad_editar') {
            $data = array(
                'p_id_detalle_aquisicion'=>$this->id,
                'p_id_area_usuaria'=>$this->area,
                'p_idbeneficiario'=>$this->beneficiario,
                'p_idequipos'=>$this->equipo,
                'p_idmeta'=>$this->meta,
                'p_anio_aquisicion'=>$this->añoadquisicion,
                'p_cantidad'=>$this->cantidad
            );
            $response = controller_adquisicion::c_editar($data);
            echo $response;
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


////REGISTRAR ADQUISICION:


if (isset($_POST['ad_registrar'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_registrar'];
    $res->area = $_POST['ad_area'];
    $res->beneficiario = $_POST['ad_beneficiario'];
    $res->equipo = $_POST['ad_equipo'];
    $res->meta = $_POST['ad_meta'];
    $res->añoadquisicion = $_POST['ad_año'];
    $res->cantidad = $_POST['ad_cantidad'];
    $res->ajax_adquisicion_registrar();
}


////ELIMINAR ADQUISICION

if (isset($_POST['ad_eliminar'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_eliminar'];
    $res->id = $_POST['id_ad_eliminar'];
    $res->ajax_adquisicion_eliminar();
}

////BUSCAR
if (isset($_POST['ad_buscar'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_buscar'];
    $res->id = $_POST['id_ad_buscar'];
    $res->ajax_adquisicion_buscar();
}

//EDITAR

if (isset($_POST['ad_editar'])) {
    $res = new ajax_adquisicion();
    $res->accion = $_POST['ad_editar'];
    $res->id = $_POST['ad_editar_id'];
    $res->area = $_POST['ad_editar_area'];
    $res->beneficiario = $_POST['ad_editar_bene'];
    $res->equipo = $_POST['ad_editar_equipo'];
    $res->meta = $_POST['ad_editar_meta'];
    $res->añoadquisicion = $_POST['ad_editar_fecha'];
    $res->cantidad = $_POST['ad_editar_cantidad'];
    $res->ajax_adquisicion_editar();
}
