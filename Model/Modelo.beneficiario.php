<?php
require_once('conexion.php');

class modelo_beneficario
{

    public static function model_buscar($data)
    {
        try {
            $sql = "SELECT * FROM beneficiario WHERE idbeneficiario = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data,PDO::PARAM_STR);
            $stmp -> execute();
            return $stmp->fetchAll();

        } catch (PDOException $th) {
            return "Modelo Beneficiario ".$th->getMessage();
        }
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

    public static function model_eliminar($data)
    {
        try {
            $sql = "delete from beneficiario where idbeneficiario = ?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['idbenef'],PDO::PARAM_STR);
            
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
    }

    public static function model_actualizar($data)
    {
        try {
            $sql = "UPDATE beneficiario SET nombre = ? WHERE idbeneficiario = ?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1,$data['editar_nombre_beneficiario'],PDO::PARAM_STR);
            $stmp->bindParam(2,$data['id_beneficiario'],PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return "Modelo Beneficiario ".$th->getMessage();
        }
    }
}
