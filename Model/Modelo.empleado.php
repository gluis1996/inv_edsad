<?php
require_once('conexion.php');

class modelo_empleado
{

    public static function model_buscar_equipo_empleado($data)
    {
        try {
            $sql = "call sp_equipos_asignados_empleados(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data['idempleado'], PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_listar()
    {
        try {
            $sql = "CALL sp_listar_empleados();";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_buscar($data)
    {
        try {
            $sql = "call sp_buscar_empleados(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data,  PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_buscar_dni($data)
    {
        try {
            $sql = "SELECT * FROM equipos_informa.empleados where dni = ?;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data,  PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_agregar($data)
    {
        try {
            $sql = "call InsertarEmpleado(?,?,?,?,?,?,?,?,?,?,?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data['p_nombres'],                 PDO::PARAM_STR);
            $stmp->bindParam(2, $data['p_apellidos'],               PDO::PARAM_STR);
            $stmp->bindParam(3, $data['p_dni'],                     PDO::PARAM_STR);
            $stmp->bindParam(4, $data['p_fecha_cumpleaños'],        PDO::PARAM_STR);
            $stmp->bindParam(5, $data['p_mes_cumpleaños'],          PDO::PARAM_STR);
            $stmp->bindParam(6, $data['p_numero_personal'],         PDO::PARAM_STR);
            $stmp->bindParam(7, $data['p_correo_personal'],         PDO::PARAM_STR);
            $stmp->bindParam(8, $data['p_correo_institucional'],    PDO::PARAM_STR);
            $stmp->bindParam(9, $data['p_idcargo'],                 PDO::PARAM_STR);
            $stmp->bindParam(10, $data['p_iddireccion_oficina'],     PDO::PARAM_STR);
            $stmp->bindParam(11, $data['p_idtipo_contrato'],         PDO::PARAM_STR);
            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_eliminar($data)
    {
        try {
            $sql = "DELETE FROM empleados WHERE idempleado=?";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->bindParam(1, $data['tambien_te_Extraña'], PDO::PARAM_STR);

            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Modelo empleado " . $th->getMessage();
        }
    }

    public static function model_actualizar($data)
    {
        try {
            $sql = "CALL sp_editar_empleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $conn = conexion::conectar(); // Establecer conexión    
            $stmp = $conn->prepare($sql);
            $stmp->bindParam(1,     $data['edit_id_empleado'],          PDO::PARAM_INT);
            $stmp->bindParam(2,     $data['edit_nombre'],               PDO::PARAM_STR);
            $stmp->bindParam(3,     $data['edit_apellido'],             PDO::PARAM_STR);
            $stmp->bindParam(4,     $data['edit_dni'],                  PDO::PARAM_STR);
            $stmp->bindParam(5,     $data['edit_dia'],                  PDO::PARAM_STR);
            $stmp->bindParam(6,     $data['edit_mes'],                  PDO::PARAM_STR);
            $stmp->bindParam(7,     $data['edit_numero'],               PDO::PARAM_STR);
            $stmp->bindParam(8,     $data['edit_correo_perosnal'],      PDO::PARAM_STR);
            $stmp->bindParam(9,     $data['edit_correo_institucional'], PDO::PARAM_STR);
            $stmp->bindParam(10,    $data['edit_cargo'],                PDO::PARAM_INT);
            $stmp->bindParam(11,    $data['edit_direccion'],            PDO::PARAM_INT);
            $stmp->bindParam(12,    $data['edit_contrato'],             PDO::PARAM_INT);

            if ($stmp->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
        } catch (PDOException $th) {
            return "Error en el modelo empleado: " . $th->getMessage();
        }
    }
}
