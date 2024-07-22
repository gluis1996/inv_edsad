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

    public static function model_actualizar_estado($data){
        try {
            $sql = "
                    UPDATE tickets SET status = ?,
                    WHERE ticket_id = ? ;";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data['status'], PDO::PARAM_STR);
            $call->bindParam(2, $data['ticket_id'], PDO::PARAM_STR);
            if ($call->execute()) {
                return "ok";
            }else {
                return "fallo";
            }

        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }


}


// DELIMITER $$

// CREATE TRIGGER after_ticket_insert
// AFTER INSERT ON tickets
// FOR EACH ROW
// BEGIN
//     INSERT INTO ticket_activities (ticket_id, user_id, activity_type, description, created_at)
//     VALUES (NEW.ticket_id, NEW.created_by, 'creado', CONCAT('Ticket creado con título: ', NEW.title), NEW.created_at);
// END$$

// DELIMITER ;


// DELIMITER $$

// CREATE TRIGGER after_ticket_assign
// AFTER UPDATE ON tickets
// FOR EACH ROW
// BEGIN
//     IF NEW.assigned_to <> OLD.assigned_to THEN
//         INSERT INTO ticket_activities (ticket_id, user_id, activity_type, description, created_at)
//         VALUES (NEW.ticket_id, NEW.assigned_to, 'asignado', CONCAT('Ticket asignado a usuario ID: ', NEW.assigned_to), NEW.updated_at);
//     END IF;
// END$$

// DELIMITER ;


// DELIMITER $$

// CREATE TRIGGER after_ticket_status_update
// AFTER UPDATE ON tickets
// FOR EACH ROW
// BEGIN
//     IF NEW.status <> OLD.status THEN
//         INSERT INTO ticket_activities (ticket_id, user_id, activity_type, description, created_at)
//         VALUES (NEW.ticket_id, NEW.assigned_to, 'actualizado', CONCAT('Estado del ticket cambiado a: ', NEW.status), NEW.updated_at);
//     END IF;

//     IF NEW.status = 'resuelto' THEN
//         INSERT INTO ticket_activities (ticket_id, user_id, activity_type, description, created_at)
//         VALUES (NEW.ticket_id, NEW.assigned_to, 'resuelto', 'El ticket ha sido resuelto.', NEW.updated_at);
//     END IF;

//     IF NEW.status = 'cerrado' THEN
//         INSERT INTO ticket_activities (ticket_id, user_id, activity_type, description, created_at)
//         VALUES (NEW.ticket_id, NEW.assigned_to, 'cerrado', 'El ticket ha sido cerrado.', NEW.updated_at);
//     END IF;
// END$$

// DELIMITER ;
