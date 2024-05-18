<?php

class controller_empleado{

    public static function c_listar(){
        $res = modelo_empleado::model_listar();
        return $res;
    }

} 