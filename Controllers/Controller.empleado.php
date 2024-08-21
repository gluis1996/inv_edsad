<?php

class controller_empleado{

    public static function c_listar(){
        $res = modelo_empleado::model_listar();
        return $res;
    }


    public static function c_listar_equipo_empleado($data){
        $res = modelo_empleado::model_buscar_equipo_empleado($data);
        return $res;
    }

    public static function c_eliminar_empleado($data){
        $res = modelo_empleado::model_eliminar($data);
        return $res;
    }

    public static function c_insertar_empleado($data){
        $res = modelo_empleado::model_agregar($data);
        return $res;
    }
    public static function c_buscar_empleado($data){
        $res_empleado   = modelo_empleado::model_buscar($data);
        $res_cargo      = modelo_cargo::model_listar();
        $res_direccion  = modelo_direccion::model_listar();
        $res_contrato   = modelo_tipo_contrato::model_listar();
        $resultado_f = array(
            "idempleado"                => $res_empleado[0]['idempleado'],
            "nombres"                   => $res_empleado[0]['nombres'],
            "apellidos"                 => $res_empleado[0]['apellidos'] ,
            "dni"                       => $res_empleado[0]['dni'],
            'fecha_cunpleaños'          => $res_empleado[0]['fecha_cumpleaños'],
            'mes_cumpleaños'            => $res_empleado[0]['mes_cumpleaños'],
            "numero"                    => $res_empleado[0]['numero_personal'],
            "correo_personal"           => $res_empleado[0]['correo_personal'],
            "correo_institucional"      => $res_empleado[0]['correo_institucional'],
            "idcargo"                   => $res_empleado[0]['idcargo'],
            "nombre_cargo"              => $res_cargo,
            "iddireccion_oficina"       => $res_empleado[0]['iddireccion_oficina'],
            "nombre_direccion"          => $res_direccion,
            "idtipo_contrato"           => $res_empleado[0]['idtipo_contrato'],
            "nombre_tipo_contrato"      => $res_contrato,
        );

        return $resultado_f;
    }
    public static function c_editar_empleado($data){
        $response = modelo_empleado::model_actualizar($data);
        return $response;
    }

    public static function c_buscar_empleado_dni($data){
        $response = modelo_empleado::model_buscar_dni($data);
        return $response;
    }

} 