<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url().'procesos/regPrimarios');
		}else{
			redirect(base_url().'csm/login');
		}
	}

	private function loadViewActividades($viewName, $data, $modal){
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view($viewName, $data);
		$this ->load ->view($modal, $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function addFlujoActividades(){
		$cod = trim($this->input->post("cod"));
		$flujo = trim($this->input->post("descripcion"));
		$unidadTiempo = trim($this->input->post("unidadTiempo"));
		$usuario=$this->session->userdata('usuario');
		echo $this->modFlujos->addFlujo($cod, $flujo, $usuario, $unidadTiempo);
	}


	public function getFlujoActividades(){
		$usuario=$this->session->userdata('usuario');
		$cod = trim($this->input->post("cod"));
		$flujos=$this->modFlujos->getFlujoActividades($cod, $usuario);
		$text='<table class="table table-hover" id="tblActividades"> <thead> <tr> <th>#</th> <th>Descripción</th> <th></th> </tr> </thead>';
		$text.='<tbody>';
		$cont = 1;
        if($flujos){
            foreach($flujos->result() as $dflujos){
            	$text=$text.'<tr onClick="seleccionFlujo(\'tblActividades\',\''.PROJECT_NAME.'\', this);">';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dflujos->descripcion.'</td>';
            	$text=$text.'<td class="hidden">'.($dflujos->cod).'</td>';
            	$text=$text.'<td class="hidden">'.($dflujos->unidadTiempo).'</td>';
            	$text=$text.'<td style="vertical-align: middle;">';
            		$text=$text.'<button type="button" class="btn btn-danger btn-circle btn-sm"';
            		$text=$text.'onclick="return deleteFlujo(\''.PROJECT_NAME.'\', \''.$dflujos->cod.'\');"><i class="fa fa-times"></i></button></td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="2" class="text-center">No se ha establecido ningún flujo de actividades para el proceso.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        // $text='>.<';
        echo $text;
	}

	public function deleteFlujoActividades(){
		$cod = trim($this->input->post("cod"));
		$codFlujo = trim($this->input->post("codFlujo"));
		$usuario=$this->session->userdata('usuario');
		$respuesta = $this->modFlujos->deleteFlujo($cod, $codFlujo, $usuario);
		$val='1';
		foreach($respuesta->result() as $drespuesta){
			$val= trim($drespuesta->cant);
		}
		echo $val;
	}

	public function seguimiento(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Seguimiento de actividades';
		$data['codProceso'] = trim($this->input->post("txtCodProceso"));
		$data['codFlujo'] = trim($this->input->post("txtCodFlujo"));
		$data['unidadTiempo'] = trim($this->input->post("txtUnidadTiempo"));
		$data['descripcion'] = trim($this->input->post("txtDescripcion"));
		$data['usuario']=$this->session->userdata('usuario');
		$data['actividades'] = $this->modActividades->getActividades($data);
		$this ->loadViewActividades('actividades/regActividades', $data, 'actividades/modalResumen');
	}

	public function setActividad(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Seguimiento de actividades';
		$data['actividad'] = trim($this->input->post("actividad"));
		$data['responsable'] = trim($this->input->post("responsable"));
		$data['codProceso'] = trim($this->input->post("codProceso"));
		$data['codFlujo'] = trim($this->input->post("codFlujo"));
		$data['unidadTiempo'] = trim($this->input->post("unidadTiempo"));
		$data['usuario']=$this->session->userdata('usuario');
		echo $this->modActividades->setActividades($data['actividad'], $data['responsable'], $data['usuario'], $data['codProceso'], $data['codFlujo'], $data['unidadTiempo']);
	}

	public function updateActividad(){
		$descripcion = trim($this->input->post("descripcion"));
		$codProceso = trim($this->input->post("codProceso"));
		$codFlujo = trim($this->input->post("codFlujo"));
		$codActividad = trim($this->input->post("codActividad"));
		$tipoActividad = trim($this->input->post("tipoActividad"));
		$responsable = trim($this->input->post("responsable"));
		$tiempo = trim($this->input->post("tiempo"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modActividades->updActividades($descripcion, $codProceso, $codFlujo, $codActividad, $tipoActividad, $responsable, $tiempo, $usuario);
		echo $query;
	}

	public function deleteActividad(){
		$codProceso = trim($this->input->post("codProceso"));
		$codFlujo = trim($this->input->post("codFlujo"));
		$codActividad = trim($this->input->post("codActividad"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modActividades->deleteActividad($codProceso, $codFlujo, $codActividad, $usuario);
		echo $query;
	}

	public function getNombreProceso(){
		$codProceso = trim($this->input->post("codProceso"));
		$usuario=$this->session->userdata('usuario');
		$query = $this->modProcesos->getNombreProceso($codProceso, $usuario);
		echo $query;
	}

	public function getResumenTipoActividad(){
		$codProceso = trim($this->input->post("codProceso"));
		$codFlujo = trim($this->input->post("codFlujo"));
		$usuario=$this->session->userdata('usuario');
		$reporte=$this->modActividades->getResumenTipoActividad($codProceso, $codFlujo, $usuario);
		$text='<table class="table table-hover" id="tblActividadTiempo"><thead><tr> <th>#</th> <th>Tipo actividad</th> <th>Tiempo</th> <th>Porcentaje</th> </tr></thead>';
		$text.='<tbody>';
		$cont = 1;
		$tiempoTotal = 0;
        if($reporte){
            foreach($reporte->result() as $dreporte){
            	$text=$text.'<tr>';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dreporte->tipo.'</td>';
            	$text=$text.'<td class="text-center">'.round($dreporte->tiempo, 2).'</td>';
            	$text=$text.'<td class="text-center">'.round($dreporte->porcentaje, 2).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
                $tiempoTotal=$tiempoTotal+($dreporte->tiempo);
            }
            if($cont>1){
	            $text=$text.'<tr><td></td><td><b>TOTAL</b></td>';
	        	$text=$text.'<td class="text-center"><b>'.round($tiempoTotal, 2).'</b></td>';
	        	$text=$text.'<td class="text-center"><b>100%</b></td>';
	        	$text=$text.'</tr>';
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="4" class="text-center">No hay actividades registradas en este flujo de proceso.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        // $text='>.<';
        echo $text;
	}

	public function getResumenRolActividad(){
		$codProceso = trim($this->input->post("codProceso"));
		$codFlujo = trim($this->input->post("codFlujo"));
		$usuario=$this->session->userdata('usuario');
		$reporte=$this->modActividades->getResumenRolActividad($codProceso, $codFlujo, $usuario);
		$text='<table class="table table-hover" id="tblRolTiempo"><thead><tr> <th>#</th> <th>Rol</th> <th>Tiempo</th> <th>Porcentaje</th> </tr></thead>';
		$text.='<tbody>';
		$cont = 1;
		$tiempoTotal = 0;
        if($reporte){
            foreach($reporte->result() as $dreporte){
            	$text=$text.'<tr>';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$dreporte->responsable.'</td>';
            	$text=$text.'<td class="text-center">'.round($dreporte->tiempo,2).'</td>';
            	$text=$text.'<td class="text-center">'.round($dreporte->porcentaje,2).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
                $tiempoTotal=$tiempoTotal+($dreporte->tiempo);
            }
            if($cont>1){
	            $text=$text.'<tr><td></td><td><b>TOTAL</b></td>';
	        	$text=$text.'<td class="text-center"><b>'.round($tiempoTotal, 2).'</b></td>';
	        	$text=$text.'<td class="text-center"><b>100%</b></td>';
	        	$text=$text.'</tr>';
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="4" class="text-center">No hay actividades registradas en este flujo de proceso.</td></tr>';
        }
        $text=$text.'</tbody></table>';
        // $text='>.<';
        echo $text;
	}

}

?>