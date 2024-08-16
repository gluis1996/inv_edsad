<?php

//controlador
require_once('../../Controllers/Controller.equipo.php');
require_once('../../Controllers/Controller.marca.php');
//Modelo
require_once('../../Model/Modelo.equipo.php');
require_once('../../Model/Modelo.marca.php');


class ajax_equipo{
    public $accion;
    public $id_equipo;
    public $modelo;
    public $descripcion;
    public $fecha_registro;
    public $idmarca;

    public function ajax_lista_equipo(){
        if ($this->accion = 'listar_equipo') {
            $response = controller_equipo::c_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idequipos" => "--",
                    "modelo" => "--",
                    "descripcion" => "--",
                    "fecha_registro" => "--",
                    "nombre" => "--", 
                    "cantidad" => "--", 
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $idequipo = "idequipo_".$value['idequipos'];
                    $idequipo_eliminar = "idequipoeliminar_".$value['idequipos'];

                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_modal_editar_equipo' id='{$idequipo}' idequipo='{$value['idequipos']}'><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger' id='{$idequipo_eliminar}' id_eliminar_eqp='{$value['idequipos']}'><i class='fas fa-trash-alt'></i></button><button type='button' class='btn btn-info btn_buscar_equipo_empleado' idequipo='{$value['idequipos']}' data-toggle='modal' data-target='#modal_lista_usuario_equipo'><i class='fas fa-list'></i></button></div>";


                    $datosjason['data'][] = array(
                        "idequipos" => $value['idequipos'],
                        "modelo" =>  $value['modelo'],
                        "descripcion" =>  $value['descripcion'],
                        "fecha_registro" =>  $value['fecha_registro'],
                        "nombre" =>  $value['nombre'],
                        "cantidad" => $value['cantidad'],
                        "acciones" => $botones
                    );
                }
            }
            
            echo json_encode($datosjason);

        }
    }

    public function ajax_equipo_listarmarca(){
        if ($this->accion== 'equipos_llenar_select_marca') {
            $response = controller_marca::c_marca_listar();
            echo json_encode($response);
        }
    }
    public function ajax_equipo_registrar_equipo(){
        if ($this->accion== 'registrar_equipo') {
            $data = array(
                'p_modelo' => $this->modelo,
                'p_descripcion' => $this->descripcion,
                'p_fecha_registro' => $this->fecha_registro,
                'p_idmarca' => $this->idmarca
            );

            $response = controller_equipo::c_registrar($data);
            echo $response;
        }
    }


    public function ajax_equipo_editar_equipo(){
        if ($this->accion== 'editar_equipo') {
            $data = array(
                'p_idequipos' => $this->id_equipo,
                'p_modelo' => $this->modelo,
                'p_descripcion' => $this->descripcion,
                'p_fecha_registro' => $this->fecha_registro,
                'p_idmarca' => $this->idmarca
            );

            $response = controller_equipo::c_editar($data);
            echo $response;
        }
    }


    public function ajac_equipo_registrar_marca(){
        if ($this->accion== 'registrar_equipo_marca') {
            $data = array(
                'p_marca' => $this->idmarca
            );

            $response = controller_marca::c_marca_registrar($data);
            echo $response;
        }
    }
    public function ajac_buscar_equipo_marca(){
        if ($this->accion== 'buscar_equipo_marca') {
            $data = array(
                'idequipos' => $this->id_equipo
            );

            $response = controller_equipo::c_buscar($data);
            echo json_encode($response);
        }
    }


    public function ajax_equipo_eliminar_equipo(){
        if ($this->accion== 'eliminar_equipo') {
            $data = array('idequipos' => $this->id_equipo);
            $response = controller_equipo::c_eliminar($data);
            echo $response;
        }
    }

    public function ajax_equipo_empleado(){
        if ($this->accion== 'buscar_equipo_empleado') {
            $response = controller_equipo::c_buscar_equipo_empleado($this->id_equipo);
            $data = array('data' => $response);
            echo json_encode($data);
        
    }
    }
}


if (isset($_POST['listar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['listar_equipo'];
    $res->ajax_lista_equipo();
}

if (isset($_POST['equipos_llenar_select_marca'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['equipos_llenar_select_marca'];
    $res->ajax_equipo_listarmarca();
}


if (isset($_POST['registrar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['registrar_equipo'];
    $res->modelo = $_POST['e_modelo'];
    $res->descripcion = $_POST['e_descripcion'];
    $res->fecha_registro = $_POST['e_fecha'];
    $res->idmarca = $_POST['e_marca'];
    $res->ajax_equipo_registrar_equipo();
}

if (isset($_POST['registrar_equipo_marca'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['registrar_equipo_marca'];
    $res->idmarca = $_POST['e_marca'];
    $res->ajac_equipo_registrar_marca();
}

if (isset($_POST['buscar_equipo_marca'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['buscar_equipo_marca'];
    $res->id_equipo = $_POST['id_equipo'];
    $res->ajac_buscar_equipo_marca();
}

if (isset($_POST['editar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['editar_equipo'];
    $res->id_equipo = $_POST['idequipos'];
    $res->modelo = $_POST['e_modelo'];
    $res->descripcion = $_POST['e_descripcion'];
    $res->fecha_registro = $_POST['e_fecha'];
    $res->idmarca = $_POST['e_marca'];
    $res->ajax_equipo_editar_equipo();
}

if (isset($_POST['eliminar_equipo'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['eliminar_equipo'];
    $res->id_equipo = $_POST['idequipos'];
    $res->ajax_equipo_eliminar_equipo();
}

if (isset($_POST['buscar_equipo_empleado'])) {
    $res = new ajax_equipo();
    $res->accion = $_POST['buscar_equipo_empleado'];
    $res->id_equipo = $_POST['idequipos'];
    $res->ajax_equipo_empleado();
}


