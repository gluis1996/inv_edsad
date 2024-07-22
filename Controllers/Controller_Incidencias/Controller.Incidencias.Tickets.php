<?php

class controller_tickets{

    public static function C_Listar(){
        $reesponse = modelo_incidencias_tickets::model_listar();
        return $reesponse;
    }
    
    public static function C_buscar($data){
        $response           = modelo_incidencias_tickets::model_buscar($data);
        $response_comment   = modelo_incidencias_ticket_comments::buscar($data);

        $res = array(
            'tickets' => $response,
            'comment' => $response_comment,
        );
        return $res;
    }

    public static function C_actualizar_estado($data){
        $response           = modelo_incidencias_tickets::model_actualizar_estado($data);
        return $response;
    }
    
}