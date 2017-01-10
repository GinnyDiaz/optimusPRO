<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModProveedores extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

	public function setRecurso($data){
        $sql= "call SP_insertSupplyChain(3, 0, '".$data['nombre']."', '".$data['descripcion']."', '".$data['nivel']."', 0, 0, '', '".$data['usuario']."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRecursos($usuario){
        $sql= "call SP_supplyChain(1, 0, 0, '', '".$usuario."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delRecurso($data){
        $sql= "call SP_supplyChain(6, '".$data['cod']."', 0, 'P', '".$data['usuario']."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getDestinos($cod, $usuario){
        $sql= "call SP_supplyChain(9, '".$cod."', 0, '', '".$usuario."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRelationsR($usuario){
        $sql= "call SP_supplyChain(11, 0, 0, '', '".$usuario."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setRelacionRecursos($codOrigen, $codDestino, $usuario){
        $sql= "call SP_insertSupplyChain(5, 0, '', '', '', '".$codOrigen."' ,'".$codDestino."', 'P', '".$usuario."')";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delRelation($codRelation, $usuario){
        $sql= "call SP_supplyChain(8, '".$codRelation."', 0, '', '".$usuario."')";
        $query = $this->db->simple_query($sql);
        return $query;
    }

}
?>
