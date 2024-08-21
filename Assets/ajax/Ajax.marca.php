<?php 
require_once("../../Controllers/Controller.marca.php");

require_once("../../Model/Modelo.marca.php");

class   ajax_marca{
    public $id;
    public $nombre;
    public $acciones;

    public function ajax_marca_lista(){
        if ($this->acciones = 'marca_listar') {
            $response = controller_marca::c_marca_listar();

            $jsom = array();

            if (empty($response)) {
                $jsom['data'][]= array(
                    'idmarca' => '--',
                    'nombre' => '--',
                    'acciones' => '--'
                );
            }else {
                foreach ($response as $value) {
                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_modal_marca_editar' id_marca='".$value['idmarca']."' nombre_marca='".$value['nombre']."' ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_marca' id_marca_del='".$value['idmarca']."'><i class='fas fa-trash-alt'></i></button></div>";
                    $jsom['data'][]= array(
                        'idmarca' => $value['idmarca'],
                        'nombre' => $value['nombre'],
                        'acciones' => $botones 
                    );
                }
            }
            echo json_encode($jsom);
        }
    }

    public function ajax_marca_editar() {
        
        if ($this->acciones == 'marca_editar') {
            $data = array(
                'marca_nombre'=>$this->nombre,
                'marca_id'=>$this->id,
            );

            $response = controller_marca::c_marca_editar($data);
            echo $response;
        }

    }

    public function ajax_marca_eliminar() {
        
        if ($this->acciones == 'evnt_eliminar_marca') {
            $response = controller_marca::c_marca_eliminar($this->id);
            echo $response;
        }

    }

}


if (isset($_POST['marca_listar'])) {
    $res = new ajax_marca();
    $res -> acciones  =$_POST['marca_listar'];
    $res->ajax_marca_lista();
}

if (isset($_POST['marca_editar'])) {
    $res = new ajax_marca();
    $res -> acciones  =$_POST['marca_editar'];
    $res -> nombre  =$_POST['marca_nombre'];
    $res -> id  =$_POST['marca_id'];
    $res->ajax_marca_editar();
}

if (isset($_POST['evnt_eliminar_marca'])) {
    $res = new ajax_marca();
    $res -> acciones  =$_POST['evnt_eliminar_marca'];
    $res -> id  =$_POST['marca_id'];
    $res->ajax_marca_eliminar();
}