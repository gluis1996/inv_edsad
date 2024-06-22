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
            $sql = "call InsertarEmpleado(?,?,?,?,?,?,?,?,?,?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data['p_nombres'],                 PDO::PARAM_STR);
            $stmp->bindParam(2, $data['p_apellidos'],               PDO::PARAM_STR);
            $stmp->bindParam(3, $data['p_dni'],                     PDO::PARAM_STR);
            $stmp->bindParam(4, $data['p_fecha_cumpleaños'],        PDO::PARAM_STR);
            $stmp->bindParam(5, $data['p_mes_cumpleaños'],          PDO::PARAM_STR);
            $stmp->bindParam(6, $data['p_numero_personal'],         PDO::PARAM_STR);
            $stmp->bindParam(7, $data['p_correo_personal'],         PDO::PARAM_STR);
            $stmp->bindParam(8, $data['p_correo_institucional'],    PDO::PARAM_STR);
            $stmp->bindParam(9, $data['p_idcargo'],                 PDO::PARAM_STR);
            $stmp->bindParam(10,$data['p_iddireccion_oficina'],     PDO::PARAM_STR);
            $stmp->bindParam(11,$data['p_idtipo_contrato'],         PDO::PARAM_STR);
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
            $stmp->bindParam(1,$data['tambien_te_Extraña'],PDO::PARAM_STR);
            
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