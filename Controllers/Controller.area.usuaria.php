<?php

class controller_area_usuaria{

    //SEDE
    public static function controller_listar_areausu(){
        $res = modelo_area_usuaria::model_listar();
        return $res;
    }
    
    public static function controller_agregar_areausu($data){
        $res = modelo_area_usuaria::model_agregar($data);
        return $res;
    }

    public static function controller_eliminar_areausu($data){
        $res = modelo_area_usuaria::model_eliminar($data);
        return $res;
    }


}

