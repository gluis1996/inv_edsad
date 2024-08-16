
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
            $sql = "delete from meta where idmeta = ?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idmt'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        }  catch (PDOException $th) {
            // Modificar el mensaje de error para que sea más entendible para el usuario final
            $errorMessage = $th->getMessage();
            if (strpos($errorMessage, 'Integrity constraint violation') !== false) {
                return "No se puede eliminar el registro porque está siendo utilizado en otras partes del sistema. Por favor, revisa las dependencias y vuelve a intentarlo.";
            }
            // Puedes agregar más condiciones para otros tipos de errores si es necesario
            return "Ocurrió un error al intentar eliminar el registro. Por favor, inténtalo nuevamente o contacta al soporte.";
        }
    }

    public static function model_actualizar($data){
        try {
            $sql = "UPDATE meta SET nombre = ? WHERE idmeta = ?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['idmeta'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }
    }

}