<?php
require_once('../../Controllers/Controller_Incidencias/Controller.Incidencias.Tickets.php');

require_once('../../Model/Model_Incidencias/Modelo.Incidencias.tickets.php');
require_once('../../Model/Model_Incidencias/Modelo.Incidencias.ticket_comments.php');


class ajax_incidencias_tickets{

    public $accion;
    public $id_tickets;

    public function ajax_listar_incidencias() {
        if ($this->accion == "listar_tickets") {
            $res = controller_tickets::C_Listar();
            echo json_encode($res);
            //echo "gonzalo";
        }
    }
    
    public function ajax_detalle_incidencias() {
        if ($this->accion == "listar_tickets_detalle") {
            $res = controller_tickets::C_buscar($this->id_tickets);
            echo json_encode($res);
            //echo "gonzalo";
        }
    }

}

if (isset($_POST["listar_tickets"])) {
    $res = new ajax_incidencias_tickets();
    $res->accion = $_POST["listar_tickets"];
    $res->ajax_listar_incidencias();
}

if (isset($_POST["listar_tickets_detalle"])) {
    $res = new ajax_incidencias_tickets();
    $res->accion        = $_POST["listar_tickets_detalle"];
    $res->id_tickets    = $_POST["detalle_id_tickets"];
    $res->ajax_detalle_incidencias();
}