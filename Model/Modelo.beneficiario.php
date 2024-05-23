<?php
require_once('conexion.php');

class modelo_beneficario
{

    public static function model_buscar()
    {
    }

    public static function model_listar()
    {
        try {
            $sql = "SELECT * FROM beneficiario;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp -> execute();
            return $stmp->fetchAll();

        } catch (PDOException $th) {
            return "Modelo Beneficiario ".$th->getMessage();
        }
    }

    public static function model_agregar($data)
    {
        try {
            $sql = "CALL insertar_beneficiario(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['nombre_beneficiario'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Beneficiario ".$th->getMessage();
        }
    }

    public static function model_eliminar()
    {
    }

    public static function model_actualizar()
    {
    }
}
