<?php


class controller_area{

    public static function c_listar(){
        $response = modelo_area::model_listar();
        return $response;
    }

}