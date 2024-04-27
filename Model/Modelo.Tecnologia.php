<?php 
require_once ('conexion.php');

class ModeloTecnologia{

    public static function Listar() {
        try {
            $sql = "SELECT * FROM tecnologia ";
            $stmt = conexion::conectar()->prepare($sql)   ;
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de Tecnologia ".$e->getMessage();
        }
    }


}
