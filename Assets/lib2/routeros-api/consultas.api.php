<?php
require('../routeros_api.class.php');

class consultasApi{

    public static function bucar_name_conexion($ip) {
        

    $API = new RouterosAPI();

    if ($API->connect($ip, 'lgonzalo', 'gonzalo')) {

        $API->write('/ppp/active/print');

        $READ = $API->read(false);
        $ARRAY = $API->parseResponse($READ);

        $resjs = json_encode($ARRAY);

        return $resjs;

        $API->disconnect();

    } else {
        return "Error al conectar a MikroTik.";
    }
        }


}