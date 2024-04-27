<?php

class controllerdelete{

    public static function c_delete($id) {
        
        if ($id == '') {
            return 'Id Vacio no Valido';
        }else {
            $response = deleteOnu::desauorisaronu($id);             
        }


        return $response;


    }


}