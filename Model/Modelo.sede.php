<?php
require_once ('conexion.php');

class modelo_sede{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "select * from sede;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo sede ".$th->getMessage();
        }
    }

    public static function model_agregar($data){
        try {
            $sql = "CALL insertar_sede(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_sede'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Sede ".$th->getMessage();
        }
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}