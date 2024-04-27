<?php

require_once ('../Model/dto/onu.php');

class autorizaronu {

public $variable;
  
    public function __construct(onu  $variable)
    {
      $this->variable=$variable; 
    }

    public  function autorisar(){
        $res = $this->validarVLan();
        $res1 = $this->ValidarMegas();
        consulApi::validaciones($this->variable->zone);
      if ($res != false and $res1!= false) {
      
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://cableperu.smartolt.com/api/onu/authorize_onu',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'olt_id' => $this->variable->olt_id
            ,'pon_type' => $this->variable->pon_type
            ,'board' => $this->variable->board
            ,'port' => $this->variable->port
            ,'sn' => $this->variable->sn
            ,'vlan' => $this->variable->vlan
            ,'onu_type' => $this->variable->onu_type
            ,'zone' => $this->variable->zone
            ,'name' => $this->variable->name
            ,'onu_mode' => $this->variable->onu_mode
            ,'onu_external_id' => $this->variable->onu_external_id
            ,'upload_speed_profile_name'=> $this->variable->upload_speed_profile_name
            ,'download_speed_profile_name'=> $this->variable->download_speed_profile_name
            ,'address_or_comment' => $this->variable->address_or_comment),
          CURLOPT_HTTPHEADER => array(
            'X-Token: 94a045a449a24da39dd0d2830bde23d6'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        //echo $data;

        if ($data['status'] == true){
          return 'ok';
        }else {
          return 'fallo';
        }

        //echo $response.'+++'.$this->variable->upload_speed_profile_name;
        
      }else{
        if 
        ($res == false) {
          return 'Verifique la VLAN';
        }else if ($res1 == false) {
          return 'Verifique los MB';
        }
      }     

    
    }
//VALIDAR LAS VLAN CORRECTAS
    public function validarVLan(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://cableperu.smartolt.com/api/olt/get_vlans/'.$this->variable->olt_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Token: 94a045a449a24da39dd0d2830bde23d6',
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        $vlan = json_decode($response,true);
        $valorEncontrado = false;
        foreach ($vlan['response'] as $value) {
            if ($value['vlan']== $this->variable->vlan) {
              $valorEncontrado = true;
              break;
            }
        }

        if ($valorEncontrado) {
          return  true;
      } else {
          return  false;
      }

    }

 //VALIDAR LAS MEGAS CORRECTAS

    public function ValidarMegas(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://cableperu.smartolt.com/api/system/get_speed_profiles',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Token: 94a045a449a24da39dd0d2830bde23d6',
          ),
        ));
        
        $responsemb = curl_exec($curl);
        
        curl_close($curl);
        

        $datamb = json_decode($responsemb,true);
        $mbregistrada = false;

        foreach ($datamb['response'] as $value) {
          if ($value['name']== $this->variable->upload_speed_profile_name) {
            $mbregistrada = true;
            break;
          }
        }

        if ($mbregistrada) {
          return true;
        } else {
          return false;
        }

    }


  
  

}