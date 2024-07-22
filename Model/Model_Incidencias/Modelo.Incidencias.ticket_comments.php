<?php
require_once ('../../Model/conexion.php');
class modelo_incidencias_ticket_comments{

    public static function listar(){
        
    }

    public static function buscar($data){
        try {
            $sql = "
            SELECT * FROM ticket_comments  where ticket_id = ?;
            ";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Error: ".$e->getMessage();
        }
    }

    public static function registrar($data){
        try {
            $sql = "
            INSERT INTO  ticket_comments (`ticket_id`,`user_id`,`comment`,`created_at`)VALUES(?,?,?,?);
            ";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data['ticket_id'], PDO::PARAM_STR);
            $call->bindParam(2, $data['user_id'], PDO::PARAM_STR);
            $call->bindParam(3, $data['comment'], PDO::PARAM_STR);
            $call->bindParam(4, $data['created_at'], PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }
        } catch (PDOException $e) {
            return "Error: ".$e->getMessage();
        }
    }

}