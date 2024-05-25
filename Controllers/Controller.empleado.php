<?php

class controller_empleado{

    public static function c_listar(){
        $res = modelo_empleado::model_listar();
        return $res;
    }


    public static function c_listar_equipo_empleado($data){
        $res = modelo_empleado::model_buscar($data);
        return $res;
    }

    public static function c_eliminar_empleado($data){
        $res = modelo_empleado::model_eliminar($data);
        return $res;
    }

    public static function c_insertar_empleado($data){
        $res = modelo_empleado::model_agregar($data);
        return $res;
    }

} 