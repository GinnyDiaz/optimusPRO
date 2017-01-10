<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procesos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url().'procesos/regPrimarios');
		}else{
			redirect(base_url().'csm/login');
		}
	}

	private function loadViewRegProc($viewName, $data){
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view($viewName, $data);
		$this ->load->view('procesos/modalMacro');
		$this ->load->view('procesos/modalFlujoActividades');
		$this ->load->view('procesos/modalCaracterizacion');
		$this ->load ->view('scripts/scriptsGnral');
	}

	private function loadViewRegRelacion($viewName, $data){
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view($viewName, $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function regPrimarios(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$usuario=$this->session->userdata('usuario');
		$data['titulo']='Procesos Primarios';
		$data['tipoCod']='P';
		$data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		$data['tipo']='Primario';
		$this ->loadViewRegProc('procesos/regProcesos', $data);
	}

	public function regEstrategico(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Procesos Estratégicos';
		$usuario=$this->session->userdata('usuario');
		$data['tipoCod']='E';
		$data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		$data['tipo']='Estratégico';
		$this ->loadViewRegProc('procesos/regProcesos', $data);
	}

	public function regApoyo(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Procesos de Apoyo';
		$usuario=$this->session->userdata('usuario');
		$data['tipoCod']='A';
		$data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		$data['tipo']='de Apoyo';
		$this ->loadViewRegProc('procesos/regProcesos', $data);
	}

	public function setProcesos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['nombre'] = $this->input->post("txtNombre");
		$data['responsable'] = $this->input->post("txtResponsable");
		$data['esMacro'] = $this->input->post("chkMacro");
		if($data['esMacro']=='on'){
			$data['esMacro']='SI';
		}else{
			$data['esMacro']='NO';
		}
		$data['tipo'] = $this->input->post("txtTipo");
		$data['usuario']=$this->session->userdata('usuario');
		echo $this->modProcesos->setProceso($data);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}

	public function deleteProcesos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['cod'] = $this->input->post("txtCod");
		$data['usuario']=$this->session->userdata('usuario');
		$this->modProcesos->delProceso($data);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}

	public function getProcesosDisponibles(){
		$tipo = $this->input->post("tipo");
		$usuario=$this->session->userdata('usuario');
		$procesos=$this->modProcesos->getProcesosDisponibles($tipo, $usuario);
		$text='<table class="table table-hover" id="tblDisponibles"> <thead> <tr> <th>#</th> <th>Procesos disponibles</th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($procesos){  
            foreach($procesos->result() as $dprocesos){
            	$text=$text.'<tr ondblclick="hacerSubProceso(\'tblDisponibles\',\'tblSubProcesos\',\''.PROJECT_NAME.'\', this);">';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dprocesos->nombre.'</td>';
            	$text=$text.'<td class="hidden">'.($dprocesos->cod).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="2" class="text-center">No hay procesos disponibles para ser asignados al macroproceso.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        // $text='>.<';
        echo $text;
	}

	public function getSubProcesos(){
		$tipo = $this->input->post("tipo");
		$usuario=$this->session->userdata('usuario');
		$cod=$this->input->post('cod');
		$procesos=$this->modProcesos->getSubProcesos($tipo, $usuario, $cod);
		$text='<table class="table table-hover" id="tblSubProcesos"> <thead> <tr> <th>#</th> <th>Sub procesos</th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($procesos){
            foreach($procesos->result() as $dprocesos){
            	$text=$text.'<tr ondblclick="hacerSubProceso(\'tblSubProcesos\',\'tblDisponibles\',\''.PROJECT_NAME.'\', this);">';
            	$text=$text.'<td class="center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dprocesos->nombre.'</td>';
            	$text=$text.'<td class="hidden">'.($dprocesos->cod).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function setSubProcesos(){
		$cod = trim($this->input->post("cod"));
		$subProceso = trim($this->input->post("subProceso"));
		$usuario=$this->session->userdata('usuario');
		$this->modProcesos->setSubProcesos($cod, $subProceso, $usuario);
	}

	public function limpiarSubProcesos(){
		$codMacro = trim($this->input->post("codMacro"));
		$usuario=$this->session->userdata('usuario');
		$rpta=$this->modProcesos->limpiarSubProcesos($codMacro, $usuario);
		echo $rpta;
	}

	public function setCaracteristicas(){
		$data['usuario']=$this->session->userdata('usuario');
		$data['cod'] = trim($this->input->post("cod"));
		$data['mision'] = trim($this->input->post("mision"));
		$data['empieza'] = trim($this->input->post("empieza"));
		$data['incluye'] = trim($this->input->post("incluye"));
		$data['termina'] = trim($this->input->post("termina"));
		$data['entrada'] = trim($this->input->post("entrada"));
		$data['proveedor'] = trim($this->input->post("proveedor"));
		$data['salida'] = trim($this->input->post("salida"));
		$data['cliente'] = trim($this->input->post("cliente"));
		$data['inspecciones'] = trim($this->input->post("inspecciones"));
		$data['registros'] = trim($this->input->post("registros"));
		$data['variables'] = trim($this->input->post("variables"));
		$data['indicadores'] = trim($this->input->post("indicadores"));
		$rpta=$this->modCaracteristicas->setCaracteristicas($data);
		echo $rpta;
	}


    public function getCaracterizacion(){
    	$usuario=$this->session->userdata('usuario');
		$cod = trim($this->input->post("cod"));
    	$query=$this->modCaracteristicas->getCaracterizacion($usuario, $cod);
        echo json_encode($query->result());
        // echo $query;
	}

	public function relacionPrimarios(){
    	if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Procesos Primarios';
		$data['usuario']=$this->session->userdata('usuario');
		$data['tipoCod']='P';
		// $data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		// $data['relations'] = $this->modProcesos->getRelations($usuario, $data['tipoCod']);
		$data['tipo']='Primario';
		$this ->loadViewRegRelacion('procesos/regRelacion', $data);
	}

	public function relacionEstrategicos(){
    	if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Procesos Estratégicos';
		$data['usuario']=$this->session->userdata('usuario');
		$data['tipoCod']='E';
		// $data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		// $data['relations'] = $this->modProcesos->getRelations($usuario, $data['tipoCod']);
		$data['tipo']='Estratégico';
		$this ->loadViewRegRelacion('procesos/regRelacion', $data);
	}

	public function relacionApoyo(){
    	if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Procesos de Apoyo';
		$data['usuario']=$this->session->userdata('usuario');
		$data['tipoCod']='A';
		// $data['procesos'] = $this->modProcesos->getProcesos($usuario, $data['tipoCod']);
		// $data['relations'] = $this->modProcesos->getRelations($usuario, $data['tipoCod']);
		$data['tipo']='de Apoyo';
		$this ->loadViewRegRelacion('procesos/regRelacion', $data);
	}

	public function getDestinos(){
		$tipo = $this->input->post("tipo");
		$usuario=$this->session->userdata('usuario');
		$cod=$this->input->post('cod');
		$procesos=$this->modProcesos->getDestinos($tipo, $usuario, $cod);
		$text='<table class="table table-hover" id="tblDestino"> <thead> <tr> <th>#</th> <th>Proceso</th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($procesos){  
            foreach($procesos->result() as $dprocesos){
            	$text=$text."<tr onclick=\"seleccionFilaProcRel('tblDestino',this, '".base_url()."', '".$tipo."');\">";
            	$text=$text.'<td class="center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dprocesos->nombre.'</td>';
            	$text=$text.'<td class="hidden">'.($dprocesos->cod).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="2" class="text-center">Seleccione un Proceso de origen</td></tr>';
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}


	public function setRelacionProcesos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$cod = trim($this->input->post("txtCodOrigen"));
		$codDestino = trim($this->input->post("txtCodDestino"));
		$usuario=$this->session->userdata('usuario');
		$this->modProcesos->setRelacionProcesos($cod, $codDestino, $usuario);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}

	public function delRelation(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$codRelation = $this->input->post("txtCodRelation");
		$cod = $this->input->post("txtCodOrigen");
		$usuario=$this->session->userdata('usuario');
		$this->modProcesos->delRelation($codRelation, $usuario, $cod);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}


	public function mapaProcesos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Mapa de procesos';
		$data['usuario'] =$this->session->userdata('usuario');
	  	// $data['macroPrincipal'] = $this->modProcesos->getMacroProcesos($usuario, 'P');
	  	// $data['macroEstrategico'] = $this->modProcesos->getMacroProcesos($usuario, 'E');
	  	// $data['macroApoyo'] = $this->modProcesos->getMacroProcesos($usuario, 'A');
	  		
			// $data['mapaq'] = $this->modelEmpresas->getMapaProcesos($data['empresaid']);
			// $data['empresarelacion'] = $this->modelEmpresas->getRelacionesMapa($data['empresaid']);
			// $this ->load ->view('header2');
		$this ->load ->view('headerMap');
		$this ->load ->view('menu');
		$this ->load ->view('procesos/mapaProcesos', $data);
		// if( intval($data['mapaq']->num_rows())==-1){
		// 	$this ->load ->view('mapaprocesos/mapadeprocesosLoad', $data);		
		// }else{
		// 	$this ->load ->view('mapaprocesos/mapadeprocesos', $data);	
		// }

		$this ->load->view('procesos/modalCaracterizacion');
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function setMapaProcesos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url());
		}else{
			$param = array();
			$param['mySavedModel']='';
			$param['param_opcion']='';
			$datos=array();
			$proceso=array();
			$relaciones=array();
			$key=array();
			$category=array();
			$loc=array();
			$category=array();
			$usuario = $_POST['usuario'];
			
			if (isset($_POST['param_opcion'])){
	    		$param['param_opcion'] = $_POST['param_opcion'];
	    	}
			if (isset($_POST['mySavedModel'])){
				$datos= json_decode($_POST['mySavedModel']);
				$proceso=$datos->{'nodeDataArray'};
				$relaciones=$datos->{'linkDataArray'};
			}
			if(isset($_POST['Guardar'])) {
				$param['param_opcion']='grabar';
		        foreach ($proceso as $obj ){
		            $key =$obj->key;
		            $loc =$obj->loc;            
		            // $category =$obj->category;
		            if ($category!="MacroProceso") {
		                $loc =$obj->loc;
		            }
		            // if ($obj->group!=null) {
		            //     $group =$obj->group ;
		            // }else{
		            //    $group = 0; 
		            // }
		            $text =$obj->text;
		            //GUARDAR NODOS
	            	$query = $this->modProcesos->setMapa($key,$loc,$usuario);
			        if(!$query){
			        	$query = 'Existió un error';
			        }
			        echo $query;
	 	        }
	 	       //  foreach ( $relaciones as $obj ) {
		        //     $from=$obj->from;
		        //     $to =$obj->to;
		        //     $fromPort =$obj->fromPort;
		        //     $toPort =$obj->toPort;
		        //     // $points =$obj->points;
		        //     $query2 = $this->modProcesos->setMapaRelacion($from,$to,$fromPort,$toPort,$usuario);
			       //  if(!$query2){
			       //  	$query2 = 'Existió un error';
			       //  }
	        	// }
			}
		}
	}

}

?>