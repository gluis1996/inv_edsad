<?php
require_once ('conexion.php');

class modelo_usuario{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM usuario;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo usuario ".$th->getMessage();
        }
    }

    public static function model_agregar($data){
        try {
            $sql = "CALL insertar_usuario(?,?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['user'],PDO::PARAM_STR);
            $stmp->bindParam(3,$data['contraseña'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Usuario ".$th->getMessage();
        }
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}