<?php
require_once "conexion.php";
require_once ('../Model/dto/orden.php');
class registrarOrden {

    public $variable;
    public function __constructSinParametros() {
    }
    public function __construct(orden $orden) {
        $this->variable = $orden;
    }

    

    public static function registrar($data){
        try {
            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d H:i:s');
            $fechaactual = $fecha;
            $sql = 'CALL registrarInstalcionFtth (?,?,?,?,?,?,?,?,?,?)';
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$fechaactual,PDO::PARAM_STR);
            $stmt->bindParam(2,$data['operador'],PDO::PARAM_STR);
            $stmt->bindParam(3,$data['FILIAL'],PDO::PARAM_STR);
            $stmt->bindParam(4,$data['os'],PDO::PARAM_STR);
            $stmt->bindParam(5,$data['codAbonado'],PDO::PARAM_STR);
            $stmt->bindParam(6,$data['Nodo'],PDO::PARAM_STR);
            $stmt->bindParam(7,$data['caja'],PDO::PARAM_STR);
            $stmt->bindParam(8,$data['borne'],PDO::PARAM_STR);
            $stmt->bindParam(9,$data['precinto'],PDO::PARAM_STR);
            $stmt->bindParam(10,$data['mac'],PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function listar($operador){
        try {
            $sql = 'SELECT 
                    ins.id, ins.fecha, ins.operador,f.nombre as filial,ins.os,ins.abonado,ins.codabonado,ins.caja,ins.borne,ins.precinto,ins.mac
                    FROM instalacionftth as ins
                    inner join filial as f on  ins.filial=f.id
                    where ins.operador = ? AND MONTH(ins.fecha) = MONTH(CURRENT_DATE())
                    order by fecha desc;';

            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$operador,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function buscar($cod){
        try {
            $sql = 'SELECT 
                    ins.id, ins.fecha, ins.operador,f.nombre as filial,ins.os,ins.abonado,ins.codabonado,ins.caja,ins.borne,ins.precinto,ins.mac
                    FROM instalacionftth as ins
                    inner join filial as f on  ins.filial=f.id
                    where ins.id =?';
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$cod,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function registrar_InstalacionEoC($data){
        try {
            $sql = "INSERT INTO `instalacioneoc`(`filial`, `operador`, `codigo`, `nodo`, `mac`, `vlan`, `speed`, `coordenada`,`fecha`,`os`) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$data['filial'],PDO::PARAM_STR);
            $stmt->bindParam(2,$data['operador'],PDO::PARAM_STR);
            $stmt->bindParam(3,$data['abonado'],PDO::PARAM_STR);
            $stmt->bindParam(4,$data['nodo'],PDO::PARAM_STR);
            $stmt->bindParam(5,$data['mac'],PDO::PARAM_STR);
            $stmt->bindParam(6,$data['vlan'],PDO::PARAM_STR);
            $stmt->bindParam(7,$data['speed'],PDO::PARAM_STR);
            $stmt->bindParam(8,$data['coordenada'],PDO::PARAM_STR);
            $stmt->bindParam(9,$data['fecha'],PDO::PARAM_STR);
            $stmt->bindParam(10,$data['os'],PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function ListarInstalacionEoC($operador){
        try {
            $sql = 'SELECT io.id,f.nombre as filial,io.operador,io.codigo,
                    io.nodo, io.mac, io.vlan, io.speed, io.coordenada, io.fecha,io.os
                    FROM instalacioneoc as io
                    INNER JOIN filial as f on f.id=io.filial
                    where io.operador = ? AND MONTH(io.fecha) = MONTH(CURRENT_DATE())
                    order by io.fecha desc;';

            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$operador,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function Editar_Fo($data){
        try {
            $sql = "INSERT INTO `instalacioneoc`(`filial`, `operador`, `codigo`, `nodo`, `mac`, `vlan`, `speed`, `coordenada`,`fecha`,`os`) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$data['filial'],PDO::PARAM_STR);
            $stmt->bindParam(2,$data['operador'],PDO::PARAM_STR);
            $stmt->bindParam(3,$data['abonado'],PDO::PARAM_STR);
            $stmt->bindParam(4,$data['nodo'],PDO::PARAM_STR);
            $stmt->bindParam(5,$data['mac'],PDO::PARAM_STR);
            $stmt->bindParam(6,$data['vlan'],PDO::PARAM_STR);
            $stmt->bindParam(7,$data['speed'],PDO::PARAM_STR);
            $stmt->bindParam(8,$data['coordenada'],PDO::PARAM_STR);
            $stmt->bindParam(9,$data['fecha'],PDO::PARAM_STR);
            $stmt->bindParam(10,$data['os'],PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function Actualizar_Sn_Abonado($data){

        try {
            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d H:i:s');
            $fechaactual = $fecha;
            $sql = 'CALL registrarInstalcionFtth (?,?,?,?,?,?,?,?,?,?)';
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->bindParam(1,$fechaactual,PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return 'ok';
            }else {
                return 'fallo';
            }

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }

    }
}