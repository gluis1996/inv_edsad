<?php 

require_once ('conexion.php');

class modelo_detalleAsignacion{

    public static function model_buscar($data){
        
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
        
    }

    public static function model_actualizar($data){
        
    }

}