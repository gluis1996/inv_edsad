<?php
require_once('conexion.php');

class modelo_adquisicion{


    public static function m_listar() {
        try {
            $sql = "call sp_listar_detalle_adquisicion();";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $th) {
            return 'Error: '.$th->getMessage();
        }
    }

}
