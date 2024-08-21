<?php
//controlador
require_once('../../Controllers/Controller.empleado.php');
require_once('../../Controllers/Controller.cargo.php');
require_once('../../Controllers/Controller.tipo_contrato.php');
require_once('../../Controllers/Controller.direccion.php');

//Modelo
require_once('../../Model/Modelo.empleado.php');
require_once('../../Model/Modelo.cargo.php');
require_once('../../Model/Modelo.tipocontrato.php');
require_once('../../Model/Modelo.direccion.php');


class ajax_empleado
{
    public $id;
    public $nombre;
    public $apellido;
    public $dni;
    public $fecha_cumpleaños;
    public $mes_cumpleaños;
    public $numero_personal;
    public $correo_personal;
    public $correo_institucional;
    public $id_cargo;
    public $id_direccion_oficiona;
    public $id_tipo_contrato;
    public $accion;
    public $varp;

    public function ajax_registrar_empleado(){
        if ($this->accion == 'registro_empleado') {
            $data = array(
                'p_nombres'                 => $this->nombre,
                'p_apellidos'               => $this->apellido,
                'p_dni'                     => $this->dni,
                'p_fecha_cumpleaños'        => $this->fecha_cumpleaños,
                'p_mes_cumpleaños'          => $this->mes_cumpleaños,
                'p_numero_personal'         => $this->numero_personal,
                'p_correo_personal'         => $this->correo_personal,
                'p_correo_institucional'    => $this->correo_institucional,
                'p_idcargo'                 => $this->id_cargo,
                'p_iddireccion_oficina'     => $this->id_direccion_oficiona,
                'p_idtipo_contrato'         => $this->id_tipo_contrato
            );

            $response = controller_empleado::c_insertar_empleado($data);
            echo $response;
        }
    }

