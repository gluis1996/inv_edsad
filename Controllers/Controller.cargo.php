<?php

class controller_cargo{

    public static function c_listar(){
        $res = modelo_cargo::model_listar();
        return $res;
    }
    
    public static function c_registrar($data){
        $res = modelo_cargo::registrar_cargo($data);
        return $res;
    }
    
    public static function c_editar($data){
        $res = modelo_cargo::modelo_editar($data);
        return $res;
    }
    
    public static function c_eliminar($data){
        $res = modelo_cargo::modelo_eliminar($data);
        return $res;
    }

}