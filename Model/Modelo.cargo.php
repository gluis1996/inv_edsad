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
    
    
    public static function registrar_cargo($data){
        try {
            $sql = "INSERT INTO cargo (nombre_cargo) VALUES(?);";
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
