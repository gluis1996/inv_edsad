<?php
require_once ('conexion.php');

class modelo_oficina{

    public static function model_buscar($data){
        try {
            $sql = "SELECT * FROM oficina WHERE idsedes = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data,PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo oficina ".$th->getMessage();
        }
    }

    public static function model_listar(){
        try {
            $sql = "call obtener_oficinas_y_sedes();";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }
        
        
    }

    public static function model_agregar($data){
        try {
            $sql = "CALL insertar_oficina(?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_oficina'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['idsede'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo oficina ".$th->getMessage();
        }
        
    }

    public static function model_eliminar($data){
        try {
            $sql = "delete from oficina where idoficinas=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idofi'],PDO::PARAM_STR);
            
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
