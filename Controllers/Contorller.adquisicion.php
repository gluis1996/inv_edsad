<?php


class controller_adquisicion{

    public static function c_listar(){
        $response = modelo_adquisicion::m_listar();
        return $response;
    }

    
}