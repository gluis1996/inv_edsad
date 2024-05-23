<?php

require_once('../../Controllers/Controller.historico.php');

require_once('../../Model/Modelo.historico.php');

class ajax_historico
{
    public $accion;
    public $id;

    public function ajax_buscas_historico()
    {
        if ($this->accion == 'h_buscar') {
            $data = array(
                'id_historico' => $this->id
            );
            $response = controller_historico::c_buscar($data);
            $jsonresponse = array();
            if (empty($response)) {
                $jsonresponse['data'][] = array(
                    'id_historial' => '--',
                    'id_detalle_asignacion' => '--',
                    'nombre_sede' => '--',
                    'nombre_oficina' => '--',
                    'equipo' => '--',
                    'nombre_usuario' => '--',
                    'nombre_empleado' => '--',
                    'cod_patrimonial' => '--',
                    'vida_util' => '--',
                    'estado' => '--',
                    'fecha_asignacion' => '--',
                    'accion' => '--',
                    'fecha' => '--'
                );
            } else {
                foreach ($response as $value) {
                    $jsonresponse['data'][] = array(
                        'id_historial'              => $value['id_historial'],
                        'id_detalle_asignacion'     => $value["id_detalle_asignacion"],
                        'nombre_sede'               => $value["nombre_sede"],
                        'nombre_oficina'            => $value["nombre_oficina"],
                        'equipo'                    => $value["equipo"],
                        'nombre_usuario'            => $value["nombre_usuario"],
                        'nombre_empleado'           => $value["nombre_empleado"],
                        'cod_patrimonial'           => $value["cod_patrimonial"],
                        'vida_util'                 => $value["vida_util"],
                        'estado'                    => $value["estado"],
                        'fecha_asignacion'          => $value["fecha_asignacion"],
                        'accion'                    => $value["accion"],
                        'fecha'                     => $value["fecha"]

                    );
                }
            }
            echo json_encode($jsonresponse);
        }
    }
}


if (isset($_POST['h_buscar'])) {
    $res  = new ajax_historico();
    $res->accion = $_POST['h_buscar'];
    $res->id = $_POST['h_id_historico'];
    $res->ajax_buscas_historico();
}
