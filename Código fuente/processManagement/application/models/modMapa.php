<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModMapa extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    public function getProvDirectos($usuario){
        $sql= "call SP_supplyChain(13, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getCliDirectos($usuario){
        $sql= "call SP_supplyChain(14, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getProvIndirectos($usuario){
        $sql= "call SP_supplyChain(15, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getCliIndirectos($usuario){
        $sql= "call SP_supplyChain(16, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

   
}
?>
