<?php

class controller_cargo{

    public static function c_listar(){
        $res = modelo_cargo::model_listar();
        return $res;
    }

}