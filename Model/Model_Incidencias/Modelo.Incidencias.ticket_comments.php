<?php
require_once ('../../Model/conexion.php');
class modelo_incidencias_ticket_comments{

    public static function listar(){
        
    }

    public static function buscar($data){
        try {
            $sql = "
            SELECT * FROM sistemas_tikets.ticket_comments where ticket_id = ?;
            ";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Error: ".$e->getMessage();
        }
    }

}