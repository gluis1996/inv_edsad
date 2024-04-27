<?php
require_once ('../Model/dto/onu.php');
class autorizar {

     private $variable;
     private $orden;

     public function __construct(onu $onu, orden $orden)
     {
          $this->variable = $onu;
          $this->orden = $orden;
     }


     public function registrar_ftth(){
          //validar campos vacios.
          $campos = $this->validarcamposvaciosOrden();          
          $validarVlanSite = $this->validarVlanSite();
          $validarExistencia_Radius = $this->validarExistencia_Radius();
          $validarautorizacionOnu = $this->validarautorizacionOnu();

          if ($campos) {
               return 'Error en registrar: '.$campos;
          }
     
          //contar cantidad de nodos.
          $partes = explode('@',$this->orden->Nodo);
          $parte2 = $partes[1];
          $cant = strlen($parte2);

          if ($cant != 8) {
          return 'Error en el nodo verfique, menor o mayor a 8 digitos despues del @'; 
          }
          
          if ($validarVlanSite!==true) {
               return $validarVlanSite;
          }

          // if ($validarExistencia_Radius!==true) {
          //      return $validarExistencia_Radius;
          // }

          //registro en radius en caso sea el registro en SmartOLT
          if ($this->variable->TipoOLT == 'SmartOLT') {
               
               if ($validarautorizacionOnu!==true) {
                    return $validarautorizacionOnu;
               }

               $api_autorizar = new autorizaronu($this->variable);
               $res_api_autorizar = $api_autorizar->autorisar();
          
               if ($res_api_autorizar != 'ok') {
                    return 'Error en Autorizar : '. $res_api_autorizar;
               }else{
                    $registroRadius =$this->registroRadius();
                    return $registroRadius;
               }
          }//registro a radius en caso sea el registro en FIBERHOME
          else if($this->variable->TipoOLT == 'FiberHome'){
               $registroRadius =$this->registroRadius();
               return $registroRadius;
          }
     }

     //funcion para registrar instalacion EoC
     public function registrarEoC(){
          
          //Obtener el tiempo de registro
          date_default_timezone_set('America/Lima');
          $fecha = date('Y-m-d H:i:s');
          $fechaactual = $fecha;


          $data = array(
               'filial' => $this->orden->FILIAL,
               'os' => $this->orden->os,
               'operador' => $this->orden->operador,
               'abonado' => $this->orden->codAbonado,
               'nodo' => $this->orden->Nodo,
               'vlan' => $this->variable->vlan,
               'mac' => $this->orden->mac,
               'speed' => $this->variable->upload_speed_profile_name,
               'coordenada' => $this->orden->coordenadas,
               'fecha' => $fechaactual
          );

          // return json_encode($data);

          // $response = $this->registroRadius_2();
          // return $response;
          $response = registrarOrden::registrar_InstalacionEoC($data);
          if ($response != 'ok') {
               return $response;
          }else{
               return 'ok';
          }
     }

     //funcion que verifica que los campos esten completos o llenos FTTH
     public function validarcamposvaciosOrden(){

          if ($this->orden->operador =='') {
               return 'Operador Vacio';
          }
          if ($this->orden->FILIAL =='') {
               return 'FILIAL Vacio';
          }
          if ($this->orden->os =='') {
               return 'Orden de trabajo Vacio';
          }
          if ($this->orden->codAbonado =='') {
               return 'codAbonado Vacio';
          }
          if ($this->orden->Nodo =='') {
               return 'Nodo Vacio';
          }
          if ($this->orden->caja =='') {
               return 'caja Vacio';
          }
          if ($this->orden->borne =='') {
               return 'borne Vacio';
          }
          if ($this->orden->precinto =='') {
               return 'precinto Vacio';
          }
          if ($this->orden->mac =='') {
               return 'Mac Vacio';
          }
     }


