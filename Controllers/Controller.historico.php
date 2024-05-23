<?php

class controller_historico{

    public static function c_buscar($data){
        $response = modelo_historico::model_buscar($data);
        return $response;
    }

}