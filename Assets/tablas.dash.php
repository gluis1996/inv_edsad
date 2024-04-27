<?php 

require_once ('../Model/dao.registrarOrden.php');
require_once ('../Model/Modelo.perfiles.php');
require_once ('../Model/radius.registrar.php');
require_once ('../Model/Filial.php');
require_once ('../Model/Modelo.dash.php');

class tablasdash{

    public $dash_listar_instalacion_fo;
    public $dash_listar_instalacion_eoc;
    public $dash_atenciones;
    //LISTAR DASHBOARD

    public function dash_listar_instalacion() {
        if ($this->dash_listar_instalacion_fo == 'dash_listar_instalacion_fo') {
            $response =  ModeloDashBoard::listar_instalaciones_fibra();
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "id":"--",
                                                "fecha":"--",
                                                "operador":"--",
                                                "filial":"--",
                                                "os":"--",
                                                "abonado":"--",
                                                "codigo_abonado":"--",
                                                "caja":"--",
                                                "borne":"--",
                                                "prcinto":"--",
                                                "mac":"--",
                                                "acciones":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        //$botones = "<div class 'row'><button type='button' class='btn btn-dark btn_detale_instalacion' data-toggle='modal' data-target='#modal_detalle_instalacion' idinstalacion='".$response[$i]['id']."'><i class='fas fa-eye'></i></button></div>";
                        $datosjason.='
                            {
                                "id":"'.$response[$i]['id'].'",
                                "fecha":"'.$response[$i]['fecha'].'",
                                "operador":"'.$response[$i]['operador'].'",
                                "filial":"'.$response[$i]['filial'].'",
                                "os":"'.$response[$i]['os'].'",
                                "abonado":"'.$response[$i]['abonado'].'",
                                "codigo_abonado":"'.$response[$i]['codabonado'].'",
                                "caja":"'.$response[$i]['caja'].'",
                                "borne":"'.$response[$i]['borne'].'",
                                "precinto":"'.$response[$i]['precinto'].'",
                                "mac":"'.$response[$i]['mac'].'",
                                "acciones":"--"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

        echo $datosjason;
        }
    }

    public function dash_listar_instalacion_eoc() {
        if ($this->dash_listar_instalacion_eoc == 'dash_listar_instalacion_eoc') {
            $response =  ModeloDashBoard::listar_instalaciones_eoc();
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "id":"--",
                                                "fecha":"--",
                                                "operador":"--",
                                                "filial":"--",
                                                "os":"--",
                                                "abonado":"--",
                                                "codigo_abonado":"--",
                                                "caja":"--",
                                                "borne":"--",
                                                "prcinto":"--",
                                                "mac":"--",
                                                "acciones":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        //$botones = "<div class 'row'><button type='button' class='btn btn-dark btn_detale_instalacion' data-toggle='modal' data-target='#modal_detalle_instalacion' idinstalacion='".$response[$i]['id']."'><i class='fas fa-eye'></i></button></div>";
                        $datosjason.='
                            {
                                "id":"'.$response[$i]['id'].'",
                                "fecha":"'.$response[$i]['fecha'].'",
                                "operador":"'.$response[$i]['operador'].'",
                                "filial":"'.$response[$i]['filial'].'",
                                "os":"'.$response[$i]['os'].'",
                                "abonado":"'.$response[$i]['abonado'].'",
                                "codigo_abonado":"'.$response[$i]['codabonado'].'",
                                "mac":"'.$response[$i]['mac'].'",
                                "coordenadas":"'.$response[$i]['coordenada'].'",
                                "acciones":"--"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

        echo $datosjason;
        }
    }
    public function dash_atenciones() {
        if ($this->dash_atenciones == 'dash_atenciones') {
            $response =  ModeloDashBoard::listar_atenciones();
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "id":"--",
                                                "fecha":"--",
                                                "operador":"--",
                                                "filial":"--",
                                                "os":"--",
                                                "abonado":"--",
                                                "codigo_abonado":"--",
                                                "caja":"--",
                                                "borne":"--",
                                                "prcinto":"--",
                                                "mac":"--",
                                                "acciones":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        //$botones = "<div class 'row'><button type='button' class='btn btn-dark btn_detale_instalacion' data-toggle='modal' data-target='#modal_detalle_instalacion' idinstalacion='".$response[$i]['id']."'><i class='fas fa-eye'></i></button></div>";
                        $datosjason.='
                            {
                                "id":"'.$response[$i]['idaverias'].'",
                                "os":"'.$response[$i]['cod_orden'].'",
                                "operador":"'.$response[$i]['operador'].'",
                                "abonado":"'.$response[$i]['abonado'].'",
                                "orden":"'.$response[$i]['t_orden'].'",
                                "fecha":"'.$response[$i]['fecha'].'",
                                "area":"'.$response[$i]['area'].'",
                                "acciones":"--"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

        echo $datosjason;
        }
    }


}

if (isset($_POST['dash_listar_instalacion_fo'])) {
    $res = new tablasdash();
    $res->dash_listar_instalacion_fo =  $_POST['dash_listar_instalacion_fo'];
    $res->dash_listar_instalacion();
}


if (isset($_POST['dash_listar_instalacion_eoc'])) {
    $res = new tablasdash();
    $res->dash_listar_instalacion_eoc =  $_POST['dash_listar_instalacion_eoc'];
    $res->dash_listar_instalacion_eoc();
}

if (isset($_POST['dash_atenciones'])) {
    $res = new tablasdash();
    $res->dash_atenciones =  $_POST['dash_atenciones'];
    $res->dash_atenciones();
}