<?php
//controlador
require_once ('../../Controllers/Controller.empleado.php');

//Modelo
require_once ('../../Model/Modelo.empleado.php');


class ajax_empleado{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_empleado(){
        if ($this->accion=='registro_empleado') {
            $data = array(
                'empleado_nombre'=> $this->nombre
            );

            $response = controller_empleado::c_insertar_empleado($data);
            echo $response;
        }

    }

    public function ajax_listar_empleado(){
        if ($this->accion=='lista_empleado') {
           $response = controller_empleado::c_listar();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idempleado" => "--",
                    "nombres" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' id_empleado='".$value['idempleado']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_empleado' id_empleado_el='".$value['idempleado']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idempleado" => $value['idempleado'],
                        "nombres" =>  $value['nombres'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_listar_equipo_empleado(){
        if ($this->accion=='listar_equipo_empleado') {
            $data = array(
                'idempleado'=>$this->id
            );
           $response = controller_empleado::c_listar_equipo_empleado($data);
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idempleado" => "--",
                    "nombre_empleado" => "--",
                    "nombre_equipo" => "--",
                    "id_detalle_asignacion" => "--",
                    "cod_patrimonial" => "--",
                    "nombre_sede" => "--",
                    "nombre_oficina" => "--"
                );
            } else {
                foreach ($response as $value) {
                    
                    $datosjason['data'][] = array(
                        "idempleado" => $value['idempleado'],
                        "nombre_empleado" => $value['nombre_empleado'],
                        "nombre_equipo" => $value['nombre_equipo'],
                        "id_detalle_asignacion" => $value['id_detalle_asignacion'],
                        "cod_patrimonial" => $value['cod_patrimonial'],
                        "nombre_sede" => $value['nombre_sede'],
                        "nombre_oficina" => $value['nombre_oficina']
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }


    
    public function ajax_eliminar_empleado(){
        if ($this->accion=='te_extraño') {
            $data = array(
                'tambien_te_Extraña'=>$this->id
            );
            $response = controller_empleado::c_eliminar_empleado($data);
            echo $response;
        }
    }

}


if (isset($_POST['registro_empleado'])) {
    $res = new ajax_empleado();
    $res->accion = $_POST['registro_empleado'];
    $res->nombre = $_POST['nombre_empleado'];
    $res->ajax_registrar_empleado();
    
}
//listar
if (isset($_POST['lista_empleado'])) {
    $res = new ajax_empleado();
    $res->accion = $_POST['lista_empleado'];
    $res->ajax_listar_empleado();
    
}

if (isset($_POST['listar_equipo_empleado'])) {
    $res = new ajax_empleado();
    $res->accion = $_POST['listar_equipo_empleado'];
    $res->id = $_POST['idempleado'];
    $res->ajax_listar_equipo_empleado();
    
}
//eliminar
if (isset($_POST['id_eliminar_empleado'])) { //
    $res = new ajax_empleado();
    $res->accion = $_POST['id_eliminar_empleado']; //accion= 'te quirerop',
    $res->id = $_POST['idempleado'];
    $res->ajax_eliminar_empleado();
    
}

