<?php

class controller_sede{

    //SEDE
    public static function controller_listar_sede(){
        $res = modelo_sede::model_listar();
        return $res;
    }
    
    public static function controller_agregar_sede($data){
        $res = modelo_sede::model_agregar($data);
        return $res;
    }

    public static function controller_eliminar_sede($data){
        $res = modelo_sede::model_eliminar($data);
        return $res;
    }


}

