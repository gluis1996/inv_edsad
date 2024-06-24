<?php

class modelo_tipo_contrato{


    public static function model_listar(){
        try {
            $sql = " SELECT * FROM equipos_informaticos.tipo_contrato ORDER BY  nombre_tipo_contrato ASC;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Cargo".$th->getMessage();
        }
        
        
    }


}