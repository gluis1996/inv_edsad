<?php
// require_once "conexion.php";


class controller_asignacion{

    public static function c_listar(){
        $response = modelo_detalleAsignacion::model_listar();
        return $response;
    }


}