     //funcion que verifica que los campos esten completos o llenos EoC
     public function validarcamposvaciosOrdenEoC(){

          if ($this->orden->operador =='') {
               return 'Operador Vacio';
          }
          if ($this->orden->FILIAL =='') {
               return 'FILIAL Vacio';
          }
          if ($this->orden->os =='') {
               return 'Orden de trabajo Vacio';
          }
          if ($this->orden->codAbonado =='') {
               return 'codAbonado Vacio';
          }
          if ($this->orden->Nodo =='') {
               return 'Nodo Vacio';
          }
          if ($this->orden->caja =='') {
               return 'caja Vacio';
          }
          if ($this->orden->borne =='') {
               return 'borne Vacio';
          }
          if ($this->orden->precinto =='') {
               return 'precinto Vacio';
          }
          if ($this->orden->mac =='') {
               return 'Mac Vacio';
          }
     }

     //funcion que realiza el registro en el servidor Radius
     public function registroRadius(){
          
          //Obtener el tiempo de registro
          date_default_timezone_set('America/Lima');
          $fecha = date('Y-m-d H:i:s');
          $fechaactual = $fecha;

          //insertar en radius
          $res = new radius($this->variable,$this->orden);
          $response = $res->buscargrupo();
          $grupo = $response[0]["grupo"];
          //arreglo para insertar al userinfo
          $userinfo = array(
               'username' => $this->variable->name,
               'creationdate' => $fechaactual,
               'creationby' => 'administrator',
               'updatedate' => $fechaactual
          );
          //arreglo para insertar al radcheck
          $radcheck = array(
               'username' => $this->variable->name,
               'attribute' => 'Cleartext-Password',
               'op' => ':=',
               'value' => $this->orden->mac
          );
          //insersion a la tabla radusergroup
          $radusergroup = array(
               'username' => $this->variable->name,
               'groupname' => $grupo,
               'priority' => '1'
          );
          //insersion a la tabla userinfo
          $info =radius::registrar_userinfo($userinfo);
          
          if ($info == 'ok') {
               //insersion a la tabla radcheck
               $check = radius::registrar_radcheck($radcheck);
                    if ($check == 'ok') {
                         //insersion a la tabla usergroup
                         $usergroup=radius::registrar_radusergroup($radusergroup);
                         if ($usergroup == 'ok') {
                              //registro en la base de datos local
                              //registro en la base de datos local
                              if ($this->variable->TipoOLT == 'SmartOLT') {
                                   $dat = array(
                                        'operador' => $this->orden->operador,
                                        'FILIAL' => $this->orden->FILIAL,
                                        'os' => $this->orden->os,
                                        'codAbonado' => $this->orden->codAbonado,
                                        'Nodo' => $this->orden->Nodo,
                                        'caja' => $this->orden->caja,
                                        'borne' => $this->orden->borne,
                                        'precinto' => $this->orden->precinto,
                                        'mac' => $this->variable->onu_external_id
                                   );
                              }else if($this->variable->TipoOLT == 'FiberHome'){
                                   $dat = array(
                                        'operador' => $this->orden->operador,
                                        'FILIAL' => $this->orden->FILIAL,
                                        'os' => $this->orden->os,
                                        'codAbonado' => $this->orden->codAbonado,
                                        'Nodo' => $this->orden->Nodo,
                                        'caja' => $this->orden->caja,
                                        'borne' => $this->orden->borne,
                                        'precinto' => $this->orden->precinto,
                                        'mac' => $this->orden->mac
                                   );
                              }


                              //$registrar_orden_db = new registrarOrden($this->orden);
                              //$res_registrar_orden_db = registrarOrden::registrar($dat);
                              $res_registrar_orden_db = registrarOrden::registrar($dat);
                              if ($res_registrar_orden_db != 'ok') {
                                   return 'Error en registrar en la BD : ' .$res_registrar_orden_db;
                              }else {
                                   return 'ok';
                              }
                         }else {
                              return 'Error al registrar en radusergroup: ' . $usergroup;
                         }
                    }else {
                         return 'Error al registrar en radcheck: ' . $check;
                    }
          } else {
               return 'Error al registrar en userinfo: ' . $info;
          }


     }


