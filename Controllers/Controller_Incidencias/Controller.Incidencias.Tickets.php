<?php

class controller_tickets
{

    public static function C_Listar()
    {
        $reesponse = modelo_incidencias_tickets::model_listar();
        return $reesponse;
    }

    public static function C_buscar($data)
    {
        $response           = modelo_incidencias_tickets::model_buscar($data);
        $usuario            = modelo_usuario::model_buscar(3);
        $response_comment   = modelo_incidencias_ticket_comments::buscar($data);

        $res = array(
            'tickets' => $response,
            'comment' => $response_comment,
            'usuario' => $usuario,

        );
        return $res;
    }

    public static function C_actualizar_estado($data)
    {
        $response           = modelo_incidencias_tickets::model_actualizar_estado($data);
        return $response;
    }

    public static function C_agregar($data)
    {
        $validacion = modelo_incidencias_tickets::validar_existencia_estado($data['p_equipment_id']);
        if ($validacion >= 1) {
            // Si existe, devolver mensaje de advertencia
            return 'El equipment_id ya existe con estado "abierto" o "en proceso".';
        }else if ($validacion == 0) {
            $response = modelo_incidencias_tickets::model_agregar($data);
            return $response;
        }
        
    }

    public static function C_eliminar($data)
    {
        $response           = modelo_incidencias_tickets::model_eliminar($data);
        return $response;
    }
}
