<?php 
require_once "conexion.php";

class modelo_averia{


    public static function modelo_registrar($data){
        try {
            $sql = "INSERT INTO averias(`operador`,`abonado`,`t_orden`,`fecha`,`area`,`cod_orden`)VALUES(?,?,?,?,?,?);";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$data['operador'],PDO::PARAM_STR);
            $stmt->bindParam(2,$data['abonado'],PDO::PARAM_STR);
            $stmt->bindParam(3,$data['t_orden'],PDO::PARAM_STR);
            $stmt->bindParam(4,$data['fecha'],PDO::PARAM_STR);
            $stmt->bindParam(5,$data['area'],PDO::PARAM_STR);
            $stmt->bindParam(6,$data['cod_orden'],PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 'ok';
            }
        } catch (PDOException $e) {
            return " error : ".$e->getMessage();
        }
    }


    public static function listar_averias(){
        try {
            $sql = "SELECT * FROM integracionesolt.t_averia;";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return " error : ".$e->getMessage();
        }
    }


}




