<?php 
require_once ('conexion.php');
require_once ('../Model/dto/perfiles.php');
class Modeloperfiles{

    public $variable;

    public function __construct(perfiles $per) {
        $this->variable = $per;
    }



    public static function listar(){
        try {
            $sql = "SELECT *FROM datos";
            $stmmp = conexion::conectar()->prepare($sql);
            $stmmp->execute();
            return $stmmp-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de color ".$e->getMessage();
        }
    }


    public static function registrar($perfil){
        try {
            $sql = "INSERT INTO datos (vlan,datos,grupo,id_filial) VALUES (?,?,?,?); ";
            $stmmp = conexion::conectar()->prepare($sql);
            $stmmp->bindParam(1,$perfil["vlan"],PDO::PARAM_STR);
            $stmmp->bindParam(2,$perfil["megas"],PDO::PARAM_STR);
            $stmmp->bindParam(3,$perfil["grupo"],PDO::PARAM_STR);
            $stmmp->bindParam(4,$perfil["filial"],PDO::PARAM_STR);
        
            if ($stmmp->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }
        } catch (PDOException $e) {
            return "Erroe en consulta de color ".$e->getMessage();
        }
    }

}