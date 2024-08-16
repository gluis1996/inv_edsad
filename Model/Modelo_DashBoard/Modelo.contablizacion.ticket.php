<?php 
require_once ('../../Model/conexion.php');
class modelo_contalizacion_ticket{

    public static function cantidad_ticket(){
        try {
            $sql = "SELECT status,  COUNT(*) AS cantidad
                    FROM  tickets
                    GROUP BY status
                    UNION ALL SELECT 'Total' AS status,  COUNT(*) AS cantidad FROM tickets;";       
            $call = conexion::conectar_incidencias()->prepare($sql);     
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
    public static function cantidad_total_por_sede(){
        try {
            $sql = "SELECT s.nombres, da.idsedes, COUNT(da.idequipos) AS cantidad_equipos
                    FROM detalle_asignacion da
                    INNER JOIN sede s ON da.idsedes = s.idsedes
                    GROUP BY da.idsedes
                    UNION ALL
                    SELECT 'Total', NULL, COUNT(idequipos)
                    FROM detalle_asignacion;";       
            $call = conexion::conectar()->prepare($sql);     
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }



}