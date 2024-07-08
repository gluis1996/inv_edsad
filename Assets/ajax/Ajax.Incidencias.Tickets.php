<?php
require_once('../../Controllers/Controller_Incidencias/Controller.Incidencias.Tickets.php');

require_once('../../Model/Model_Incidencias/Modelo.Incidencias.tickets.php');


class ajax_incidencias_tickets{

    public $accion;

    public function ajax_listar_incidencias() {
        if ($this->accion == "listar_tickets") {
            $res = controller_tickets::C_Listar();
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