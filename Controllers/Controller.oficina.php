<?php



class controller_oficina{

    public static function c_listar_oficina($data){
        $response = modelo_oficina::model_buscar($data);
        return $response;
    }

}