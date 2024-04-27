<?php

class gestion_radius{


    public static function delete_user($username){
        
        if ($username == '') {
            return 'Campo vacio verifique el codigo';
        }else {
            //return $username;
            $response = radius::delete_username('radusergroup',$username);
            $response1 = radius::delete_username('radcheck',$username);
            $response2 = radius::delete_username('userinfo',$username);

            if ($response == 'ok' && $response1 == 'ok' && $response2 == 'ok') {
                return 'ok';
            }else{
                return 'fallo';
            }

        }


    }



}