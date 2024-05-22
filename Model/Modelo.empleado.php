<?php
require_once ('conexion.php');

class modelo_empleado{

    public static function model_buscar($data){
        try {
            $sql = "call sp_equipos_asignados_empleados(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idempleado'],PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM empleados;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
        
        
    }

    public static function model_agregar($data){
        try {
            $sql = "call InsertarEmpleado(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['empleado_nombre'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
    }

    public static function model_eliminar($data){
        try {
            $sql = "DELETE FROM empleados WHERE idempleado=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idempleado'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
    }

    public static function model_actualizar(){
        
    }

}