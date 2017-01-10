<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModFlujos extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    public function addFlujo($cod, $flujo, $usuario, $unidadTiempo){
        $sql= "call SP_Flujos(1, '".$usuario."', '".$cod."', 0, '".$flujo."', '', 0, '".$unidadTiempo."');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getFlujoActividades($cod, $usuario){
        $sql= "call SP_Flujos(2, '".$usuario."', '".$cod."', 0, '', '', 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function deleteFlujo($cod, $codFlujo, $usuario){
        $sql= "call SP_Flujos(3, '".$usuario."', '".$cod."', '".$codFlujo."', '', '', 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>
