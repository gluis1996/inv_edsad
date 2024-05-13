<?php
require_once ('conexion.php');

class ModeloLogin{

    public static function ModelLogin($user, $pass){
        try {
            $sql = "SELECT *FROM usuario WHERE user = ? AND contrasena = ?;";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(1,$user,PDO::PARAM_STR);
            $stmt -> bindParam(2,$pass,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt-> fetch();
        } catch (PDOException $e) {
            return "Erroe en consulta de logeo ".$e->getMessage();
        }

    }

}