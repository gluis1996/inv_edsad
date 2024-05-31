<?php
require_once ('conexion.php');

class modelo_area_usuaria{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT * FROM a_usuaria;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Area Usuaria ".$th->getMessage();
        }
    }

    public static function model_agregar($data){
        try {
            $sql = "CALL sp_insertar_a_usuaria (?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_area_u'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Sede ".$th->getMessage();
        }
    }

    public static function model_eliminar($data){
        try {
            $sql = "delete from a_usuaria where id_area_usuaria=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['id_a_usu'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Area Usuaria ".$th->getMessage();
        }

    }

    public static function model_actualizar(){
        
    }

}