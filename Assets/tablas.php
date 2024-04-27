<?php 

require_once ('../Model/dao.registrarOrden.php');
require_once ('../Model/Modelo.perfiles.php');
require_once ('../Model/radius.registrar.php');
require_once ('../Model/Filial.php');
class tablas{

    public $datos;
    public $datos2;
    public $datos3;
    public $instalacionEoC;
    public $operador;
    public $operador2;
    public $operador3;
    public $operador4;
    public $operador5;
    public $card_listar;
    public $card_listarEOC;
    public $card_listar_atenciones;

    public function listarinstalacionfo() {
        if ($this->datos2 == 'listarinstalacionfo') {
            $response =  RegistrarOrden::listar($this->operador);
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "Abonado":"--",
                                                "Filial":"--",
                                                "Abonado":"--",
                                                "Caja":"--",
                                                "Borne":"--",
                                                "Precinto":"--",
                                                "Mac":"--",
                                                "Fecha":"--",
                                                "Accion":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        $botones = "<div class 'row'><button type='button' class='btn btn-dark btn_detale_instalacion' data-toggle='modal' data-target='#modal_detalle_instalacion' idinstalacion='".$response[$i]['id']."'><i class='fas fa-eye'></i></button>   <button type='button' class='btn btn-success btn_estado_instalacion' data-toggle='modal' data-target='#modal_estado_instalacion' idabonado='".$response[$i]['codabonado']."'><i class='fa fa-signal' aria-hidden='true'></i></button></div>";
                        $datosjason.='
                            {
                                "Abonado":"'.$response[$i]['abonado'].'",
                                "Filial":"'.$response[$i]['filial'].'",
                                "Abonado":"'.$response[$i]['abonado'].'",
                                "Caja":"'.$response[$i]['caja'].'",
                                "Borne":"'.$response[$i]['borne'].'",
                                "Precinto":"'.$response[$i]['precinto'].'",
                                "Mac":"'.$response[$i]['mac'].'",
                                "Fecha":"'.$response[$i]['fecha'].'",
                                "Accion":"'.$botones.'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }
        
       
        echo $datosjason;
        }
        
    }
    public function listarperfiles() {
        if ($this->datos == 'listadoperfileslocal') {
            $response =  Modeloperfiles::listar();
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "Vlan":"--",
                                                "Megas":"--",
                                                "Perfil":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        //$botones = "<div class 'row'><button type='button' class='btn btn-dark btn_detale_instalacion' data-toggle='modal' data-target='#modal_detalle_instalacion' idinstalacion='".$response[$i]['id']."'><i class='fas fa-eye'></i></button></div>";
                        $datosjason.='
                            {
                                "Vlan":"'.$response[$i]['vlan'].'",
                                "Megas":"'.$response[$i]['datos'].'",
                                "Perfil":"'.$response[$i]['grupo'].'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

        echo $datosjason;
        }

        
    }

    public function listarRadgroupreply(){
        if ($this->datos3 == 'listarRadgroupreply') {
            $response =  radius::listar_radgroupreply();
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "id":"--",
                                                "groupname":"--",
                                                "Perfil":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        $datosjason.='
                            {
                                "id":"'.$response[$i]['id'].'",
                                "groupname":"'.$response[$i]['groupname'].'",
                                "value":"'.$response[$i]['value'].'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

        echo $datosjason;
        } 
    }

    public function listarinstalacionEoC2(){
        if ($this->instalacionEoC == 'listarinstalacionEoC') {
            $response = registrarOrden::ListarInstalacionEoC($this->operador2);
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "id":"--",
                                                "filial":"--",
                                                "os":"--",
                                                "operador":"--",
                                                "codigo":"--",
                                                "nodo":"--",
                                                "mac":"--",
                                                "vlan":"--",
                                                "speed":"--",
                                                "coordenada":"--",
                                                "fecha":"--",
                                                "acciones":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        $botones = "<div class 'row'><button type='button' class='btn btn-dark'><i class='fas fa-eye'></i></button></div>";
                        $datosjason.='
                            {
                                "id":"'.$response[$i]['id'].'",
                                "filial":"'.$response[$i]['filial'].'",
                                "os":"'.$response[$i]['os'].'",
                                "operador":"'.$response[$i]['operador'].'",
                                "codigo":"'.$response[$i]['codigo'].'",
                                "nodo":"'.$response[$i]['nodo'].'",
                                "mac":"'.$response[$i]['mac'].'",
                                "vlan":"'.$response[$i]['vlan'].'",
                                "speed":"'.$response[$i]['speed'].'",
                                "coordenada":"'.$response[$i]['coordenada'].'",
                                "fecha":"'.$response[$i]['fecha'].'",
                                "acciones":"'.$botones.'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }
        
        
        echo $datosjason;
        }
    }


    public function card_listar(){
        if ($this->card_listar ==  'card_listar') {
            $response = Filial::card_listar($this->operador3);
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "filial":"--",
                                                "nombre":"--",
                                                "cantidad":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        
                        $datosjason.='
                            {
                                "filial":"'.$response[$i]['filial'].'",
                                "nombre":"'.$response[$i]['nombre'].'",
                                "cantidad":"'.$response[$i]['cantidad'].'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

            echo $datosjason;
        }
    }

    public function card_listarEOC(){
        if ($this->card_listarEOC ==  'card_listarEOC') {
            $response = Filial::card_listar_eoc($this->operador4);
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "filial":"--",
                                                "nombre":"--",
                                                "cantidad":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        
                        $datosjason.='
                            {
                                "filial":"'.$response[$i]['filial'].'",
                                "nombre":"'.$response[$i]['nombre'].'",
                                "cantidad":"'.$response[$i]['cantidad'].'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

            echo $datosjason;
        }
    }


    public function card_listar_atenciones(){
        if ($this->card_listar_atenciones ==  'card_listar_atenciones') {
            $response = Filial::card_listar_atenciones($this->operador5);
            if (count($response) == 0) {
                $datosjason ='{
                                "data": [
                                            {  
                                                "orden_o_area":"--",
                                                "cantidad":"--"
                                            }
                                        ]
                                }';
            }else {
                $datosjason = '{
                    "data": [';
                    for ($i=0; $i < count($response); $i++) { 

                        
                        $datosjason.='
                            {
                                "orden_o_area":"'.$response[$i]['orden_o_area'].'",
                                "cantidad":"'.$response[$i]['cantidad'].'"
                            },';
                    }
                    $datosjason = substr($datosjason,0,-1);
                    $datosjason.=']
                            }';
            }

            echo $datosjason;
        }
    }


    


}


if (isset($_POST['listarinstalacionfo'])) {
    $recorrer = new tablas();
    $recorrer->datos2=$_POST['listarinstalacionfo'];
    $recorrer->operador=$_POST['operador'];
    $recorrer->listarinstalacionfo();
}


if (isset($_POST['listadoperfileslocal'])) {
    $recorrer = new tablas();
    $recorrer->datos=$_POST['listadoperfileslocal'];
    $recorrer->listarperfiles();
}


if (isset($_POST['listarRadgroupreply'])) {
    $recorrer = new tablas();
    $recorrer->datos3=$_POST['listarRadgroupreply'];
    $recorrer->listarRadgroupreply();
}



if (isset($_POST['listarinstalacionEoC'])) {
    $recorrer = new tablas();
    $recorrer->instalacionEoC=$_POST['listarinstalacionEoC'];
    $recorrer->operador2=$_POST['operador'];
    $recorrer->listarinstalacionEoC2();
}


if (isset($_POST['card_listar'])) {
    $recorrer = new tablas();
    $recorrer->card_listar = $_POST['card_listar'];
    $recorrer->operador3 = $_POST['operador'];
    $recorrer->card_listar();    
}

if (isset($_POST['card_listarEOC'])) {
    $recorrer = new tablas();
    $recorrer->card_listarEOC = $_POST['card_listarEOC'];
    $recorrer->operador4 = $_POST['operador'];
    $recorrer->card_listarEOC();    
}

if (isset($_POST['card_listar_atenciones'])) {
    $recorrer = new tablas();
    $recorrer->card_listar_atenciones = $_POST['card_listar_atenciones'];
    $recorrer->operador5 = $_POST['operador'];
    $recorrer->card_listar_atenciones();    
}