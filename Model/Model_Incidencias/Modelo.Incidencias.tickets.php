<?php

require_once ('../../Model/conexion.php');

class modelo_incidencias_tickets{


    public static function model_buscar($data){
        try {
            $sql = "
            select 
            t.ticket_id,t.title,t.description,t.status,t.priority,
            t.created_by,u.username as creadopor,t.assigned_to,u2.username as asignadoa,
            t.equipment_id,e.description as nombreequipo,
            t.created_at, t.updated_at
            from tickets t
            inner join  users as u on t.created_by=u.user_id 
            inner join  users as u2 on t.assigned_to=u2.user_id 
            inner join equipment as e on t.equipment_id=e.equipment_id
            where t.ticket_id = ?;
            ";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_listar(){
        try {
            $sql = "
            select 
            t.ticket_id,t.title,t.description,t.status,t.priority,
            t.created_by,u.username as creadopor,t.assigned_to,u2.username as asignadoa,
            t.equipment_id,e.description as nombreequipo,
            t.created_at, t.updated_at
            from tickets t
            inner join  users as u on t.created_by=u.user_id 
            inner join  users as u2 on t.assigned_to=u2.user_id 
            inner join equipment as e on t.equipment_id=e.equipment_id;
            ";
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