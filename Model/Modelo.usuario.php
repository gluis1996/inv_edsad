<?php
require_once ('conexion.php');

class modelo_usuario{

    public static function model_buscar($data){
        try {
            $sql = "select *from usuario where idusuario = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data,PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo usuario ".$th->getMessage();
        }
    }

    public static function model_listar(){
        try {
            $sql = "select * from usuario;";
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

    public static function model_eliminar($data){
        try {
            $sql = "delete from usuario where idusuario=?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idusu'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo usuario ".$th->getMessage();
        }
        
    }

    public static function model_actualizar($data){
        try {
            $sql = "call actualizar_usuario(?,?,?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['p_idusuario'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['p_nombre'],PDO::PARAM_STR);
            $stmp->bindParam(3,$data['p_user'],PDO::PARAM_STR);
            $stmp->bindParam(4,$data['p_contraseña'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo usuario".$th->getMessage();
        }
    }

}