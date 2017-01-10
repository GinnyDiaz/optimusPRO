<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModIndicadores extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    public function getIndicadores($usuario, $codProceso){
        $sql= "call SP_indicadores(1, '".$usuario."', '".$codProceso."', 0, '', 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setIndicador($codProceso, $tituloIndicador, $formula, $unidadMed, $meta, $frecuencia, $usuario){
        $sql= "call SP_setIndicadores(2, '".$usuario."', '".$codProceso."', 0, '', '', '".$tituloIndicador."', 
            '".$formula."', '".$unidadMed."', 0, '".$meta."', '".$frecuencia."', '', '', 0, '', 0, '', 0, 0);";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function deleteIndicador($codProceso, $codIndicador, $usuario){
        $sql= "call SP_indicadores(3, '".$usuario."', '".$codProceso."', '".$codIndicador."', '', 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getHistorial($codProceso, $codIndicador, $usuario){
        $sql= "call SP_indicadores(4, '".$usuario."', '".$codProceso."', '".$codIndicador."', '', 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function addHistorial($codProceso, $codIndicador, $periodo, $valor, $usuario){
        $sql= "call SP_setIndicadores(5, '".$usuario."', '".$codProceso."', '".$codIndicador."', '', '', 
            '', '', '', 0, 0, '', '', '', 0, '".$periodo."', '".$valor."', '', 0, 0);"; 
        $query = $this->db->query($sql);
        return $query;
    }

    public function deleteHistorial($codProceso, $codIndicador, $codHistorial, $usuario){
        $sql= "call SP_indicadores(8, '".$usuario."', '".$codProceso."', '".$codIndicador."', 0, '".$codHistorial."');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getDatosIndicador($codProceso, $codIndicador, $usuario){
        $sql= "call SP_indicadores(6, '".$usuario."', '".$codProceso."', '".$codIndicador."', '', 0);";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updIndicador($codProceso, $codIndicador, $usuario, $objetivo, $nombre, $formula, $lineaBase, $meta, $condMenor, $condMayor, $iniciativas, $responsable){
        $sql= "call SP_setIndicadores(7, '".$usuario."', '".$codProceso."', '".$codIndicador."', '', 
            '".$objetivo."', '".$nombre."', '".$formula."', '', '".$lineaBase."', '".$meta."', '', 
            '".$responsable."', '".$iniciativas."', 0, '', 0, '', '".$condMenor."', '".$condMayor."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>
