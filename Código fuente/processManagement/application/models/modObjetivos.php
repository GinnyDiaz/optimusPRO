<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModObjetivos extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    public function getObjetivos($usuario, $codProceso){
        $sql= "call SP_objetivos(1, '".$usuario."', '".$codProceso."', 0, 0, 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setObjetivos($descObjetivo, $perspectiva, $usuario, $codProceso){
        $sql= "call SP_setObjetivos('".$usuario."', '".$codProceso."', 0, '".$descObjetivo."', '".$perspectiva."', '', '', '', 0, 0);";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function deleteObjetivo($codProceso, $codObjetivo, $usuario){
        $sql= "call SP_objetivos(3, '".$usuario."', '".$codProceso."', '".$codObjetivo."', 0, 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getObjDisponibles($codProceso, $codObjetivo, $usuario){
        $sql= "call SP_objetivos(4, '".$usuario."', '".$codProceso."', '".$codObjetivo."', 0, 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getObjRelacionados($codProceso, $codObjetivo, $usuario){
        $sql= "call SP_objetivos(5, '".$usuario."', '".$codProceso."', '".$codObjetivo."', 0, 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function limpiarRelacionesObj($codProceso, $codObjetivo, $usuario){
        $sql= "call SP_objetivos(6, '".$usuario."', '".$codProceso."', '".$codObjetivo."', 0, 0, 0, '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function setRelacionObjetivos($codProceso, $codObjetivo, $codObjetivoDest, $usuario){
        $sql= "call SP_objetivos(7, '".$usuario."', '".$codProceso."', '".$codObjetivo."', 0, 0, '".$codObjetivoDest."', '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function setMapa($codProceso, $key,$loc,$usuario){
        $sql= "call SP_objetivos(9, '".$usuario."', '".$codProceso."', '".$key."', 0, 0, 0, '".$loc."');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getRelacionesMapa($usuario, $codProceso){
        $sql= "call SP_OBJETIVOS(8, '".$usuario."', '".$codProceso."', 0, 0, 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }
   
}
?>



