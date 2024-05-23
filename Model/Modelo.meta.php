
<?php
require_once ('conexion.php');

class modelo_meta{

    public static function model_buscar(){

      
    }

    public static function model_listar(){
        try {
            $sql = "select * from meta;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }   
    }

    public static function model_agregar($data){
        try {
            $sql = "CALL insertar_meta(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_meta'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }
    }

    public static function model_eliminar($data){
        try {
            $sql = "DELETE FROM empleados WHERE idempleado=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['tambien_te_Extraña'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
    }

    public static function model_actualizar(){
        
    }

}