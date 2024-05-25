<?php

require_once("conexion.php");

class modelo_area{

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM a_usuaria;";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();        
        } catch (PDOException $th) {
            return "Error : ".$th->getMessage();
        }

    }

}