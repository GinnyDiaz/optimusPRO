<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModActividades extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    // public function addFlujo($cod, $flujo, $usuario){
    //     $sql= "SP_Actividades @tipo=1, @PROCcod='".$cod."', @USERcod='".$usuario."', @FLUdescripcion='".$flujo."'";
    //     $query = $this->db->simple_query($sql);
    //     return $query;
    // }

    public function getActividades($data){
        $sql= "call SP_Actividades(1, '".$data['usuario']."', '".$data['codProceso']."', '".$data['codFlujo']."', 0, 0, 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setActividades($descripcion, $responsable, $usuario, $codProceso, $codFlujo, $tiempo){
        $sql= "CALL SP_setActividades(2, '".$usuario."', '".$codProceso."', '".$codFlujo."', 0, '".$descripcion."', 
            '', 0, '".$responsable."', '".$tiempo."', 0);";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function updActividades($descripcion, $codProceso, $codFlujo, $codActividad, $tipoActividad, $responsable, $tiempo, $usuario){
        $sql= "call SP_setActividades(3, '".$usuario."', '".$codProceso."', '".$codFlujo."', '".$codActividad."',
            '".$descripcion."', '".$tipoActividad."', '".$tiempo."', '".$responsable."', '', 0);";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function deleteActividad($codProceso, $codFlujo, $codActividad, $usuario){
        $sql= "call SP_Actividades(4, '".$usuario."', '".$codProceso."', '".$codFlujo."', '".$codActividad."', 0, 0);";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getResumenTipoActividad($codProceso, $codFlujo, $usuario){
        $sql= "call SP_Actividades(5, '".$usuario."', '".$codProceso."', '".$codFlujo."', 0, 0, 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getResumenRolActividad($codProceso, $codFlujo, $usuario){
        $sql= "call SP_Actividades(6, '".$usuario."', '".$codProceso."', '".$codFlujo."', 0, 0, 0);";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>
