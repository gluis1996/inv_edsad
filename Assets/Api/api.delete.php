<?php

class deleteOnu{

    public static function desauorisaronu($id){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://.API_URL./api/onu/delete/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'X-Token:' .TOKEN
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      $response = json_encode($response);

      if ($response['status']== true) {
          return 'delete';
      }else{
          return 'no_delete';
      }
        

    }

}