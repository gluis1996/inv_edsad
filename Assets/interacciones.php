<?php 
require_once ('../Model/Filial.php');
require_once ('../Model/Modelo.Tecnologia.php');
require_once ('../Model/Modelo.perfiles.php');
require_once ('../Model/radius.registrar.php');
require_once ('../Assets/Api/api.cosultas.php');
require_once ('../Assets/Api/api.autorizar.php');
//DTO
require_once ('../Model/dto/orden.php');
require_once ('../Model/dto/perfiles.php');
require_once ('../Model/dao.registrarOrden.php');

//CONTROLADOR
require_once ('../Controllers/controller.autorizar.php');
require_once ('../Controllers/Controller.perfiles.php');
require_once ('../Controllers/controller.deleteuserrdius.php');


class interaccion {

    public $filial;
    public $consulta;
    public $autorisa;
    public $detalle_instalacion;
    public $registraPerfiles;
    public $eoc_instalacion;
    public $sce_radgroupreply;
    public $sce_elimnarusuario;

    public function Filial(){
        if ($this->filial == 'FILIAL') {
            $res = Filial::Listar();
            echo json_encode($res);
        }
    }

    public function buscarmac($mac){
        if ($this->consulta == 'consultaonu') {
            $res =  consulApi::busquedamac($mac);
            echo $res;
        }
    }

    //funcion que envia datos al controlador en la funcion registrar_ftth pra el registro correspondiente
    public function autorizar(onu $onu, orden $o){
        if ($this->autorisa == 'autorisar') {

            $au = new autorizar($onu, $o);
            $response = $au->registrar_ftth();
            echo $response;   

        }
    }

    public function ver_detalle_instalacion($cod) {
        if ($this->detalle_instalacion == "detalle_instalacion") {
            $response =  RegistrarOrden::buscar($cod);

            echo json_encode($response);
        }

    }

    public function registrar_perfiles(perfiles $p){
        if ($this->registraPerfiles == "perfiles") {
            $au_perfil = new controladorPerfiles($p);
            $response = $au_perfil->controladorRegistrarPerfil();
            echo $response;
        }
    }


    public function registrar_instalacion_EoC(onu $onu, orden $o){
        if ($this->eoc_instalacion == 'eoc_instalacion') {
            $au = new autorizar($onu, $o);
            $response = $au->registrarEoC();
            echo $response;
        }
    }

    public function sce_radgroupreply(){
        if ($this->sce_radgroupreply == 'sce_radgroupreply') {
            $response =  radius::listar_radgroupreply();
            echo json_encode($response); 
        }
    }

    public function sce_elimnarusuario(orden $orden) {
        if ($this->sce_elimnarusuario == 'sce_elimnarusuario') {
            
            $response = gestion_radius::delete_user($orden->Nodo);
            echo $response;

        }
    }
}




if (isset($_POST['FILIAL'])) {
    $in = new interaccion();
    $in->filial=$_POST['FILIAL'];
    $response = $in->Filial();
    echo $response;
}


if (isset($_POST['consultaonu'])) {
    $in = new interaccion();
    $in->consulta = $_POST['consultaonu'];
    $mac = $_POST['mac'];
    $response = $in->buscarmac($mac);
    echo $response;
}

if (isset($_POST['autorisarONU'])) {
    $onu = new onu();
    $in = new interaccion();
    $orden = new orden();
    $in->autorisa= $_POST['autorisarONU'];
    //registro orden
    $orden->operador = $_POST['operador'];
    $orden->FILIAL = $_POST['FILIAL'];
    $orden->os = $_POST['os'];
    $orden->codAbonado = $_POST['codAbonado'];
    $orden->Nodo= $_POST['nodo'];
    $orden->caja = $_POST['CAJA'];
    $orden->borne = $_POST['BORNE'];
    $orden->precinto = $_POST['PREC'];
    $orden->mac = $_POST['MAC'];


    //registro api
    $onu->TipoOLT=$_POST['OLT'];
    $onu->olt_id=$_POST['olt_id'];
    $onu->pon_type=$_POST['pon_type'];
    $onu->board=$_POST['board'];
    $onu->port=$_POST['port'];
    $onu->sn=$_POST['sn'];
    $onu->onu_type_name=$_POST['onu_type_name'];
    $onu->vlan=$_POST['vlan'];
    $onu->onu_type=$_POST['onu_type'];
    $onu->zone=$_POST['zone'];
    $onu->name=$_POST['name'];
    $onu->onu_mode=$_POST['onu_mode'];
    $onu->onu_external_id=$_POST['onu_external_id'];
    $onu->upload_speed_profile_name=$_POST['upload_speed_profile_name'];
    $onu->download_speed_profile_name=$_POST['download_speed_profile_name'];
    $onu->download_speed_profile_name=$_POST['download_speed_profile_name'];
    $onu->address_or_comment=$_POST['address_or_comment'];
    $res = $in->autorizar($onu,$orden);
    echo $res;
}

if (isset($_POST["detalle_instalacion"])) {
    $in = new interaccion();
    $in->detalle_instalacion = $_POST["detalle_instalacion"];
    $in->ver_detalle_instalacion($_POST["codigo"]);
}

if (isset($_POST["perfiles"])) {
    $per = new perfiles();
    $in = new interaccion();
    $in->registraPerfiles=$_POST["perfiles"];
    $per->vlan = $_POST["vlan"];
    $per->megas = $_POST["megas"];
    $per->grupo = $_POST["grupo"];
    $per->filial = $_POST["filial"];
    $in->registrar_perfiles($per);
}


//instalacion EoC
if (isset($_POST["eoc_instalacion"])) {
    $onu = new onu();
    $orden = new orden();
    $in = new interaccion();
    $in->eoc_instalacion=$_POST["eoc_instalacion"];
    $orden->FILIAL = $_POST["filial"];
    $orden->os = $_POST["eoc_os"];
    $orden->operador = $_POST['operador'];
    $orden->codAbonado = $_POST["eoc_abonado"];
    $orden->Nodo = $_POST["eoc_nodo"];
    $onu->vlan = $_POST["eoc_vlan"];
    $orden->mac = $_POST["eoc_mac"];
    $onu->upload_speed_profile_name = $_POST["eoc_speed"];
    $orden->coordenadas = $_POST["eoc_coordenadas"];
    $in->registrar_instalacion_EoC($onu,$orden);
}


//llenar select que esta dentro del modal en la vista cambio de equipo
if (isset($_POST['sce_radgroupreply'])) {
    $in = new interaccion();
    $in->sce_radgroupreply=$_POST['sce_radgroupreply'];
    $in->sce_radgroupreply();
}

//Eliminar a un usuario en el Radius.

if (isset($_POST['sce_elimnarusuario'])) {
    $in = new interaccion();
    $orden = new orden();
    $in->sce_elimnarusuario = $_POST['sce_elimnarusuario'];
    $orden->Nodo = $_POST['username'];
    $in->sce_elimnarusuario($orden);
}
