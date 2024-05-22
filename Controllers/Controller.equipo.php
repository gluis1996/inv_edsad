<?php

class controller_equipo{

    public static function c_listar(){
        $response = modelo_equipo::model_listar();
        return $response;
    }
    public static function c_registrar($data){
        $response = modelo_equipo::model_agregar($data);
        return $response;
    }

    public static function c_buscar($data){
        $response = modelo_equipo::model_buscar($data);
        $response2 = modelo_marca::model_listar();

        $res = array(
            'idequipos' => $response[0]['idequipos'],
            'modelo' => $response[0]['modelo'],
            'descripcion' => $response[0]['descripcion'],
            'fecha_registro' => $response[0]['fecha_registro'],
            'idmarca'   => $response[0]['idmarca'],
            'listamarca'=> $response2
        );
        return $res;
    }

    public static function c_editar($data) {
        $response = modelo_equipo::model_actualizar($data);
        return $response;
    }

    public static function c_eliminar($data) {
        $response = modelo_equipo::model_eliminar($data);
        return  $response;
    }


}