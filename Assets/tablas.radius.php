<?php

require_once ('../Model/dao.registrarOrden.php');
require_once ('../Model/Modelo.perfiles.php');
require_once ('../Model/radius.registrar.php');
require_once ('Api/api.cosultas.php');
//require_once ('lib/routeros-api/consultas.api.php');

class tablas_radius{

    public $radcheck;
    public $username;
    public $av_cambiodeplan;
    public $av_user;
    public $groupname;
    public $iduser;
    public $mac;
    public $actualizarCatv;
    public $estado;
    public $ba_abonado;
    public $ba_abonado_mac;
    public $ba_abonado_nodo;
    public $pg_ce_abn_onu;
    public $filial;
    public $tipo;

    public function tr_radcheck(){
        if ($this->radcheck == 'radcheck') {
            if ($this->radcheck == 'radcheck') {
                if ($this->username != null) {
                    $response = radius::buscar_radcheck($this->username);
                    
                } else {
                    $response = radius::listar_radcheck();
                }
                
                $datosjason = array();
        
                if (empty($response)) {
                    $datosjason['data'][] = array(
                        "id" => "--",
                        "username" => "--",
                        "value" => "--",
                        "plan" => "--",
                        "estado" => "--",
                        "OLT" => "--",
                        "NIVELES" => "--",
                        "VLAN" => "--",
                        "CATV" => "--",
                        "acciones" => "--"
                    );
                } else {
                    foreach ($response as $item) {
                        $onuID = '';
                        $switch     =  "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                        if ($item['estado'] == 'activo') {
                            $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                        } else if ($item['estado'] == 'cortado') {
                            $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                        } else {
                            $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                        }
                        $res = radius::buscar_mac($item['username']);
                        if(count($res) == 0){
                            $valor ='no set';
                            $niveles = 'no set';
                            $nvl = 'no set';
                            $Vlan = 'no set';
                        }else{
                            $r = $res[0]['sn'];
                            $onuID = $res[0]['sn'];
                            $exito = consulApi::EstadoONU($r);
                            $nvl = consulApi::niveles($r);
                            $estadocatv = consulApi::estadoCatv($r);
                            $Vlan = consulApi::Detalle_Onu($r);
                            if (preg_match('/-?\d+\.\d+/', $nvl, $matches)) {
                                $valornumerico = floatval($matches[0]);
                            } else {
                                // Manejar el caso en el que no se encuentra ninguna coincidencia
                                $valornumerico = -50; // O cualquier valor predeterminado que desees
                            }

                            if ($exito!='Online') {
                                $valor = "<span class='badge badge-pill badge-danger'>".$exito."</span>";
                            }else {
                                $valor = "<span class='badge badge-pill badge-success'>".$exito."</span>";
                            }
                            
                            if ($valornumerico <= 22) {
                                $niveles = "<span class='badge badge-pill badge-success'>".$nvl."</span>";
                            }else {
                                $niveles = "<span class='badge badge-pill badge-danger'>".$nvl."</span>";
                            }

                            if ($estadocatv == 'Enabled') {
                                $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='activo' on_sn='".$r."' id='estdo_catv' checked><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            }else if ($estadocatv == 'Disabled') {
                                $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='desactivo' on_sn='".$r."' id='estdo_catv'><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            }
                        }

                        $botones    =  "<div class='col'><button type='button' class='btn btn-dark tbl_radcheck ' data-toggle='modal' data-target='#modal_detalle_cambioEquipo' onuID='".$onuID."' iduser='".$item['id']."' plan='".$item['plan']."' value='".$item['value']."' username='".$item['username']."'><i class='fas fa-eye'></i></button><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-warning btn_registrar_atc' data-toggle='modal' data-target='#modal_registrar_atc' username='".$item['username']."'><i class='fa fa-file' aria-hidden='true' ></i></button><button type='button' class='btn btn-danger btnEliminarRadius' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";                        
                        

                        $datosjason['data'][] = array(
                            "id" => $item['id'],
                            "username" => $item['username'],
                            "value" => $item['value'],
                            "plan" => $item['plan'],
                            "estado" => $estado_badge,
                            "OLT" => $valor,
                            "NIVELES" => $niveles,
                            "VLAN" => $Vlan,
                            "CATV" => $switch,
                            "acciones" => $botones
                        );
                    }
                }
        
                echo json_encode($datosjason);
            }
        }
    }

    public function tr_buscar_abonado_por_codigo(){
        if ($this->ba_abonado == 'ba_abonado') {
                $response = radius::buscar_por_abonado($this->username);       
                
                $datosjason = array();
        
                if ($this->tipo == 'SmartOlt') {
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                $exito = consulApi::EstadoONU($r);
                                $nvl = consulApi::niveles($r);
                                $estadocatv = consulApi::estadoCatv($r);
                                $Vlan = consulApi::Detalle_Onu($r);
                                if (preg_match('/-?\d+\.\d+/', $nvl, $matches)) {
                                    $valornumerico = floatval($matches[0]);
                                } else {
                                    // Manejar el caso en el que no se encuentra ninguna coincidencia
                                    $valornumerico = -50; // O cualquier valor predeterminado que desees
                                }
                                if ($exito!='Online') {
                                    $valor = "<span class='badge badge-pill badge-danger'>".$exito."</span>";
                                }else {
                                    $valor = "<span class='badge badge-pill badge-success'>".$exito."</span>";
                                }
                                
                                if ($valornumerico <= 22) {
                                    $niveles = "<span class='badge badge-pill badge-success'>".$nvl."</span>";
                                }else {
                                    $niveles = "<span class='badge badge-pill badge-danger'>".$nvl."</span>";
                                }
    
                                if ($estadocatv == 'Enabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='activo' on_sn='".$r."' id='".$unique_id."' checked><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }else if ($estadocatv == 'Disabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='desactivo' on_sn='".$r."' id='".$unique_id."'><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $valor,
                                "NIVELES" => $niveles,
                                "VLAN" => $Vlan,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 
                //final de if
                }else{
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            
                            $ultimacoenxion = radius::buscar_raddacct_ultima_conexion($item['username']);
                            // $utlimaip = $ultimacoenxion[0]['nasipaddress'];

                            if (isset($ultimacoenxion[0]['nasipaddress'])) {
                                $consulta_api = consultasApi::bucar_name_conexion($ultimacoenxion[0]['nasipaddress'],$item['username']);
                                $res_consulta_api = json_decode($consulta_api,true);
                                if (isset($res_consulta_api[0]['.id'])) {
                                    $idmk = $res_consulta_api[0]['.id'];
                                }else {
                                    $idmk = 'No conectado';
                                }
                            }else{
                                $idmk = 'Sin IP';
                            }



                            // $consulta_api = consultasApi::bucar_name_conexion($utlimaip);
                            // $res_consulta_api = json_decode($consulta_api,true);
                            // if (isset($res_consulta_api[0]['.id'])) {
                            //     $idmk = $res_consulta_api[0]['.id'];
                            // }else {
                            //     $idmk = 'No conectado';
                            // }
                            
                            
                            
                            
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                $text = $r;
                                $valor = "<p class='font-weight-bold'>".$text."</p>";
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $idmk,
                                "NIVELES" => $niveles,
                                "VLAN" => $Vlan,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 


                }//final del else

                echo json_encode($datosjason);         
        }
    }

    public function tr_buscar_abonado_por_mac(){
        if ($this->ba_abonado_mac == 'ba_abonado_mac') {
                $response = radius::buscar_por_abonado_por_mac($this->username);
                $datosjason = array();
                
                if ($this->tipo == 'SmartOlt') {
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                $exito = consulApi::EstadoONU($r);
                                $nvl = consulApi::niveles($r);
                                $estadocatv = consulApi::estadoCatv($r);
                                $Vlan = consulApi::Detalle_Onu($r);
                                if (preg_match('/-?\d+\.\d+/', $nvl, $matches)) {
                                    $valornumerico = floatval($matches[0]);
                                } else {
                                    // Manejar el caso en el que no se encuentra ninguna coincidencia
                                    $valornumerico = -50; // O cualquier valor predeterminado que desees
                                }
                                if ($exito!='Online') {
                                    $valor = "<span class='badge badge-pill badge-danger'>".$exito."</span>";
                                }else {
                                    $valor = "<span class='badge badge-pill badge-success'>".$exito."</span>";
                                }
                                
                                if ($valornumerico <= 22) {
                                    $niveles = "<span class='badge badge-pill badge-success'>".$nvl."</span>";
                                }else {
                                    $niveles = "<span class='badge badge-pill badge-danger'>".$nvl."</span>";
                                }
    
                                if ($estadocatv == 'Enabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='activo' on_sn='".$r."' id='".$unique_id."' checked><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }else if ($estadocatv == 'Disabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='desactivo' on_sn='".$r."' id='".$unique_id."'><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $valor,
                                "NIVELES" => $niveles,
                                "VLAN" => $Vlan,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 
                //final de if
                }else{
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                $text = $r;
                                $valor = "<p class='font-weight-bold'>".$text."</p>";
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $valor,
                                "NIVELES" => $niveles,
                                "VLAN" => $Vlan,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 


                }//final del else

                echo json_encode($datosjason);          
        }
    }

    public function tr_buscar_abonado_por_nodo(){
        if ($this->ba_abonado_nodo == 'ba_abonado_nodo') {
                $response = radius::buscar_por_abonado_por_nodo($this->username);       
                //$ultimacoenxion = radius::listar_toda_raddacct_ultima_conexion();
                $datosjason = array();
        
                if (count($response) >= 1) {
                    $ultimacoenxion = radius::listar_toda_raddacct_ultima_conexion();
                }


                if ($this->tipo == 'SmartOlt') {
                    $stados = consulApi::todo_los_status();
                    $stadoscatv = consulApi::todo_los_catv_status();
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            $nasportid = $this->buscarNasportid($ultimacoenxion, $item['username']);
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                // $exito = consulApi::EstadoONU($r);
                                // $nvl = consulApi::niveles($r);
                                // $estadocatv = consulApi::estadoCatv($r);
                                // $Vlan = consulApi::Detalle_Onu($r);

                                $exito  = $this->buscarStatusOnu($stados, $r);

                                $estadocatv  = $this->buscar_Catv_nOnu($stadoscatv, $r);

                                // if (preg_match('/-?\d+\.\d+/', $nvl, $matches)) {
                                //     $valornumerico = floatval($matches[0]);
                                // } else {
                                //     // Manejar el caso en el que no se encuentra ninguna coincidencia
                                //     $valornumerico = -50; // O cualquier valor predeterminado que desees
                                // }
                                if ($exito!='Online') {
                                    $valor = "<span class='badge badge-pill badge-danger'>".$exito."</span>";
                                }else {
                                    $valor = "<span class='badge badge-pill badge-success'>".$exito."</span>";
                                }
                                
                                // if ($valornumerico <= 22) {
                                //     $niveles = "<span class='badge badge-pill badge-success'>".$nvl."</span>";
                                // }else {
                                //     $niveles = "<span class='badge badge-pill badge-danger'>".$nvl."</span>";
                                // }
    
                                if ($estadocatv == 'Enabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='activo' on_sn='".$r."' id='".$unique_id."' checked><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }else if ($estadocatv == 'Disabled') {
                                    $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' estado='desactivo' on_sn='".$r."' id='".$unique_id."'><label class='form-check-label' for='flexSwitchCheckDefault'></label><div class='loader' style='display: none;'><i class='fas fa-spinner fa-spin'></i></div></div>";
                                }
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $valor,
                                "NIVELES" => $niveles,
                                "VLAN" => $nasportid,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 
                //final de if
                }else{
                    if (empty($response)) {
                        $datosjason['data'][] = array(
                            "id" => "--",
                            "username" => "--",
                            "value" => "--",
                            "plan" => "--",
                            "estado" => "--",
                            "OLT" => "--",
                            "NIVELES" => "--",
                            "VLAN" => "--",
                            "CATV" => "--",
                            "acciones" => "--"
                        );
                    } else {
                        foreach ($response as $item) {
                            $unique_id = "estdo_catv_1_" . $item['id'];
                            $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' data-toggle='modal' data-target='#modal_listado_consumo' username='".$item['username']."'><i class='fa fa-rss'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id_username='".$item['id']."' deleteusername='".$item['username']."'><i class='fa fa-trash'></i></button></div>";
                            $res = radius::buscar_mac($item['username']);
                            $switch = "<div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'></label></div>";
                            
                            $nasportid = $this->buscarNasportid($ultimacoenxion, $item['username']);

                            // $utlimaip = $ultimacoenxion[0]['nasipaddress'];
                            $idmk = 'Sin IP';
                            
                            
                            
                            
                            if ($item['estado'] == 'activo') {
                                $estado_badge = "<span class='badge badge-pill badge-success'>".$item['estado']."</span>";
                            } else if ($item['estado'] == 'cortado') {
                                $estado_badge = "<span class='badge badge-pill badge-danger'>".$item['estado']."</span>";
                            } else {
                                $estado_badge = "<span class='badge badge-pill badge-secondary'>".$item['estado']."</span>"; // Otros estados
                            }
                            if(count($res) == 0){
                                $valor ='no set';
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }else{
                                $r = $res[0]['sn'];
                                $text = $r;
                                $valor = "<p class='font-weight-bold'>".$text."</p>";
                                $niveles = 'no set';
                                $nvl = 'no set';
                                $Vlan = 'no set';
                            }
    
    
                            $datosjason['data'][] = array(
                                "id" => $item['id'],
                                "username" => $item['username'],
                                "value" => $item['value'],
                                "plan" => $item['plan'],
                                "estado" => $estado_badge,
                                "OLT" => $valor,
                                "NIVELES" => $niveles,
                                "VLAN" => $nasportid,
                                "CATV" => $switch,
                                "acciones" => $botones
                            );
                        }
                    } 


                }//final del else

                echo json_encode($datosjason);     
        }
    }

    public function buscarNasportid($lista_completa, $username) {
        foreach ($lista_completa as $registro) {
            if ($registro['username'] === $username) {
                return $registro['nasportid'];
            }
        }
        // Si no se encuentra el username, devolver un valor predeterminado o manejar el caso según sea necesario
        return "--";
    }

    public function buscarStatusOnu($lista_completa, $sn) {
        // Verificar si la lista está vacía
        if (!empty($lista_completa['response'])) {
            // Iterar sobre la lista de dispositivos
            foreach ($lista_completa['response'] as $dispositivo) {
                // Verificar si el número de serie coincide
                if ($dispositivo['sn'] === $sn) {
                    // Devolver el estado del dispositivo
                    return $dispositivo['status'];
                }
            }
        }
        // Si no se encuentra el username, devolver un valor predeterminado o manejar el caso según sea necesario
        return "no set";
    }

    public function buscar_Catv_nOnu($lista_completa, $sn) {
        // Verificar si la lista está vacía
        if (!empty($lista_completa['response'])) {
            // Iterar sobre la lista de dispositivos
            foreach ($lista_completa['response'] as $dispositivo) {
                // Verificar si el número de serie coincide
                if ($dispositivo['sn'] === $sn) {
                    // Devolver el estado del dispositivo
                    return $dispositivo['catv_status'];
                }
            }
        }
        // Si no se encuentra el username, devolver un valor predeterminado o manejar el caso según sea necesario
        return "no set";
    }


    public function av_actualizarplan(){
        if ($this->av_cambiodeplan == 'av_cambiodeplan') {
            $response = radius::update_radgroupreply($this->groupname, $this->av_user);
            $response2 = radius::update_radcheck($this->mac, $this->iduser);
            if ($response == 'ok' || $response2 == 'ok') {
                echo 'ok';
            }else {
                echo 'fallo';
            }
        }
    }


    public function actualizarCatv(){
        if ($this->actualizarCatv == 'actualizarCatv') {
            
                $response = consulApi::desabilitar_habilitar($this->estado,$this->mac);
                echo $response;

        }
    }


    public function registrar_onsn(){
        if ($this->pg_ce_abn_onu == 'pg_ce_abn_onu') {
            
                $response = consulApi::desabilitar_habilitar($this->estado,$this->mac);
                echo $response;

        }
    }

}


if (isset($_POST['radcheck'])) {
    $tabla = new tablas_radius();
    $tabla->radcheck = $_POST['radcheck'];
    $tabla->username = $_POST['username'];
    $tabla->tr_radcheck();
}

//-bucar por codigo de abonado
if (isset($_POST['ba_abonado'])) {
    $tabla = new tablas_radius();
    $tabla->ba_abonado = $_POST['ba_abonado'];
    $tabla->username = $_POST['username'];
    $tabla->tipo = $_POST['tipo'];
    $tabla->tr_buscar_abonado_por_codigo();
}

//-bucar por codigo por mac
if (isset($_POST['ba_abonado_mac'])) {
    $tabla = new tablas_radius();
    $tabla->ba_abonado_mac = $_POST['ba_abonado_mac'];
    $tabla->username = $_POST['username'];
    $tabla->tipo = $_POST['tipo'];
    $tabla->tr_buscar_abonado_por_mac();
}


//-bucar por codigo por nodo
if (isset($_POST['ba_abonado_nodo'])) {
    $tabla = new tablas_radius();
    $tabla->ba_abonado_nodo = $_POST['ba_abonado_nodo'];
    $tabla->username = $_POST['username'];
    $tabla->tipo = $_POST['tipo'];
    $tabla->tr_buscar_abonado_por_nodo();
}

//actualziar plan
if (isset($_POST['av_cambiodeplan'])) {
    $res = new tablas_radius();
    $res->av_cambiodeplan=$_POST['av_cambiodeplan'];
    $res->av_user=$_POST['av_user'];
    $res->groupname=$_POST['groupname'];
    $res->iduser=$_POST['iduser'];
    $res->mac=$_POST['mac'];
    $res->av_actualizarplan();
  }


  //actualziar catv
if (isset($_POST['actualizarCatv'])) {
    $res = new tablas_radius();
    $res->actualizarCatv=$_POST['actualizarCatv'];
    $res->mac=$_POST['sn'];
    $res->estado=$_POST['estado'];
    $res->actualizarCatv();
  }

  //actualziar ons sn
if (isset($_POST['pg_ce_abn_onu'])) {
    $res = new tablas_radius();
    $res->pg_ce_abn_onu=$_POST['pg_ce_abn_onu'];
    $res->username= $_POST['username'];
    $res->mac=$_POST['valor_onu_id'];
    $res->filial=$_POST['filial'];
    $res->actualizarCatv();
  }