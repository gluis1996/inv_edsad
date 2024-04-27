<?php
class Filial {


    public static function Listar(){
        try {
            $sql = "SELECT * FROM filial";
            $stmt = conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt-> fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de color ".$e->getMessage();
        }


    }

    public static function card_listar($operador){
        try {
            $sql = "SELECT
                    i.filial,
                    f.nombre,
                    count(abonado) as cantidad
                    from instalacionftth  as i
                    inner join filial as f on f.id=i.filial 
                    where operador = ? AND MONTH(i.fecha) = MONTH(CURRENT_DATE())
                    group by i.filial,f.nombre;
                    ";
            $smtp = conexion::conectar()->prepare($sql);
            $smtp->bindParam(1, $operador,PDO::PARAM_STR);
            $smtp->execute();
            return $smtp->fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de card ".$e->getMessage();
        }
    }


    public static function card_listar_eoc($operador){
        try {
            $sql = "SELECT
                    i.filial,
                    f.nombre,
                    count(codigo) as cantidad
                    from instalacioneoc  as i
                    inner join filial as f on f.id=i.filial 
                    where operador = ? AND MONTH(i.fecha) = MONTH(CURRENT_DATE())
                    group by i.filial,f.nombre;
                    ";
            $smtp = conexion::conectar()->prepare($sql);
            $smtp->bindParam(1, $operador,PDO::PARAM_STR);
            $smtp->execute();
            return $smtp->fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de card ".$e->getMessage();
        }
    }


    public static function card_listar_atenciones($operador){
        try {
            $sql = "SELECT t_orden AS orden_o_area, COUNT(*) AS cantidad
                    FROM averias
                    WHERE operador = ? AND MONTH(fecha) = MONTH(CURRENT_DATE())
                    GROUP BY t_orden
                    UNION ALL
                    SELECT area AS orden_o_area, COUNT(*) AS cantidad
                    FROM averias
                    WHERE operador = ? AND MONTH(fecha) = MONTH(CURRENT_DATE())
                    GROUP BY area;
                    ";
            $smtp = conexion::conectar()->prepare($sql);
            $smtp->bindParam(1, $operador,PDO::PARAM_STR);
            $smtp->bindParam(2, $operador,PDO::PARAM_STR);
            $smtp->execute();
            return $smtp->fetchAll();
        } catch (PDOException $e) {
            return "Erroe en consulta de card ".$e->getMessage();
        }
    }

}

