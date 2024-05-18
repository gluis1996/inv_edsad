<?php

class controller_equipo{

    public static function c_listar(){
        $response = modelo_equipo::model_listar();
        return $response;
    }




}