     //funcion que valida la integridad de los datos con respecto a la Vlan Site y Megas
     public function validarVlanSite(){

          $filial = $this->orden->FILIAL;
          $megas = $this->variable->download_speed_profile_name;
          $rad = new radius($this->variable);
          $response1= $rad->buscargrupo();           
          
          if ($response1 != null) {
               $id_filial  = $response1[0]["id_filial"];  
               $grupo = $response1[0]["grupo"];
               $datos = $response1[0]["datos"];  
               if ($filial != $id_filial) {
                    return 'No concuerda La filial con el Vlan';
               }else {
                    
                    if ($megas != $datos) {
                         return 'La velocidad no Existe';
                    }else {
                         $response = radius::buscar_perfil($grupo);
                         if ($response != null) {
                              //retorna true si la validacion es correcta
                              return true;
                         }else{
                              return 'Datos no Existe o no coinciden';
                         }
                    }
               }  
          }else {
               return 'la Vlan o Plan no Existen verifique';
          }

     }


     //funcion que verificara la integridad de los datos en la base de de datos radius
     public function validarExistencia_Radius(){

          $codigo = $this->orden->codAbonado;
          $nodo = $this->variable->name;
          $response = radius::buscar_userinfo($codigo);

          if ($response != null) {
               $valor = $response[0]['username'];
               $posicion_arroba = strpos($valor, '@');
               $posicion_arroba_name = strpos($nodo,'@');

               $cuatrovaloresnodo = substr($nodo,$posicion_arroba_name+1,4);
               $nuevonodo = $codigo.'@'.$cuatrovaloresnodo;
               if ($posicion_arroba !== false) {
                    // Obtener los 4 dígitos después del '@'
                    $cuatro_primeros_digitos = substr($valor, $posicion_arroba + 1, 4);
                    // Imprimir el resultado
                    $coincidencia = $codigo."@" . $cuatro_primeros_digitos;
               } else {
                    return "El símbolo '@' no fue encontrado en la cadena.";
               }
               if ($nuevonodo == $coincidencia) {
                    return 'Encontramos una coincidencia con en los codigos en el Radius';
               }
          }else {
               //retorna true si no existe una duplicidad de codigo en el Radius
               return true;
          }

     }

     //funcion que verificara la si la onu ya esta auotorizada o no.

     public function validarautorizacionOnu(){

          $sn = $this->variable->sn;
          $response = consulApi::existecniaOnu($sn);

          if ($response != true) {
               //retorna true si la SN no esta autorizada.
               return true;
          }else {
               return 'Ya se encuentra autorizado';
          }


     }


     public function registroRadius_2(){
          
          //Obtener el tiempo de registro
          // date_default_timezone_set('America/Lima');
          // $fecha = date('Y-m-d H:i:s');
          // $fechaactual = $fecha;
     
          //insertar en radius
          $res = new radius($this->variable,$this->orden);
          $response = $res->buscargrupo();
          $grupo = $response[0]["grupo"];
          return $grupo;
          // //arreglo para insertar al userinfo
          // $userinfo = array(
          //      'username' => $this->variable->name,
          //      'creationdate' => $fechaactual,
          //      'creationby' => 'administrator',
          //      'updatedate' => $fechaactual
          // );
          // //arreglo para insertar al radcheck
          // $radcheck = array(
          //      'username' => $this->variable->name,
          //      'attribute' => 'Cleartext-Password',
          //      'op' => ':=',
          //      'value' => $this->orden->mac
          // );
          // //insersion a la tabla radusergroup
          // $radusergroup = array(
          //      'username' => $this->variable->name,
          //      'groupname' => $grupo,
          //      'priority' => '1'
          // );
          
     
     
     }





}

