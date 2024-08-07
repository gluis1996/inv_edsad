<?php

require_once('../../Model/conexion.php');

class modelo_incidencias_tickets
{


    public static function model_buscar($data)
    {
        try {
            $sql = "select  * from tickets  where ticket_id = ?;";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public static function model_listar()
    {
        try {
            $sql = "
            select 
            t.ticket_id,
            t.title,
            t.description,
            t.status,
            t.priority,
            t.created_by,
            (select nombres from equipos_informa.empleados where idempleado = t.created_by) as creadopor,
            t.assigned_to,
            (select nombres from equipos_informa.empleados where idempleado = t.assigned_to) as asignadoa,
            t.equipment_id, 
            (select concat(descripcion,' ', modelo) from equipos_informa.equipos where idequipos = eqasig.idequipos)  as nombreequipo,
            t.created_at, t.updated_at
            from tickets t
            inner join  users as u on t.created_by=u.user_id 
            inner join equipos_informa.detalle_asignacion as eqasig on eqasig.cod_patrimonial=t.equipment_id;
            ";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public static function model_agregar($data)
    {
        try {
            $sql = "CALL sp_regtistrar_tTicket(?,?,?,?,?,?,?)";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data['p_title'], PDO::PARAM_STR);
            $call->bindParam(2, $data['p_description'], PDO::PARAM_STR);
            $call->bindParam(3, $data['p_status'], PDO::PARAM_STR);
            $call->bindParam(4, $data['p_created_by'], PDO::PARAM_INT);
            $call->bindParam(5, $data['p_assigned_to'], PDO::PARAM_STR);
            $call->bindParam(6, $data['p_equipment_id'], PDO::PARAM_STR);
            $call->bindParam(7, $data['p_fecha'], PDO::PARAM_STR);

            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
        } catch (PDOException $e) {
            // Extraer solo el mensaje personalizado
            $errorMessage = $e->getMessage();
            $parts = explode(':', $errorMessage, 2);
            $cleanMessage = isset($parts[1]) ? trim($parts[1]) : $errorMessage;

            return [
                "status" => "error",
                "message" => $cleanMessage
            ];
        }
    }

    public static function model_eliminar($data)
    {
        try {
            $sql = "DELETE FROM `sistemas_tikets`.`tickets`
                    WHERE ticket_id = ?;";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            if ($call->execute()) {
                return "ok";
            } else {
                return "fallo";
            }
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public static function model_actualizar_estado($data)
    {
        try {
            $sql = "call sp_asignacion_tTicket(?,?)";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data['id_ticket'], PDO::PARAM_STR);
            $call->bindParam(2, $data['id_empleado'], PDO::PARAM_STR);
            if ($call->execute()) {
                return "ok";
            } else {
                return "fallo";
            }
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }


    //consulta adicionales o validaciones

    public static function validar_existencia_estado($data){
        try {
            $sql = "SELECT COUNT(*) as cantidad
                    FROM tickets
                    WHERE equipment_id = ?
                    AND status IN ('abierto', 'en proceso');";
            $call = conexion::conectar_incidencias()->prepare($sql);
            $call->bindParam(1, $data, PDO::PARAM_STR);
            $call->execute();
            return $call->fetchColumn();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
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


// 02/08_/09
// DELIMITER $$

// CREATE PROCEDURE sp_regtistrar_tTicket(
//     IN p_title VARCHAR(100),
//     IN p_description TEXT,
//     IN p_status ENUM('abierto', 'en proceso', 'resuelto', 'cerrado'),
//     IN p_created_by INT,
//     IN p_assigned_to INT,
//     IN p_equipment_id INT,
//     in p_fecha	date
// )
// BEGIN
//     INSERT INTO tickets (
//         title, 
//         description, 
//         status, 
//         created_by, 
//         assigned_to, 
//         equipment_id, 
//         created_at
//     ) VALUES (
//         p_title, 
//         p_description, 
//         p_status, 
//         p_created_by, 
//         p_assigned_to, 
//         p_equipment_id, 
//         p_fecha
//     );
// END$$

// DELIMITER ;

//actualizar estado

// DELIMITER $$

// CREATE PROCEDURE sp_asignacion_tTicket(
//     in p_ticket_id	int(11),
//     IN p_id_empleado text
// )
// BEGIN
//     update tickets set assigned_to = p_id_empleado, status= 'en proceso' where ticket_id = p_ticket_id;
// END$$

// DELIMITER ;