<?php

class controller_equipo{

    public static function c_listar(){
        $response = modelo_equipo::model_listar();
        return $response;
    }
    public static function c_registrar($data){
        $response = modelo_equipo::model_agregar($data);
        return $response;
    }




}