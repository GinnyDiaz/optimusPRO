<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModProcesos extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

	public function setProceso($data){
        if($data['tipo']=='P'){
            $categoria='Primario';
        }
        if($data['tipo']=='E'){
            $categoria='Estrategicos';
        }
        if($data['tipo']=='A'){
            $categoria='PApoyo';
        }
        $sql= "call SP_InsertProcesos(2, '".$data['usuario']."', 0, '".$categoria."', '".$data['nombre']."', '', 
            '".$data['responsable']."', '".$data['tipo']."', '".$data['esMacro']."', 0, '', 0, '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getProcesos($usuario, $tipo){
        $sql= "call SP_PROCESOS(1, '".$usuario."', 0, '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delProceso($data){
        $sql= "call SP_PROCESOS(5, '".$data['usuario']."', '".$data['cod']."', '', 0, 0, '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getProcesosDisponibles($tipo, $usuario){
        $sql= "call SP_PROCESOS(7, '".$usuario."', 0, '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getSubProcesos($tipo, $usuario, $cod){
        $sql= "call SP_PROCESOS(8, '".$usuario."', '".$cod."', '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function setSubProcesos($codMacro, $subProceso, $usuario){
        $sql= "call SP_PROCESOS(3, '".$usuario."', '".$subProceso."', '', ".$codMacro.", 0, '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function limpiarSubProcesos($codMacro, $usuario){
        $sql= "call SP_PROCESOS(11, '".$usuario."', 0, '', ".$codMacro.", 0, '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function getDestinos($tipo, $usuario, $cod){
        $sql= "call SP_PROCESOS(12, '".$usuario."', '".$cod."', '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRelations($usuario, $tipo){
        $sql= "call SP_PROCESOS(10, '".$usuario."', 0, '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function setRelacionProcesos($cod, $codDestino, $usuario){
        $sql= "call SP_PROCESOS(4, '".$usuario."', '".$cod."', '', 0, 0, '".$codDestino."');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    public function delRelation($codRelation, $usuario, $cod){
        $sql= "call SP_PROCESOS(6, '".$usuario."', '".$cod."', '', 0, ".$codRelation.", '');";
        $query = $this->db->simple_query($sql);
        return $query;
    }

    
    //PARA MAPA DE PROCESOS

    public function getProcesosMapa($usuario){
        $sql= "call SP_PROCESOS(17, '".$usuario."', 0, '', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getMacroProcesos($usuario, $tipo){
        $sql= "call SP_PROCESOS(14, '".$usuario."', 0, '".$tipo."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getContenedoresMapa($usuario){
        $sql= "call SP_PROCESOS(18, '".$usuario."', 0, '', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;   
    }

    public function setMapa($key,$loc,$usuario){
        //Actualizar las ubicaciones de los nodos
        $sql= "call SP_InsertProcesos(19, '".$usuario."', '".$key."', '', '', '".$loc."', '', '', '', 0, '', 0, '');";
        $query = $this->db->query($sql);
        return $query;   
    }

    public function getRelacionesMapa($usuario){
        //Actualizar las ubicaciones de los relaciones
        $sql= "call SP_PROCESOS(20, '".$usuario."', 0, '', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;   
    }

    //PARA ANÁLISIS DE ACTIVIDADES
    public function getNombreProceso($codProceso, $usuario){
        $sql= "call SP_PROCESOS(21, '".$usuario."', '".$codProceso."', '', 0, 0, '');";
        $query = $this->db->query($sql);
        $nombre='';
        foreach ($query->result() as $dquery) {
            $nombre=$dquery->nombre;
        }
        return $nombre;
    }

    public function getRelaciones($usuario, $tipoCod){
        $sql= "call SP_PROCESOS(10, '".$usuario."', 0, '".$tipoCod."', 0, 0, '');";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>
