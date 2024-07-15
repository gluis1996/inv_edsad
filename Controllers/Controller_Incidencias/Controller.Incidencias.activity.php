<?php

class controller_tickets_activity{

    public static function C_Listar(){
        $reesponse = modelo_incidencias_tickets::model_listar();
        return $reesponse;
    }
    
    public static function C_buscar($data){
        $response           = modelo_incidencias_activity::buscar($data);
        return $response;
    }

}