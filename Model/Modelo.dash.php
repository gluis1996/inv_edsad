<?php 
require_once ('conexion.php');

class ModeloDashBoard{

    public static function listar_instalaciones_fibra() {
        try {
            $sql = "SELECT 
                    ins.id, ins.fecha, ins.operador,f.nombre as filial,ins.os,ins.abonado,ins.codabonado,ins.caja,ins.borne,ins.precinto,ins.mac
                    FROM instalacionftth as ins
                    inner join filial as f on  ins.filial=f.id
                    order by fecha desc;";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de Tecnologia ".$e->getMessage();
        }
    }

    public static function listar_instalaciones_eoc() {
        try {
            $sql = "SELECT io.id,f.nombre as filial,io.operador,io.codigo as abonado,
                    io.nodo as codabonado, io.mac, io.vlan, io.speed, io.coordenada, io.fecha,io.os
                    FROM instalacioneoc as io
                    INNER JOIN filial as f on f.id=io.filial
                    order by io.fecha desc;";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de Tecnologia ".$e->getMessage();
        }
    }

    public static function listar_atenciones() {
        try {
            $sql = "SELECT * FROM integracionesolt.averias;";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de Tecnologia ".$e->getMessage();
        }
    }


}
