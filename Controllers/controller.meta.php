
<?php

class controller_meta{

    public static function controller_listar(){
        $res = modelo_meta::model_listar();
        return $res;
    }


    // public static function c_eliminar_empleado($data){
    //     $res = modelo_empleado::model_eliminar($data);
    //     return $res;
    // }

    public static function controller_agregar_meta($data){
        $res = modelo_meta::model_agregar($data);
        return $res;
    }

} 