<?php
// require_once "conexion.php";


class controller_asignacion{

    public static function c_listar(){
        $response = modelo_detalleAsignacion::model_listar();
        return $response;
    }

    public static function c_registras_detalleasignacion($data){
        $res = modelo_detalleAsignacion::model_agregar($data);
        return $res;
    }

}