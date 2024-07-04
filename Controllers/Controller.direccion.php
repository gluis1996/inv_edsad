<?php

class controller_direccion{

    public static function c_listar(){
        $res = modelo_direccion::model_listar();
        return $res;
    }

    public static function c_registrar($data){
        $res = modelo_direccion::registrar_cargo($data);
        return $res;
    }
    
    public static function c_editar($data){
        $res = modelo_direccion::modelo_editar($data);
        return $res;
    }
    
    public static function c_eliminar($data){
        $res = modelo_direccion::modelo_eliminar($data);
        return $res;
    }

}