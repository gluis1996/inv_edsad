<?php 

require_once('../../Model/Modelo_DashBoard/Modelo.contablizacion.ticket.php');

class ajax_dashboard {
    public $accion;

    public function listar_total_ticket() {
        if ($this->accion == 'dash_total_ticket') {
            $res = modelo_contalizacion_ticket::cantidad_ticket();
            $datos = array('data' => $res);
            echo json_encode($datos);
        }
    }
    public function listar_total_asigando_sede() {
        if ($this->accion == 'dash_total_equipo_sede') {
            $res = modelo_contalizacion_ticket::cantidad_total_por_sede();
            $datos = array('data' => $res);
            echo json_encode($datos);
        }
    }

}

if (isset($_POST['dash_total_equipo_sede'])) {
    $res = new ajax_dashboard();
    $res->accion = $_POST['dash_total_equipo_sede'];
    $res->listar_total_asigando_sede();
}

if (isset($_POST['dash_total_ticket'])) {
    $res = new ajax_dashboard();
    $res->accion = $_POST['dash_total_ticket'];
    $res->listar_total_ticket();
}

