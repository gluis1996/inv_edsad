<?php

class controller_oficina{


    //SEDE
    public static function controller_listar_sede(){
        $res = modelo_oficina::model_listar_sede();
        return $res;
    }
    
    public static function controller_agregar_sede($data){
        $res = modelo_oficina::model_agregar_sede($data);
        return $res;
    }

    public static function controller_eliminar_sede($data){
        $res = modelo_oficina::model_eliminar_sede($data);
        return $res;
    }

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

    //AREA USUARIA
    public static function controller_listar_area_usuaria(){
        $res = modelo_oficina::model_listar_area_usuaria();
        return $res;
    }

}