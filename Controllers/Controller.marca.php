<?php


class controller_marca{

    public static function c_marca_listar(){
        $response = modelo_marca::model_listar();
        return $response;
    }


}