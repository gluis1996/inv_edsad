
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
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_listar_equipo_empleado' idbeneficiario='".$value['idbeneficiario']."' data-toggle='modal' data-target='#modal_listar_empleado'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_benef' id_bf='".$value['idbeneficiario']."' ><i class='fas fa-trash-alt'></i></button></div>";

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
