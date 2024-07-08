<?php

class controller_tickets{

    public static function C_Listar(){
        $reesponse = modelo_incidencias_tickets::model_listar();
        return $reesponse;
    }

}