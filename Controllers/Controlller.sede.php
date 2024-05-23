<?php

class controller_sede{

    public static function controller_listar(){
        $res = modelo_sede::model_listar();
        return $res;
    }


}

