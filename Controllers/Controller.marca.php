<?php


class controller_marca{

    public static function c_marca_listar(){
        $response = modelo_marca::model_listar();
        return $response;
    }
    public static function c_marca_registrar($data){
        $response = modelo_marca::model_agregar($data);
        return $response;
    }

    public static function c_marca_editar($data){
        $response = modelo_marca::model_actualizar($data);
        return $response;
    }


}