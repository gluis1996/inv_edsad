<?php 

require_once ('conexion.php');

class modelo_cargo{

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM cargo ORDER BY  nombre_cargo ASC;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
        
        
    }



}
