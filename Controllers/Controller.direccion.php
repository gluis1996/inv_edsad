<?php

class controller_direccion{

    public static function c_listar(){
        $res = modelo_direccion::model_listar();
        return $res;
    }

}