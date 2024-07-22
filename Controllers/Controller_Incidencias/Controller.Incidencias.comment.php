<?php

class controller_comment{

    public static function c_registrar($data){
        $response = modelo_incidencias_ticket_comments::registrar($data);
        return $response;
    }

    public static function c_buscar($data){
        $response = modelo_incidencias_ticket_comments::buscar($data);
        return $response;
    }

}