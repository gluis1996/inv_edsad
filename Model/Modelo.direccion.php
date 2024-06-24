<?php

class modelo_direccion{

    public static function model_listar(){
        try {
            $sql = "SELECT * FROM equipos_informaticos.direccion_oficina ORDER BY  nombre_direccion ASC;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
        
        
    }





}