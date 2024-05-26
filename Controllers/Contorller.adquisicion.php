<?php


class controller_adquisicion{

    public static function c_listar(){
        $response = modelo_adquisicion::m_listar();
        return $response;
    }

    public static function c_registrar($data){
        $response = modelo_adquisicion::m_registrar($data);
        return $response;
    }
    
    public static function c_eliminar($data){
        $response = modelo_adquisicion::m_eliminar($data);
        return $response;
    }
    
    public static function c_editar($data){
        $response = modelo_adquisicion::m_editar($data);
        return $response;
    }
    
    public static function c_buscar($data){
        $response = modelo_adquisicion::m_buscar($data);
        $area = modelo_area::model_listar();
        $bene = modelo_beneficario::model_listar();
        $equi = modelo_equipo::model_listar();
        $meta = modelo_meta::model_listar();

        $data = array(
            'id'        =>$response[0]['id'],
            'area_id'   =>$response[0]['area_id'],
            'bene_id'   =>$response[0]['idbeneficiario'],
            'equi_id'   =>$response[0]['equipo_id'],
            'meta_id'   =>$response[0]['meta_id'],
            'año'       =>$response[0]['año'],
            'cantidad'  =>$response[0]['cantidad'],
            'l_area'    =>$area,
            'l_bene'    =>$bene,
            'l_equi'    =>$equi,
            'l_meta'    =>$meta            
        );
        return $data;

    }

    
}