    public function ajax_listar_empleado(){
        if ($this->accion == 'lista_empleado') {
            $response = controller_empleado::c_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idempleado" => "--",
                    "nombres" => "--",
                    "dni" =>  "--",
                    "numero" =>  "--",
                    "correo" =>  "--",
                    "cargo" =>  "--",
                    "direccion" =>  "--",
                    "contrato" => "--",
                    "cantidad" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $unique_id = "id_empleado_buscar_" . $value['idempleado'];
                    $botones = "<div class='form-row' style='display: flex; gap: 5px;' ><button type='button' class='btn btn-primary btn_buscar_empleado btn-sm' id ='".$unique_id."' id_empleado='".$value['idempleado']."' data-toggle='modal' data-target='#modal_editar_empleado' ><i class='fas fa-pencil-alt' aria-hidden='true'></i></button> <button type='button' class='btn btn-primary btn_listar_equipo_empleado btn-sm' nombre_empleado ='".$value['nombres']."' id_empleado='" . $value['idempleado'] . "' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-list'></i></button><button type='button' class='btn btn-danger btn_eliminar_empleado btn-sm' id_empleado_el='" . $value['idempleado'] . "' ><i class='fas fa-trash-alt'></i></button></div>";
                    $correo = 'per: '.$value['correo_personal']."<br>".'inst: '.$value['correo_institucional'];
                    $datosjason['data'][] = array(
                        "idempleado" => $value['idempleado'],
                        "nombres" =>  $value['nombres'],
                        "dni" =>  $value['dni'],
                        "numero" =>  $value['numero_personal'],
                        "correo" =>  $correo,
                        "cargo" =>  $value['nombre_cargo'],
                        "direccion" =>  $value['nombre_direccion'],
                        "contrato" =>  $value['nombre_tipo_contrato'],
                        "cantidad" =>  $value['cantidad'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_listar_equipo_empleado()
    {
        if ($this->accion == 'listar_equipo_empleado') {
            $data = array(
                'idempleado' => $this->id
            );
            $response = controller_empleado::c_listar_equipo_empleado($data);
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idempleado"                => "--",
                    "nombre_empleado"           => "--",
                    "nombre_equipo"             => "--",
                    "id_detalle_asignacion"     => "--",
                    "cod_patrimonial"           => "--",
                    "nombre_sede"               => "--",
                    "nombre_oficina"            => "--"
                );
            } else {

                foreach ($response as $value) {

                    $datosjason['data'][] = array(
                        "idempleado"            => $value['idempleado'],
                        "nombre_empleado"       => $value['nombre_empleado'],
                        "nombre_equipo"         => $value['nombre_equipo'],
                        "id_detalle_asignacion" => $value['id_detalle_asignacion'],
                        "cod_patrimonial"       => $value['cod_patrimonial'],
                        "nombre_sede"           => $value['nombre_sede'],
                        "nombre_oficina"        => $value['nombre_oficina']
                    );
                }
            }

            echo json_encode($datosjason);
        }
    }



    public function ajax_eliminar_empleado()
    {
        if ($this->accion == 'te_extraño') {
            $data = array(
                'tambien_te_Extraña' => $this->id
            );
            $response = controller_empleado::c_eliminar_empleado($data);
            echo $response;
        }
    }

    //lista dato de la tabla cargo

    public function ajax_lista_cargo()
    {
        if ($this->accion == 'llenar_campo_cargo') {
            $response = controller_cargo::c_listar();
            echo json_encode($response);
        }
    }

    public function ajax_lista_tipo_contrato()
    {
        if ($this->accion == 'llenar_campo_tipo_contrato') {
            $response = controller_tipo_contrato::c_listar();
            echo json_encode($response);
        }
    }
    public function ajax_lista_direccion_oficina()
    {
        if ($this->accion == 'llenar_campo_direccion_oficina') {
            $response = controller_direccion::c_listar();
            echo json_encode($response);
        }
    }

    public function ajax_buscar_empleado(){            
        if ($this->accion == 'buscar_empleado_codigo') {           
            $response = controller_empleado::c_buscar_empleado($this->id);
            echo json_encode($response);
        }

    }

    public function ajax_buscar_empleado_dni(){            
        if ($this->accion == 'buscar_empleado_dni') {           
            $response = controller_empleado::c_buscar_empleado_dni($this->id);
            echo json_encode($response);
        }

    }

    public function ajax_editar_empleado(){            
        if ($this->accion == 'empleado_editar') {           
            $response = controller_empleado::c_editar_empleado($this->varp);
            echo json_encode($response);
        }

    }

}


if (isset($_POST['registro_empleado'])) {
    $res = new ajax_empleado();
    $res->accion                        = $_POST['registro_empleado'];
    $res->nombre                        = $_POST['p_nombres'];
    $res->apellido                      = $_POST['p_apellidos'];
    $res->dni                           = $_POST['p_dni'];
    $res->fecha_cumpleaños              = $_POST['p_fecha_cumpleaños'];
    $res->mes_cumpleaños                = $_POST['p_mes_cumpleaños'];
    $res->numero_personal               = $_POST['p_numero_personal'];
    $res->correo_personal               = $_POST['p_correo_personal'];
    $res->correo_institucional          = $_POST['p_correo_institucional'];
    $res->id_cargo                      = $_POST['p_idcargo'];
    $res->id_direccion_oficiona         = $_POST['p_iddireccion_oficina'];
    $res->id_tipo_contrato              = $_POST['p_idtipo_contrato'];
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
    $res->accion = $_POST['id_eliminar_empleado'];
    $res->id = $_POST['idempleado'];
    $res->ajax_eliminar_empleado();
}

//Llenar datos al campo de select cargo
if (isset($_POST['llenar_campo_cargo'])) { //
    $res = new ajax_empleado();
    $res->accion = $_POST['llenar_campo_cargo'];
    $res->ajax_lista_cargo();
}

//Llenar datos al campo de select contrato
if (isset($_POST['llenar_campo_tipo_contrato'])) { //
    $res = new ajax_empleado();
    $res->accion = $_POST['llenar_campo_tipo_contrato'];
    $res->ajax_lista_tipo_contrato();
}


//Llenar datos al campo de select oficina
if (isset($_POST['llenar_campo_direccion_oficina'])) { //
    $res = new ajax_empleado();
    $res->accion = $_POST['llenar_campo_direccion_oficina'];
    $res->ajax_lista_direccion_oficina();
}

//buscar empleado por codigo
if (isset($_POST['buscar_empleado_codigo'])) { 
    $res = new ajax_empleado();
    $res->accion = $_POST['buscar_empleado_codigo'];
    $res->id     = $_POST['codigo_empleado'];
    $res->ajax_buscar_empleado();
}

//buscar empleado por codigo
if (isset($_POST['buscar_empleado_dni'])) { 
    $res = new ajax_empleado();
    $res->accion = $_POST['buscar_empleado_dni'];
    $res->id     = $_POST['dni_empleado'];
    $res->ajax_buscar_empleado_dni();
}

//editar empleado por codigo
if (isset($_POST['empleado_editar'])) { 
    $res = new ajax_empleado();
    $res->accion = $_POST['empleado_editar'];
    $res->varp   = $_POST['valor'];
    $res->ajax_editar_empleado();
}