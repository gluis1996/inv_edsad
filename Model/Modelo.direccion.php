<?php

require_once ('conexion.php');

class modelo_direccion{

    public static function model_listar(){
        try {
            $sql = "SELECT * FROM direccion_oficina ORDER BY  nombre_direccion ASC;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
        
        
    }

    public static function registrar_cargo($data){
        try {
            $sql = "INSERT INTO direccion_oficina (nombre_direccion) VALUES(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data,  PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
        
        
    }
    
    public static function modelo_editar($data){
        try {
            $sql = "UPDATE direccion_oficina SET nombre_direccion = ? WHERE iddireccion_oficina = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data['txt_editar_direccion'],      PDO::PARAM_STR);
            $stmp->bindParam(2, $data['txt_editar_id_direccion'],   PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
    }
    
    public static function modelo_eliminar($data){
        try {
            $sql = "DELETE FROM direccion_oficina WHERE iddireccion_oficina = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data,  PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
    }



}