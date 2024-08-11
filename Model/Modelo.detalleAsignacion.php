<?php 

require_once ('conexion.php');

class modelo_detalleAsignacion{

    public static function model_buscar($data){
        
        try {
            $sql = "call sp_buscar_detalle_asginacion(?);";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['id_detalle_asignacion'],PDO::PARAM_INT);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
    }

    public static function model_buscar_por_patrimonial($data){
        
        try {
            $sql = "call sp_buscar_detalle_asginacion_cod_patrimonial(?);";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data,PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
    }

    public static function model_listar(){
        try {
            $sql = "call sp_obtener_detalle_asignacion();";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_agregar($data){
        try {
            $sql = "call sp_insert_detalle_asignacion(?,?,?,?,?,?,?,?,?);";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_idsedes'],PDO::PARAM_STR);
            $call->bindParam(2,$data['p_idoficinas'],PDO::PARAM_STR);
            $call->bindParam(3,$data['p_idequipos'],PDO::PARAM_STR);
            $call->bindParam(4,$data['p_idusuario'],PDO::PARAM_STR);
            $call->bindParam(5,$data['p_idempleado'],PDO::PARAM_STR);
            $call->bindParam(6,$data['p_cod_patrimonial'],PDO::PARAM_STR);
            $call->bindParam(7,$data['p_vida_util'],PDO::PARAM_STR);
            $call->bindParam(8,$data['p_estado'],PDO::PARAM_STR);
            $call->bindParam(9,$data['p_fecha_asignacion'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            }else{
                return 'fallo';
            }

        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
        
    }

    public static function model_eliminar($data){
        try {
            $sql = "DELETE FROM detalle_asignacion WHERE id_detalle_asignacion = ?;";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['id_detalle_asignacion'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            }else{
                return 'fallo'; 
            }

        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
    }

    public static function model_actualizar($data){
        try {
            $sql = "CALL sp_actualizar_detalle_asignacion(?,?,?,?,?,?,?,?);";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1, $data['p_id_detalle_asignacion'], PDO::PARAM_INT);
            $call->bindParam(2, $data['p_idsedes'], PDO::PARAM_INT);
            $call->bindParam(3, $data['p_idoficinas'], PDO::PARAM_INT);
            $call->bindParam(4, $data['p_idusuario'], PDO::PARAM_INT);
            $call->bindParam(5, $data['p_idempleado'], PDO::PARAM_INT);
            $call->bindParam(6, $data['p_vida_util'], PDO::PARAM_INT);
            $call->bindParam(7, $data['p_estado'], PDO::PARAM_STR);
            $call->bindParam(8, $data['p_fecha_asignacion'], PDO::PARAM_STR);
    
            // Ejecutar la llamada al procedimiento almacenado
            if ($call->execute()) {
                return 'ok';
            }else{
                return 'fallo';
            }
        } catch (PDOException $e) {
            return 'Error detalle asignacion: ' . $e->getMessage();
        }
    }

}



// DELIMITER $$

// CREATE PROCEDURE `sp_buscar_detalle_asginacion_cod_patrimonial`(IN `p_cod_patrimonial` VARCHAR(255))
// BEGIN
//     SELECT 
//         da.id_detalle_asignacion,
//         s.nombres AS sede_nombres,
//         o.nombres AS oficina_nombres,
//         CONCAT(e.descripcion, ' ', e.modelo) AS equipo,
//         u.nombre AS usuario_nombre,
//         da.cod_patrimonial,
//         da.vida_util,
//         da.estado,
//         em.nombres AS empleado_nombre,
//         da.idempleado,
//         da.idsedes,
//         da.idoficinas,
//         da.fecha_asignacion
//     FROM detalle_asignacion da
//     INNER JOIN sede s ON s.idsedes = da.idsedes
//     INNER JOIN oficina o ON o.idoficinas = da.idoficinas
//     INNER JOIN equipos e ON e.idequipos = da.idequipos
//     INNER JOIN usuario u ON u.idusuario = da.idusuario
//     INNER JOIN empleados em ON em.idempleado = da.idempleado
//     WHERE da.cod_patrimonial = p_cod_patrimonial;
// END $$

// DELIMITER ;
