<?php

class controller_oficina{

    //OFICINA

    public static function controller_listar(){
        $response = modelo_oficina::model_listar();
        return $response;
    }
    
    public static function controller_agregar_oficina($data){
        $res = modelo_oficina::model_agregar($data);
        return $res;
    }

    public static function controller_eliminar_oficina($data){
        $res = modelo_oficina::model_eliminar($data);
        return $res;
    }


}