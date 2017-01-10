<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csm extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url().'csm/recursos');
		}else{
			redirect(base_url().'csm/login');
		}
	}

	public function login(){
		if($this->session->userdata('logged_in')){
			redirect(base_url().'csm/recursos');
		}
		$data['titulo']='Process Management';
		$this ->load ->view('header');
		$this ->load ->view('supplyChain/login', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function recursos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Recursos y proveedores';
		$usuario=$this->session->userdata('usuario');
		$data['recursos'] = $this->modProveedores->getRecursos($usuario);
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view('supplyChain/regRecurso', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function autenticar(){
		$user = $this->input->post("txtUser");
		$passw = $this->input->post("txtPassw");
		$data = $this->modUser->autenticar($user, $passw);
		var_dump($data);
		if(isset($data)){
			if($data){
				foreach ($data->result() as $userdata) {
					$nombre=$userdata->nombre;
					$user=$userdata->usuario;
					$empresa=$userdata->empresa;
				}
				if(isset($nombre)){
					$sess =  array(
	                   'nombre' => $nombre,
	                   'usuario' => $user,
	                   'empresa' => $empresa,
	                   'logged_in' => TRUE
	               	);
					$this->session->set_userdata($sess);
				}
			}
		}
		if($this->session->userdata('logged_in')){
			redirect(base_url().'csm/recursos');
		}else{
			redirect(base_url().'csm/login');
		}
	}

	public function registrar(){
		$data['nombres'] = $this->input->post("txtNombres");
		$data['apellidos'] = $this->input->post("txtApellidos");
		$data['empresa'] = $this->input->post("txtEmpresa");
		$data['user'] = $this->input->post("txtUser");
		$data['passw'] = $this->input->post("txtPassw");
		$this->modUser->registrar($data);
		redirect(base_url().'csm/login');
	}

	public function clientes(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Clientes y distribuidores';
		$usuario=$this->session->userdata('usuario');
		$data['clientes'] = $this->modClientes->getClientes($usuario);
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view('supplyChain/regCliente', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function setRecursos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['nombre'] = $this->input->post("txtRecurso");
		$data['descripcion'] = $this->input->post("txtDescripcion");
		$data['nivel'] = $this->input->post("cboNivel");
		$data['usuario']=$this->session->userdata('usuario');
		$this->modProveedores->setRecurso($data);
		redirect(base_url().'csm/recursos');
	}

	public function deleteRecursos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['cod'] = $this->input->post("txtCod");
		$data['usuario']=$this->session->userdata('usuario');
		echo $this->modProveedores->delRecurso($data);
		redirect(base_url().'csm/recursos');
	}

	public function setClientes(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['nombre'] = $this->input->post("txtCliente");
		$data['descripcion'] = $this->input->post("txtDescripcion");
		$data['nivel'] = $this->input->post("cboNivel");
		$data['usuario']=$this->session->userdata('usuario');
		$this->modClientes->setCliente($data);
		redirect(base_url().'csm/clientes');
	}

	public function deleteClientes(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['cod'] = $this->input->post("txtCod");
		$data['usuario']=$this->session->userdata('usuario');
		$this->modClientes->delClientes($data);
		redirect(base_url().'csm/clientes');
	}

	public function nivelesR(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Recursos y proveedores';
		$usuario=$this->session->userdata('usuario');
		$data['recursos'] = $this->modProveedores->getRecursos($usuario);
		$this->db->reconnect();
		$data['relations'] = $this->modProveedores->getRelationsR($usuario);
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view('supplyChain/nivRecurso', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function getDestinosR(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$cod = $this->input->post("cod");
		$usuario=$this->session->userdata('usuario');
		$destinos=$this->modProveedores->getDestinos($cod, $usuario);
		$text='<table class="table table-hover"><thead><tr><th>#</th><th>Recurso o proveedor</th><th>Descripción</th></tr></thead>';
		$text.='<tbody>';
        if($destinos){  
        	$cont = 1;
        	try{
	            foreach($destinos->result() as $ddestinos){
	            	$text=$text.'<tr onclick="seleccionFilaCsm(\'tblDestino\',this,\''.base_url().'\', \'P\');">';
	            	$text=$text.'<td class="a-center">'.($cont).'</td>';
	            	$text=$text.'<td>'.$ddestinos->nombre.'</td>';
	            	$text=$text.'<td>'.$ddestinos->descripcion.'</td>';
	            	$text=$text.'<td class="hidden">'.($ddestinos->cod).'</td>';
	            	$text=$text.'</tr>';
	                $cont = $cont +1;
	            }
        	}catch(Exception $e){}
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="3" class="text-center">Seleccione un proveedor de origen</td></tr>';
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function setRelacionRecursos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$codOrigen = trim($this->input->post("txtCodOrigen"));
		$codDestino = trim($this->input->post("txtCodDestino"));
		$usuario=$this->session->userdata('usuario');
		$this->modProveedores->setRelacionRecursos($codOrigen, $codDestino, $usuario);
		redirect(base_url().'csm/nivelesR');
	}

	public function delRelationRecursos(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$codRelation = $this->input->post("txtCodRelation");
		$usuario=$this->session->userdata('usuario');
		$this->modProveedores->delRelation($codRelation, $usuario);
		redirect(base_url().'csm/nivelesR');
	}


	public function nivelesC(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Clientes y distribuidores';
		$usuario=$this->session->userdata('usuario');
		$data['clientes'] = $this->modClientes->getClientes($usuario);
		$this->db->reconnect();
		$data['relations'] = $this->modClientes->gerRelationsC($usuario);
		$this ->load ->view('header');
		$this ->load ->view('menu');
		$this ->load ->view('supplyChain/nivCliente', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function getDestinosC(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$cod = $this->input->post("cod");
		$usuario=$this->session->userdata('usuario');
		$destinos=$this->modClientes->getDestinos($cod, $usuario);
		$text='<table class="table table-hover"><thead><tr><th>#</th><th>Clientes o distribuidores</th><th>Descripción</th></tr></thead>';
		$text.='<tbody>';
        if($destinos){  
        	$cont = 1;
            foreach($destinos->result() as $ddestinos){
            	$text=$text.'<tr onclick="seleccionFilaCsm(\'tblDestino\',this,\''.base_url().'\', \'C\');">';
            	$text=$text.'<td class="a-center">'.($cont).'</td>';
            	$text=$text.'<td>'.$ddestinos->nombre.'</td>';
            	$text=$text.'<td>'.$ddestinos->descripcion.'</td>';
            	$text=$text.'<td class="hidden">'.($ddestinos->cod).'</td>';
            	$text=$text.'</tr>';
                $cont = $cont +1;
            }
        }
        if($cont==1){
        	$text=$text.'<tr><td colspan="3" class="text-center">Seleccione un distribuidor o cliente. Si ya seleccionó alguno, entonces es consumidor final. </td></tr>';
        }
        $text=$text.'</tbody></table>';
        echo $text;
	}

	public function setRelacionClientes(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$codOrigen = trim($this->input->post("txtCodOrigen"));
		$codDestino = trim($this->input->post("txtCodDestino"));
		$usuario=$this->session->userdata('usuario');
		$this->modClientes->setRelacionClientes($codOrigen, $codDestino, $usuario);
		redirect(base_url().'csm/nivelesC');
	}

	public function delRelationClientes(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$usuario=$this->session->userdata('usuario');
		$codRelation = $this->input->post("txtCodRelation");
		$this->modProveedores->delRelation($codRelation, $usuario);
		redirect(base_url().'csm/nivelesC');
	}


	public function chainSupply(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$data['titulo']='Cadena de suministro';
		$usuario =$this->session->userdata('usuario');
		$data['usuario'] =$this->session->userdata('usuario');
	  	// $data['provDirectos'] = $this->modMapa->getProvDirectos($usuario);
	  	// $this->db->reconnect();
	  	// $data['cliDirectos'] = $this->modMapa->getCliDirectos($usuario);
	  	// $this->db->reconnect();
	  	// $data['provIndirectos'] = $this->modMapa->getProvIndirectos($usuario);
	  	// $this->db->reconnect();
	  	// $data['cliIndirectos'] = $this->modMapa->getCliIndirectos($usuario);
		$this ->load ->view('headerMap');
		$this ->load ->view('menu');
		$this ->load ->view('supplyChain/supplyChain', $data);
		$this ->load ->view('scripts/scriptsGnral');
	}

	public function getMapa(){
		// $data['USERcod'] = 'admin';			//$this->input->post("txtEmpresaId");
	 //  	$data['provDirectos'] = $this->modMapa->getProvDirectos($data['USERcod']);
	 //  	$data['cliDirectos'] = $this->modMapa->getCliDirectos($data['USERcod']);
	 //  	$data['provIndirectos'] = $this->modMapa->getProvIndirectos($data['USERcod']);
	 //  	$data['cliIndirectos'] = $this->modMapa->getCliIndirectos($data['USERcod']);
		// $this ->load ->view('headerMap');
		// $this ->load ->view('menu');
		// $this ->load ->view('supplyChain/supplyChain', $data);
		// $this ->load ->view('scripts/scriptsGnral');
	}

	public function logout(){
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'csm/login');
		}
		$this->session->sess_destroy();
		redirect(base_url().'csm/login');
	}


}
