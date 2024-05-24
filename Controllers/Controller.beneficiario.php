<?php

class controller_beneficiario
{
    public static function controller_listar()
    {
        $res = modelo_beneficario::model_listar();
        return $res;
    }

    public static function controller_agregar_beneficiario($data)
    {
        $res = modelo_beneficario::model_agregar($data);
        return $res;
    }

    public static function controller_eliminar_beneficiario($data){
        $res = modelo_beneficario::model_eliminar($data);
        return $res;
    }
}
