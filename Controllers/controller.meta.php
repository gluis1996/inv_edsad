
<?php

class controller_meta{

    public static function controller_listar(){
        $res = modelo_meta::model_listar();
        return $res;
    }


    public static function controller_eliminar_meta($data){
        $res = modelo_meta::model_eliminar($data);
        return $res;
    }

    public static function controller_agregar_meta($data){
        $res = modelo_meta::model_agregar($data);
        return $res;
    }

    public static function controller_actualizar_meta($data){
        $res = modelo_meta::model_actualizar($data);
        return $res;
    }

} 