<?php 
	if( !defined('BASEPATH')) 
		exit('No se permite acceso al script');

class ModUser extends CI_Model {

    //CONSTRUCTOR DE LA CLASE
    function __construct() {
        parent::__construct();
    }

    public function registrar($data){
        $sql= "call SP_Account (1, '".$data['user']."', '".$data['passw']."', '".$data['nombres']."', '".$data['apellidos']."', '".$data['empresa']."' )";
        $query = $this->db->query($sql);
        return $query;
    }

    public function autenticar($user, $passw){
        $sql= "call SP_Account (2, '".$user."', '".$passw."', '', '', '' )";
        $query = $this->db->query($sql);
        return $query;
    }
}
?>
