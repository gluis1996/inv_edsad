<?php

class controller_usuario{

    public static function controller_listar(){
        $res = modelo_usuario::model_listar();
        return $res;
    }

    public static function controller_agregar_usuario($data){
        $res = modelo_usuario::model_agregar($data);
        return $res;
    }


    public static function controller_eliminar_usuario($data){
        $res = modelo_usuario::model_eliminar($data);
        return $res;
    }


}