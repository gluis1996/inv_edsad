<?php
require_once ('../Model/dto/perfiles.php');
class controladorPerfiles{

    public $variable;

    public function __construct(perfiles $per)
    {
        $this->variable = $per;
    } 

    public function controladorRegistrarPerfil()  {

        if ($this->variable->vlan == "") {
            return 'VLAN campo vacio verifique';
        }
        if ($this->variable->megas == "") {
            return 'MEGA campo vacio verifique';
        }
        if ($this->variable->grupo == "") {
            return 'GRUPO campo vacio verifique';
        }


        $perfil = array(
            'vlan' => $this->variable->vlan,
            'megas' => $this->variable->megas,
            'grupo' => $this->variable->grupo,
            'filial' => $this->variable->filial
       );

    //    return json_encode($perfil, true);
        $response = Modeloperfiles::registrar($perfil);
        return $response;

    }

}