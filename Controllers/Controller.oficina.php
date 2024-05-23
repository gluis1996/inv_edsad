<?php

class controller_oficina{

    public static function controller_listar(){
        $response = modelo_oficina::model_listar();
        return $response;
    }

}