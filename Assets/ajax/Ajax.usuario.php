<?php
//controlador
require_once ('../../Controllers/controller.usuario.php');

//Modelo
require_once ('../../Model/Modelo.usuario.php');


class ajax_usuario{
    public $id;
    public $nombre;
    public $user;
    public $contraseña;
    public $accion;

    public function ajax_registrar_usuario(){
        if ($this->accion == 'registro_usuario') {
            $data = array (
                'nombre' =>$this->nombre,
                'user' =>$this->user,
                'contraseña' =>$this->contraseña,
                

            );

            $response = controller_usuario::controller_agregar_usuario($data);
            echo $response;
            
        }    
    }

    public function ajax_listar_usuario(){
        if ($this->accion=='listausuario') {
           $response = controller_usuario::controller_listar();
           $datosjason = array();

            if (empty($response)) {
                $datosjason['data'][] = array(
                    "idusuario" => "--",
                    "nombres" => "--",
                    "user" => "--",
                    "contraseña" => "--",
                    "acciones" => "--"
                );
            } else {
                foreach ($response as $value) {

                    $botones = "<div class='col'><button type='button' class='btn btn-primary btn_edit_usuario' edit_pass='".$value['contraseña']."' edit_user='".$value['user']."' edit_nombre='".$value['nombre']."' edit_id='".$value['idusuario']."' data-toggle='modal' data-target='#modal_editar_usuario'  ><i class='fas fa-pencil-alt'></i></button><button type='button' class='btn btn-danger btn_eliminar_usuario' id_usuario_ls='".$value['idusuario']."' ><i class='fas fa-trash-alt'></i></button></div>";

                    $datosjason['data'][] = array(
                        "idusuario" => $value['idusuario'],
                        "nombres" =>  $value['nombre'],
                        "user" =>  $value['user'],
                        "contraseña" =>  $value['contraseña'],
                        "acciones" => $botones
                    );
                }
            }
            echo json_encode($datosjason);
        }
    }

    public function ajax_eliminar_usuario(){
        if ($this->accion=='eliminarUsuario') {
            $data = array(
                'idusu'=>$this->id
            );
            $response = controller_usuario::controller_eliminar_usuario($data);
            echo $response;
        }
    }
    

    public function ajax_editar_usuario(){
        if ($this->accion=='editar_usuario') {
            $data = array(
                'p_idusuario'       =>$this->id,
                'p_nombre'          =>$this->nombre,
                'p_user'            =>$this->user,
                'p_contraseña'      =>$this->contraseña
            );
            $response = controller_usuario::controller_editar_usuario($data);
            echo $response;
        }
    }
    

}

if (isset($_POST['registro_usuario'])) {
    $res = new ajax_usuario();
    $res->accion = $_POST['registro_usuario'];
    $res->nombre = $_POST['nombre_usuario'];
    $res->user = $_POST['user'];
    $res->contraseña = $_POST['contra'];
    $res->ajax_registrar_usuario();
    
}

//listar
if (isset($_POST['lista_usuario'])) { //
    $res = new ajax_usuario;
    $res->accion = $_POST['lista_usuario']; //accion= 'te quirerop',
    $res->ajax_listar_usuario();
    
}
//eliminar
if (isset($_POST['eliminar_usuario'])) { //
    $res = new ajax_usuario();
    $res->accion = $_POST['eliminar_usuario']; //accion= 'te quirerop',
    $res->id = $_POST['idusuario'];
    $res->ajax_eliminar_usuario();
    
}

//actualizar
if (isset($_POST['editar_usuario'])) { //
    $res = new ajax_usuario();
    $res->accion = $_POST['editar_usuario']; //accion= 'te quirerop',
    $res->id = $_POST['e_idusuario'];
    $res->nombre = $_POST['e_nombreusu'];
    $res->user = $_POST['e_userusu'];
    $res->contraseña = $_POST['e_contraseñausu'];
    $res->ajax_editar_usuario();
    
}