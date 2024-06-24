<?php

class controller_tipo_contrato{

    public static function c_listar(){
        $res = modelo_tipo_contrato::model_listar();
        return $res;
    }

}