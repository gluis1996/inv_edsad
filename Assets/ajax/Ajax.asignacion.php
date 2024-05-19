<?php
//controlador
require_once ('../../Controllers/Controller.asignacion.php');
require_once ('../../Controllers/Controlller.sede.php');
require_once ('../../Controllers/Controller.oficina.php');
require_once ('../../Controllers/Controller.equipo.php');
require_once ('../../Controllers/Controller.empleado.php');

//Modelo
require_once ('../../Model/Modelo.detalleAsignacion.php');
require_once ('../../Model/Modelo.sede.php');
require_once ('../../Model/Modelo.oficina.php');
require_once ('../../Model/Modelo.equipo.php');
require_once ('../../Model/Modelo.empleado.php');

class ajax_asignacion{

    public $accion;
    public $id_sede;
    public $idoficinas;
    public $idequipos;
    public $idusuario;
    public $idempleado;
    public $cod_patrimonial;
    public $vida_util;
    public $estado;
    public $fecha_asignacion;

    public function ajax_listar(){
        if ($this->accion == 'listarAE') {
            $response = controller_asignacion::c_listar();
            
            $datosjason = array();
        
                if (empty($response)) {
                    $datosjason['data'][] = array(
                        "id_detalle_asignacion" => "--",
                        "sede_nombres" => "--",
                        "oficina_nombres" => "--",
                        "equipo" => "--",
                        "usuario_nombre" => "--", 
                        "empleado_nombre" => "--",
                        "cod_patrimonial" => "--",
                        "vida_util" => "--",
                        "estado" => "--",
                        "fecha_asignacion" => "--",
                        "acciones" => "--"
                    );
                } else {
                    foreach ($response as $value) {
                        $unique_id = "detalle_id_" . $value['id_detalle_asignacion'];
                        $botones = "<div class='col'><button type='button' class='btn btn-primary btn_raddact' id='".$unique_id."' ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btnEliminarRadius' id='".$unique_id."' ><i class='fas fa-trash-alt'></i></button></div>";

                        $datosjason['data'][] = array(
                            "id_detalle_asignacion" => $value['id_detalle_asignacion'],
                            "sede_nombres" => $value['sede_nombres'],
                            "oficina_nombres" => $value['oficina_nombres'],
                            "equipo" => $value['equipo'],
                            "usuario_nombre" => $value['usuario_nombre'],
                            "empleado_nombre" => $value['empleado_nombre'],
                            "cod_patrimonial" => $value['cod_patrimonial'],
                            "vida_util" => $value['vida_util'],
                            "estado" => $value['estado'],
                            "fecha_asignacion" => $value['fecha_asignacion'],
                            "acciones" => $botones
                        );
                    }
                }
                echo json_encode($datosjason);

        }
    }

    public function ajax_asignacion_registrar(){

        if ($this->accion == 'as_registrar') {
            $data = array(
                'p_idsedes' => $this->id_sede,
                'p_idoficinas' => $this->idoficinas,
                'p_idequipos' => $this->idequipos,
                'p_idusuario' => $this->idusuario,
                'p_idempleado' => $this->idempleado,
                'p_cod_patrimonial' => $this->cod_patrimonial,
                'p_vida_util' => $this->vida_util,
                'p_estado' => $this->estado,
                'p_fecha_asignacion' => $this->fecha_asignacion
            );
            $res = controller_asignacion::c_registras_detalleasignacion($data);
            echo $res;

        }
    }

    public function ajax_listar_sede(){
        if ($this->accion == 'listar_sede_en_select') {
            $response = controller_sede::controller_listar();
            echo json_encode($response);
        }
    }
    
    public function ajax_listar_oficinas(){
        if ($this->accion == 'listar_oficinas_por_sede') {
            $response = controller_oficina::c_listar_oficina($this->id_sede);
            echo json_encode($response);
        }
    }

    public function ajax_lista_equipo(){
        if ($this->accion == 'listar_equipo') {
            $response = controller_equipo::c_listar();
            echo json_encode($response);
        }
    }

    public function ajax_lista_empleado(){
        if ($this->accion == 'listar_empleado') {
            $response = controller_empleado::c_listar();
            echo json_encode($response);
        }
    }

}

if (isset($_POST['listarAE'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listarAE'];
    $res->ajax_listar();
}

if (isset($_POST['listar_sede_en_select'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_sede_en_select'];
    $res->ajax_listar_sede();
}

if (isset($_POST['listar_oficinas_por_sede'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_oficinas_por_sede'];
    $res->id_sede = $_POST['id_sede'];
    $res->ajax_listar_oficinas();
}

if (isset($_POST['listar_equipo'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_equipo'];
    $res->ajax_lista_equipo();
}

if (isset($_POST['listar_empleado'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['listar_empleado'];
    $res->ajax_lista_empleado();
}

if (isset($_POST['as_registrar'])) {
    $res = new ajax_asignacion();
    $res->accion = $_POST['as_registrar'];
    $res->id_sede = $_POST['idsede'];
    $res->idoficinas = $_POST['id_oficina'];
    $res->idequipos = $_POST['id_equipo'];
    $res->idusuario = $_POST['id_usuario'];
    $res->idempleado = $_POST['id_empleado'];
    $res->cod_patrimonial = $_POST['cod_patrimonial'];
    $res->vida_util = $_POST['vid_util'];
    $res->estado = $_POST['id_estado'];
    $res->fecha_asignacion = $_POST['fecha'];
    $res->ajax_asignacion_registrar();
}