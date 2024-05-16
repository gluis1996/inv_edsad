<?php

class controller_usuario{

    public static function controller_listar(){
        $res = modelo_usuario::model_listar();
        return $res;
    }

}