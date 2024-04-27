<?php
require_once ('../Model/Modelo.averia.php');

class interaccion_averia{

    public $operador;
    public $abonado;
    public $t_orden;
    public $fecha;
    public $atc_registrar;
    public $select_averia;
    public $area;
    public $cod_orden;


    public function interaccion_registro(){
        
        if ($this->atc_registrar=='atc_registrar') {
          //Obtener el tiempo de registro
          date_default_timezone_set('America/Lima');
          $fecha = date('Y-m-d H:i:s');
          $fechaactual = $fecha;

          $data = array(
            'operador' => $this->operador,
            'abonado' => $this->abonado,
            't_orden' => $this->t_orden,
            'fecha' => $fechaactual,
            'area' => $this->area,
            'cod_orden' => $this->cod_orden
          );

          $res = modelo_averia::modelo_registrar($data);

          if ($res == "ok") {
            echo 'ok';
          }else {
            echo 'fallo';
          }

        }

    }

    PUBLIC function interaccion_listarAverias(){
      if ($this->select_averia == 'select_averia') {
        $response =  modelo_averia::listar_averias();        
        echo json_encode($response); 
      }
    }


}

if (isset($_POST['atc_registrar'])) {
    $res = new interaccion_averia();
    $res->atc_registrar=$_POST['atc_registrar'];
    $res->operador=$_POST['operador'];
    $res->abonado=$_POST['abonado'];
    $res->t_orden=$_POST['t_orden'];
    $res->area=$_POST['area'];
    $res->cod_orden=$_POST['orden'];
    $res->interaccion_registro();
}

if (isset($_POST['select_averia'])) {
  $res = new interaccion_averia();
  $res->select_averia=$_POST['select_averia'];
  $res->interaccion_listarAverias();
}

