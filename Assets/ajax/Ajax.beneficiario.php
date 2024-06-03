
<?php
//controlador
require_once('../../Controllers/Controller.beneficiario.php');

//Modelo
require_once('../../Model/Modelo.beneficiario.php');


class ajax_beneficiario
{
    public $id;
    public $nombre;
    public $accion;

    public function ajax_registrar_benficiario()
    {
        if ($this->accion=='registro_beneficiario') {
            $data = array(
                'nombre_beneficiario' =>$this->nombre
            );
            $response = controller_beneficiario::controller_agregar_beneficiario($data);
            echo $response;
        }
    }

    //listar
    public function ajax_listar_beneficiario(){
        if ($this->accion=='listar_beneficiario') {
            $response = controller_beneficiario::controller_listar();
            $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idbeneficiario" => "--",
                    "nombre" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_buscar_editar_benef' idbeneficiario='".$value['idbeneficiario']."' data-toggle='modal' data-target='#modal_editar_beneficiario'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_benef' id_bf='".$value['idbeneficiario']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idbeneficiario" => $value['idbeneficiario'],
                        "nombre" =>  $value['nombre'],
                        "acciones" =>  $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    //ELIMINAR

    public function ajax_eliminar_empleado(){
        if ($this->accion=='eliminarB') {
            $data = array(
                'idbenef'=>$this->id
            );
            $response = controller_beneficiario::controller_eliminar_beneficiario($data);
            echo $response;
        }
    }

    public function ajax_buscar_beneficiario(){
        if ($this->accion == 'buscar_beneficiario') {
            $response = controller_beneficiario::controller_buscar_beneficiario($this->id);
            echo json_encode($response);
        }
    }

    public function ajax_editar_beneficiario(){
        if ($this->accion == 'editar_beneficiario') {
            $data = array(
                'id_beneficiario'               => $this->id,
                'editar_nombre_beneficiario'    => $this->nombre
            );
            $response = controller_beneficiario::controller_editar_beneficiario($data);
            echo $response;
        }
    }

}

if (isset($_POST['registro_beneficiario'])) {
    $res = new ajax_beneficiario();
    $res->accion = $_POST['registro_beneficiario'];
    $res->nombre = $_POST['nombre_beneficiario'];
    $res->ajax_registrar_benficiario();
}

if (isset($_POST['listar_beneficiario'])) {
    $res = new ajax_beneficiario();
    $res->accion = $_POST['listar_beneficiario'];
    $res->ajax_listar_beneficiario();
    
}
//ELIMINAR
if (isset($_POST['eliminar_beneficiario'])) { //
    $res = new ajax_beneficiario();
    $res->accion = $_POST['eliminar_beneficiario']; //accion= 'te quirerop',
    $res->id = $_POST['idbeneficiario'];
    $res->ajax_eliminar_empleado();
    
}

//BUSCAR
if (isset($_POST['buscar_beneficiario'])) { //
    $res = new ajax_beneficiario();
    $res->accion = $_POST['buscar_beneficiario']; 
    $res->id = $_POST['idbeneficiario'];
    $res->ajax_buscar_beneficiario();
    
}

//EDITAR   
if (isset($_POST['editar_beneficiario'])) { //
    $res = new ajax_beneficiario();
    $res->accion = $_POST['editar_beneficiario']; //accion= 'te quirerop',
    $res->id = $_POST['m_benef_edit_id'];
    $res->nombre = $_POST['m_benef_edit_nombre'];
    $res->ajax_editar_beneficiario();
    
}
