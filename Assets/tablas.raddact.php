<?php

require_once ('../Model/radius.registrar.php');

class ConsumoRaddacct{

    public $cod;
    public $username;
    public $cod2;
    public $username2;

    

    public function listarconsumo(){
        if ($this->cod == 'consultaDatos') {
           $res  = radius::buscar_raddacct($this->username);
           if (count($res) == 0) {
            $datosjason ='{
                            "data": [
                                        {  
                                            "IPaddrress":"--",
                                            "start_time":"--",
                                            "Stop_time":"--",
                                            "Total_time":"--",
                                            "upload":"--",
                                            "download":"--",
                                            "Termination":"--",
                                            "nas_ip_address":"--"                                        
                                        }
                                    ]
                            }';
        }else {
            $datosjason = '{
                "data": [';
                for ($i=0; $i < count($res); $i++) { 

                    $total_time = $res[$i]['acctsessiontime'];
                    $dias = floor($total_time / (60 * 60 * 24));
                    $horas = floor(($total_time % (60 * 60 * 24)) / (60 * 60));
                    $minutos = floor(($total_time % (60 * 60)) / 60);
                    $segundos = $total_time%60;

                    $tiempo_formateado = gmdate("d H:i:s", $total_time);

                    $time= "Días: $dias, Horas: $horas, Minutos: $minutos, Segundos: $segundos";

                    $descarga = $this->convertirBytes($res[$i]['acctinputoctets']);
                    $subida = $this->convertirBytes($res[$i]['acctoutputoctets']);
                    $datosjason.='
                        {
                            "IPaddrress":"'.$res[$i]['framedipaddress'].'",
                            "start_time":"'.$res[$i]['acctstarttime'].'",
                            "Stop_time":"'.$res[$i]['acctstoptime'].'",
                            "Total_time":"'.$time.'",
                            "upload":"'.$descarga.'",
                            "download":"'.$subida.'",
                            "Termination":"'.$res[$i]['acctterminatecause'].'",
                            "nas_ip_address":"'.$res[$i]['nasipaddress'].'"
                        },';
                }
                $datosjason = substr($datosjason,0,-1);
                $datosjason.=']
                        }';
        }

        echo $datosjason;
        }
    }

    public function convertirBytes($bytes) {
        $suffix = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $index = 0;
    
        while ($bytes >= 1024 && $index < count($suffix) - 1) {
            $bytes /= 1024;
            $index++;
        }
    
       
        $valorFormateado = round($bytes, 2);

        if ($index == 3) {
            return $valorFormateado . ' ' . $suffix[$index]; // Mostrar solo GB si es gigabyte
        } elseif ($index == 2) {
            return $valorFormateado . ' ' . $suffix[$index]; // Mostrar solo MB si es megabyte
        } else {
            return $valorFormateado . ' ' . $suffix[$index]; // Mostrar para otros casos
        }
    }

    public function listarconsumo_estatus(){
        if ($this->cod2 == 'consultaDatos2') {
           $res  = radius::buscar_raddacct($this->username2);
           if (count($res) == 0) {
            $datosjason ='{
                            "data": [
                                        {  
                                            "IPaddrress":"--",
                                            "start_time":"--",
                                            "Stop_time":"--",
                                            "Total_time":"--",
                                            "upload":"--",
                                            "download":"--",
                                            "Termination":"--",
                                            "nas_ip_address":"--"                                        
                                        }
                                    ]
                            }';
        }else {
            $datosjason = '{
                "data": [';
                for ($i=0; $i < count($res); $i++) { 

                    $total_time = $res[$i]['acctsessiontime'];
                    $dias = floor($total_time / (60 * 60 * 24));
                    $horas = floor(($total_time % (60 * 60 * 24)) / (60 * 60));
                    $minutos = floor(($total_time % (60 * 60)) / 60);
                    $segundos = $total_time%60;

                    $tiempo_formateado = gmdate("d H:i:s", $total_time);

                    $time= "Días: $dias, Horas: $horas, Minutos: $minutos, Segundos: $segundos";

                    $descarga = $this->convertirBytes($res[$i]['acctinputoctets']);
                    $subida = $this->convertirBytes($res[$i]['acctoutputoctets']);
                    $datosjason.='
                        {
                            "IPaddrress":"'.$res[$i]['framedipaddress'].'",
                            "start_time":"'.$res[$i]['acctstarttime'].'",
                            "Stop_time":"'.$res[$i]['acctstoptime'].'",
                            "Total_time":"'.$time.'",
                            "upload":"'.$descarga.'",
                            "download":"'.$subida.'",
                            "Termination":"'.$res[$i]['acctterminatecause'].'",
                            "nas_ip_address":"'.$res[$i]['nasipaddress'].'"
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


if (isset($_POST['consultaDatos'])) {
    $i = new ConsumoRaddacct();
    $i->cod=$_POST['consultaDatos'];
    $i->username=$_POST['username'];
    $i->listarconsumo();
}

if (isset($_POST['consultaDatos2'])) {
    $i = new ConsumoRaddacct();
    $i->cod2=$_POST['consultaDatos2'];
    $i->username2=$_POST['username'];
    $i->listarconsumo_estatus();
}