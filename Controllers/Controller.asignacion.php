<?php
// require_once "conexion.php";


class controller_asignacion{

    public static function c_listar(){
        $response = modelo_detalleAsignacion::model_listar();
        return $response;
    }

    public static function c_registras_detalleasignacion($data){
        $res = modelo_detalleAsignacion::model_agregar($data);
        return $res;
    }

    public static function c_eliminar_detalleasignacion($data){
        $res = modelo_detalleAsignacion::model_eliminar($data);
        return $res;
    }
    public static function c_actulizar_detalleasignacion($data){
        $res = modelo_detalleAsignacion::model_actualizar($data);
        return $res;
    }
    public static function c_buscar_detalleasignacion($data){
        $res = modelo_detalleAsignacion::model_buscar($data);
        $resemplado = modelo_empleado::model_listar();
        $res_sede = modelo_sede::model_listar();
        $resoficina = modelo_oficina::model_buscar($res[0]['idsedes']);

        $data  =  array(
            'idregistro'=> $res[0]['id_detalle_asignacion'],
            'idempleado'=> $res[0]['idempleado'],
            'idsede'=> $res[0]['idsedes'],
            'idoficina'=> $res[0]['idoficinas'],
            'vidautil'=> $res[0]['vida_util'],
            'estado'=> $res[0]['estado'],
            'usuario'=> $res[0]['usuario_nombre'],
            'fecha'=> $res[0]['fecha_asignacion'],
            'cod_patrimonial'=> $res[0]['cod_patrimonial'],
            'equipo'=> $res[0]['equipo'],
            'empleados' => $resemplado,
            'sede'=> $res_sede,
            'oficina'=> $resoficina,
        );

        return $data;
    }

    



}