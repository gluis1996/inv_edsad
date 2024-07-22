<?php

require_once('../../Controllers/Controller_Incidencias/Controller.Incidencias.comment.php');

require_once('../../Model/Model_Incidencias/Modelo.Incidencias.ticket_comments.php');



class ajax_incidencias_comment{

    public $comment_id; 
    public $ticket_id; 
    public $user_id; 
    public $comment;
    public $created_atmestamp;
    public $accion;


    public function ajax_registrar_comment(){
        if ($this->accion == 'event_registrar_comentario') {
            $response = controller_comment::c_registrar($this->ticket_id);
            echo json_encode($response);

        }
    }


    public function ajax_listar_comment(){
        if ($this->accion = 'event_buscar_comment') {
            $response = controller_comment::c_buscar($this->ticket_id);
            echo json_encode($response);
        }
    }

}

//comentario ticket
//registra commentario

if (isset($_POST["event_registrar_comentario"])) {
    $res = new ajax_incidencias_comment();
    $res->accion                = $_POST["event_registrar_comentario"];
    $res->ticket_id             = $_POST["content"];
    $res->ajax_registrar_comment();
}

//buscar comentario
if (isset($_POST['event_buscar_comment'])) {
    $res = new ajax_incidencias_comment();
    $res->accion                = $_POST["event_buscar_comment"];
    $res->ticket_id             = $_POST["ticket_id"];
    $res->ajax_listar_comment();
}

