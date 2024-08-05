<?php
require_once('../../Controllers/Controller_Incidencias/Controller.Incidencias.Tickets.php');
require_once('../../Controllers/Controller_Incidencias/Controller.Incidencias.activity.php');

require_once('../../Model/Model_Incidencias/Modelo.Incidencias.tickets.php');
require_once('../../Model/Model_Incidencias/Modelo.Incidencias.ticket_comments.php');
require_once('../../Model/Model_Incidencias/Modelo.Incidencias.activity.php');


class ajax_incidencias_tickets{

    public $accion;
    public $id_tickets;
    public $datos;

    //comentario

    public function ajax_listar_incidencias() {
        if ($this->accion == "listar_tickets") {
            $res = controller_tickets::C_Listar();
            $data = array('data' => $res);
            echo json_encode($data);
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
    
    public function ajax_detalle_actividad_tickets() {
        if ($this->accion == "listar_tickets_activity") {
            $res = controller_tickets_activity::C_buscar($this->id_tickets);
            echo json_encode($res);
            //echo "gonzalo";
        }
    }
    
    public function ajax_cambiar_estado_tickets() {
        if ($this->accion == "event_actualizar_estado") {
            $res = controller_tickets::C_actualizar_estado($this->datos);
            echo json_encode($res);
            //echo "gonzalo";
        }
    }
    
    public function ajax_registrar_tickets() {
        if ($this->accion == "event_ticket_registrar") {
            $res = controller_tickets::C_agregar($this->datos);
            echo json_encode($res);
        }
    }
    
    public function ajax_eliminar_tickets() {
        if ($this->accion == "event_eliminar_ticket") {
            $res = controller_tickets::C_eliminar($this->datos);
            echo json_encode($res);
        }
    }
    
    public function ajax_actualizar_tickets() {
        if ($this->accion == "event_asignar_ticket") {
            $res = controller_tickets::C_actualizar_estado($this->datos);
            echo json_encode($res);
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

if (isset($_POST["listar_tickets_activity"])) {
    $res = new ajax_incidencias_tickets();
    $res->accion        = $_POST["listar_tickets_activity"];
    $res->id_tickets    = $_POST["detalle_id_tickets_activity"];
    $res->ajax_detalle_actividad_tickets();
}

if (isset($_POST["event_actualizar_estado"])) {
    $res = new ajax_incidencias_tickets();
    $res->accion        = $_POST["event_actualizar_estado"];
    $res->datos         = $_POST["datos"];
    $res->ajax_cambiar_estado_tickets();
}

if (isset($_POST['event_ticket_registrar'])) {
    $res            =   new ajax_incidencias_tickets();
    $res->accion    = $_POST['event_ticket_registrar'];
    $res->datos     = $_POST['datos'];
    $res->ajax_registrar_tickets();
}

if (isset($_POST['event_eliminar_ticket'])) {
    $res            =   new ajax_incidencias_tickets();
    $res->accion    = $_POST['event_eliminar_ticket'];
    $res->datos     = $_POST['id_ticket'];
    $res->ajax_eliminar_tickets();
}

if (isset($_POST['event_asignar_ticket'])) {
    $res            =   new ajax_incidencias_tickets();
    $res->accion    = $_POST['event_asignar_ticket'];
    $res->datos     = $_POST['datos'];
    $res->ajax_actualizar_tickets();
}
