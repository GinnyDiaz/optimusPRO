<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModClientes extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

	public function setCliente($data){
        $sql= "call SP_insertSupplyChain(4, 0, '".$data['nombre']."', '".$data['descripcion']."', '".$data['nivel']."', 0, 0, '', '".$data['usuario']."');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getClientes($usuario){
        $sql= "call SP_supplyChain(2, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delClientes($data){
        $sql= "CALL SP_supplyChain(7, ".$data['cod'].", 0, 'C', '".$data['usuario']."');";
        $query = $this->db->simple_query($sql);
        return $sql;
    }

    public function getDestinos($cod, $usuario){
        $sql= "call SP_supplyChain(10, '".$cod."', 0, 0, '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function gerRelationsC($usuario){
        $sql= "call SP_supplyChain(12, 0, 0, '', '".$usuario."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setRelacionClientes($codOrigen, $codDestino, $usuario){
        $sql= "call SP_insertSupplyChain(5, 0, '', '', 0, '".$codOrigen."', '".$codDestino."', 'C', '".$usuario."');";
        $query = $this->db->simple_query($sql);
        return $sql;
    }

}
?>
