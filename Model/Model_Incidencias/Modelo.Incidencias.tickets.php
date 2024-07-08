<?php

require_once ('../../Model/conexion.php');

class modelo_incidencias_tickets{


    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM tickets;";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_agregar($data){
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar($data){
        
    }


}