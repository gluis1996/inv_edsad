<?php 
include '../config.php';
class consulApi{

public static  function fetch_olts() {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cableperu.smartolt.com/api/system/get_olts',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-Token: 94a045a449a24da39dd0d2830bde23d6'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data['response']; // Devolver solo la parte 'response'
}

public static function busquedamac($mac) {
    $olts = consulApi::fetch_olts();
    $olt_map = array_column($olts, 'name', 'id'); // Crear un mapa de OLT id => name

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://cableperu.smartolt.com/api/onu/unconfigured_onus',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'X-Token: 94a045a449a24da39dd0d2830bde23d6'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $data = json_decode($response, true);
    
    if ($data === null) {
        die("Error al decodificar la respuesta JSON");
    }
    
    $searchTerm = $mac;
    $result = array_filter($data['response'], function ($item) use ($searchTerm) {
        return substr($item['sn'], -strlen($searchTerm)) === $searchTerm;
    });

    // Agregar el nombre de la OLT al resultado
    foreach ($result as &$item) {
      if (isset($olt_map[$item['olt_id']])) {
          $item['olt_name'] = $olt_map[$item['olt_id']];
      }
  }

    //$result = array_values($result);
    
    echo json_encode($result);
}

    public static function listarZona ($zona){     
      
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cableperu.smartolt.com/api/system/get_zones',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: 94a045a449a24da39dd0d2830bde23d6'
        )
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      
      $data = json_decode($response,true);

      //$zonaExiste = false;
      foreach ($data["response"] as $id) {  
        if ($id["name"]== $zona) {
            //return $zonaExiste = true;
            return true;
            break;
        }
      }

      // if ($zonaExiste) {
      //   return true;
      // }else {
      //   self::crearzona($zona);
      // }
        return false;


    }

    public static function crearzona ($zona){
        $curl = curl_init();      
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://cableperu.smartolt.com/api/system/add_zone',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('zone' => $zona),
          CURLOPT_HTTPHEADER => array(
            'X-Token: 94a045a449a24da39dd0d2830bde23d6'
          )
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $data = json_decode($response,true);
        if (isset($data["status"])) {
            return $data["status"];
        }else {
          return false;
        }

    }
    

    public static function validaciones ($zone){
      $res = self::busquedamac($zone);
      if ($res) {
        return "existe";
      }else{
        self::crearzona($zone);
      }
    }

    //funcion que valida la existencia de una Onu

    public static function existecniaOnu($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/get_onu_details/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $res = json_decode($response, true);
      $status = $res['status'];
      if ($status == true) {
        return true;
      }else{
        return false;
      }


    }

    public static function EstadoONU($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/get_onu_status/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $res = json_decode($response, true);
      return $res['onu_status'];
    }


    public static function todo_los_status(){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cableperu.smartolt.com/api/onu/get_onus_statuses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: 94a045a449a24da39dd0d2830bde23d6',
          'Cookie: ci_session=qapvetd6ddpebuttc04ol5fadsgcupmg'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      // Decodificar el JSON en un array asociativo de PHP
      $data = json_decode($response, true);
      return $data;

    }

    public static function todo_los_catv_status(){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cableperu.smartolt.com/api/onu/get_onus_catv_statuses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: 94a045a449a24da39dd0d2830bde23d6',
          'Cookie: ci_session=o96h38dv8a7nq5sqo7p7dk52do6rv0go'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      // Decodificar el JSON en un array asociativo de PHP
      $data = json_decode($response, true);
      return $data;

    }

    public static function niveles($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/get_onu_signal/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $res = json_decode($response, true);
      return $res['onu_signal_1490'];
    }



    public static function estadoCatv($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/get_onu_catv_status/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $res = json_decode($response, true);
      return $res['onu_catv_status'];
    }


    public static function desabiliatrCatv($sn) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/disable_catv/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
        $res = json_decode($response, true);
        return $res['response_code'];
    }
    public static function habilitarCatv($sn) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/enable_catv/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
      
        $res = json_decode($response, true);
        return $res['response_code'];
    }

    public static function resicronizar($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.API_URL.'/api/onu/resync_config/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $res = json_decode($response, true);
      return $res['response_code'];
    }

    public static function desabilitar_habilitar($estado, $sn){
      if ($estado == 'activo') {
        $res1 =   self::desabiliatrCatv($sn);
        $res2 =   self::resicronizar($sn);

        if ($res1 == 'success' || $res2 == 'success') {
          return 'succes';
        }

        //return 'se va desabiliar';
      }
      
      if ($estado == 'desactivo') {
        $res1 =   self::habilitarCatv($sn);
        $res2 =   self::resicronizar($sn);

        if ($res1 == 'success' || $res2 == 'success') {
          return 'succes';
        }

        //return 'se va habilitar';
      }
    }


    public static function Detalle_Onu($sn){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cableperu.smartolt.com/api/onu/get_onus_details_by_sn/'.$sn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Token: '.TOKEN
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $data = json_decode($response, true);

      // Obtener la información de la VLAN
      $vlan = $data['onus'][0]['vlan'];
      return $vlan;

    }

  }