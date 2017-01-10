<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objetivos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url().'procesos/regPrimarios');
		}else{
			redirect(base_url().'csm/login');
		}
	}

	private function loadView($viewName, $data, $modal1){
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view($viewName, $data);
		$this ->load->view($modal1);
		$this ->load ->view('scripts/scriptsGnral');
	}

	private function loadViewInd($viewName, $data, $modal1, $modal2){
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view($viewName, $data);
		$this ->load->view($modal1);
		$this ->load->view($modal2);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function regObjetivos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Objetivos estratégicos';
		$data['codProceso'] = $this->input->post("txtCodProceso");
		$data['descProceso'] = $this->input->post("txtDescProceso");
		$data['tipoProceso'] = $this->input->post("txtTipoProceso");
		$usuario=$this->session->userdata('usuario');
		$data['objetivos'] = $this->modObjetivos->getObjetivos($usuario, $data['codProceso']);
		$this ->loadView('objetivos/regObjetivos', $data, 'objetivos/modalRelacion');
	}

	public function setObjetivo(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['descObjetivo'] = trim($this->input->post("descObjetivo"));
		$data['perspectiva'] = trim($this->input->post("perspectiva"));
		$data['codProceso'] = trim($this->input->post("codProceso"));
		$data['usuario']=$this->session->userdata('usuario');
		echo $this->modObjetivos->setObjetivos($data['descObjetivo'], $data['perspectiva'], $data['usuario'], $data['codProceso']);
	}

	public function deleteObjetivo(){
		$codProceso = trim($this->input->post("codProceso"));
		$codObjetivo = trim($this->input->post("codObjetivo"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modObjetivos->deleteObjetivo($codProceso, $codObjetivo, $usuario);
		$val='true';
		foreach($query->result() as $dquery){
			$val= trim($dquery->rpta);
		}
		echo $val;
	}

	public function getObjDisponibles(){
		$usuario=$this->session->userdata('usuario');
		$codProceso = trim($this->input->post("codProceso"));
		$codObjetivo = trim($this->input->post("codObjetivo"));
		$disponibles=$this->modObjetivos->getObjDisponibles($codProceso, $codObjetivo, $usuario);
		$text='<table class="table table-hover" id="tblDisponibles"> <thead> <tr> <th>#</th> <th>Objetivos disponibles</th> <th>Perspectiva</th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($disponibles){
            foreach($disponibles->result() as $ddisponibles){
            	$text=$text.'<tr onDblClick="seleccionarObjetivo(\'tblDisponibles\', \'tblObjRelacionados\',\''.PROJECT_NAME.'\', this);">';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$ddisponibles->descripcion.'</td>';
            	$text=$text.'<td>'.($ddisponibles->perspectiva).'</td>';
            	$text=$text.'<td class="hidden">'.($ddisponibles->codProceso).'</td>';
            	$text=$text.'<td class="hidden">'.($ddisponibles->codObjetivo).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="3" class="text-center">No hay objetivos en los cuales el objetivo seleccionado pueda influir.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function getObjRelacionados(){
		$usuario=$this->session->userdata('usuario');
		$codProceso = trim($this->input->post("codProceso"));
		$codObjetivo = trim($this->input->post("codObjetivo"));
		$Relacionados=$this->modObjetivos->getObjRelacionados($codProceso, $codObjetivo, $usuario);
		$text='<table class="table table-hover" id="tblObjRelacionados"> <thead> <tr> <th>#</th> <th>Objetivos seleccionados</th> <th>Perspectiva</th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($Relacionados){
            foreach($Relacionados->result() as $dRelacionados){
            	$text=$text.'<tr onDblClick="seleccionarObjetivo(\'tblObjRelacionados\', \'tblDisponibles\',\''.PROJECT_NAME.'\', this);">';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dRelacionados->descripcion.'</td>';
            	$text=$text.'<td>'.($dRelacionados->perspectiva).'</td>';
            	$text=$text.'<td class="hidden">'.($dRelacionados->codProceso).'</td>';
            	$text=$text.'<td class="hidden">'.($dRelacionados->codObjetivo).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function limpiarRelacionesObj(){
		$codProceso = trim($this->input->post("codProceso"));
		$codObjetivo = trim($this->input->post("codObjetivo"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modObjetivos->limpiarRelacionesObj($codProceso, $codObjetivo, $usuario);
		echo $query;
	}
	
	public function setRelacionObjetivos(){
		$codProceso = trim($this->input->post("codProceso"));
		$codObjetivo = trim($this->input->post("codObjetivo"));
		$codObjetivoDest = trim($this->input->post("codObjetivoDest"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modObjetivos->setRelacionObjetivos($codProceso, $codObjetivo, $codObjetivoDest, $usuario);
		echo $query;
	}

	public function verMapaEstrategico(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Mapa estratégico';
		$data['codProceso'] = $this->input->post("txtCodProceso");
		$data['descProceso'] = $this->input->post("txtDescProceso");
		$data['tipoProceso'] = $this->input->post("txtTipoProceso");
		$data['usuario']=$this->session->userdata('usuario');
		$data['objetivos'] = $this->modObjetivos->getObjetivos($data['usuario'], $data['codProceso']);
		$this ->load ->view('headerMapEstrategico', $data);
		$this ->load ->view('menu');
		$this ->load ->view('objetivos/mapaEstrategico', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function setMapaEstrategico(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url());
		}else{
			$param = array();
			$param['mySavedModel']='';
			$param['param_opcion']='';
			$datos=array();
			$codProceso=$this->input->post("codProceso");
			// $relaciones=array();
			$key=array();
			$category=array();
			$loc=array();
			$category=array();
			$usuario = $this->session->userdata('usuario');
			if (isset($_POST['param_opcion'])){
	    		$param['param_opcion'] = $_POST['param_opcion'];
	    	}
			if (isset($_POST['mySavedModel'])){
				$datos= json_decode($_POST['mySavedModel']);
				$proceso=$datos->{'nodeDataArray'};
				// $relaciones=$datos->{'linkDataArray'};
			}
			if(isset($_POST['Guardar'])) {
				$param['param_opcion']='grabar';
		        foreach ($proceso as $obj ){
		            $category =$obj->category;
		            if (strlen(trim($category))==1) {
			            $key =$obj->key;
			            $loc =$obj->loc;            
			            // $text =$obj->text;
			            //GUARDAR NODOS
		            	$query = $this->modObjetivos->setMapa($codProceso, $key,$loc,$usuario);
			        	echo $query;
		            }
	 	        }
			}
		}
	}

	//INDICADORES

	public function regIndicadores(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Indicadores';
		$data['codProceso'] = $this->input->post("txtCodProceso");
		$data['descProceso'] = $this->input->post("txtDescProceso");
		$data['tipoProceso'] = $this->input->post("txtTipoProceso");
		$data['respProceso'] = $this->input->post("txtRespProceso");
		$data['usuario']=$this->session->userdata('usuario');
		$data['indicadores'] = $this->modIndicadores->getIndicadores($data['usuario'], $data['codProceso']);
		$this ->loadViewInd('indicadores/regIndicadores', $data, 'indicadores/modalHistorial', 'indicadores/modalBSC');
	}

	public function setIndicador(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$codProceso = trim($this->input->post("codProceso"));
		$tituloIndicador = trim($this->input->post("tituloIndicador"));
		$formula = trim($this->input->post("formula"));
		$unidadMed = trim($this->input->post("unidadMed"));
		$meta = trim($this->input->post("meta"));
		$frecuencia = trim($this->input->post("frecuencia"));
		$usuario=$this->session->userdata('usuario');
		echo $this->modIndicadores->setIndicador($codProceso, $tituloIndicador, $formula, $unidadMed, $meta, $frecuencia, $usuario);
	}


	public function deleteIndicador(){
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modIndicadores->deleteIndicador($codProceso, $codIndicador, $usuario);
		$val='true';
		foreach($query->result() as $dquery){
			$val= trim($dquery->rpta);
		}
		echo $val;
	}

	public function getHistorial(){
		$usuario=$this->session->userdata('usuario');
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$historial=$this->modIndicadores->getHistorial($codProceso, $codIndicador, $usuario);
		$text='<table class="table table-hover" id="tblHistorial"> <thead> <tr> <th>#</th> <th>Periodo</th> <th>Valor</th> <th></th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($historial){
            foreach($historial->result() as $dhistorial){
            	$text=$text.'<tr>';
            	$text=$text.'<td class="a-center" style="vertical-align: middle;">'.($cont).'</td>';
            	$text=$text.'<td style="vertical-align: middle;"> <img src="'.PROJECT_NAME.'img/'.$dhistorial->color.'.png" width="25"> </td>';
            	$text=$text.'<td style="vertical-align: middle;">'.$dhistorial->periodo.'</td>';
            	$text=$text.'<td style="vertical-align: middle;">'.$dhistorial->valor.'</td>';
            	$text=$text.'<td style="vertical-align: middle;">';
            		$text=$text.'<button type="button" class="btn btn-danger btn-circle btn-sm"';
            		$text=$text.'onclick="return deleteHistorial(\''.PROJECT_NAME.'\', \''.$dhistorial->codHistorial.'\');"><i class="fa fa-times"></i></button></td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="4" class="text-center">No hay datos históricos almacenados para este indicador.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function addHistorial(){
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$periodo = trim($this->input->post("periodo"));
		$valor = trim($this->input->post("valor"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modIndicadores->addHistorial($codProceso, $codIndicador, $periodo, $valor, $usuario);
		$val='true';
		foreach($query->result() as $dquery){
			$val= trim($dquery->rpta);
		}
		echo $val;
		// echo $query;
	}

	public function deleteHistorial(){
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$codHistorial = trim($this->input->post("codHistorial"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modIndicadores->deleteHistorial($codProceso, $codIndicador, $codHistorial, $usuario);
		echo $query;
	}

	public function getDatosIndicador(){
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modIndicadores->getDatosIndicador($codProceso, $codIndicador, $usuario);
        echo json_encode($query->result());
        // echo $query;
	}

	public function updIndicador(){
		$codProceso = trim($this->input->post("codProceso"));
		$codIndicador = trim($this->input->post("codIndicador"));
		$objetivo = trim($this->input->post("objetivo"));
		$nombre = trim($this->input->post("nombre"));
		$formula = trim($this->input->post("formula"));
		$lineaBase = trim($this->input->post("lineaBase"));
		$meta = trim($this->input->post("meta"));
		$condMenor = trim($this->input->post("condMenor"));
		$condMayor = trim($this->input->post("condMayor"));
		$iniciativas = trim($this->input->post("iniciativas"));
		$responsable = trim($this->input->post("responsable"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modIndicadores->updIndicador($codProceso, $codIndicador, $usuario, $objetivo, $nombre, $formula, $lineaBase, $meta, $condMenor, $condMayor, $iniciativas, $responsable);
		echo $query;
	}


}

?>