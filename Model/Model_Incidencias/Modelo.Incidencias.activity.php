<?php
require_once ('../../Model/conexion.php');
class modelo_incidencias_activity{

    public static function listar(){
        
    }

    public static function buscar($data){
        try {
            $sql = "
            SELECT 
            ta.activity_id,ta.ticket_id,
            ti.title,ta.user_id,us.username,
            ta.activity_type, ta.description, ta.created_at
            FROM ticket_activities as ta
            inner join tickets ti on ti.ticket_id=ta.ticket_id
            inner join users us on us.user_id=ta.user_id
            where ta.ticket_id = ?;
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