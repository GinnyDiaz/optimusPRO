var rowSelected=new Array();
var indexSelected = 0;
var base_url;


function validarLogin(formulario){
	var usuario = $('#txtUserL').val();
	var pass = $('#txtPasswL').val();
	if(usuario.length==0){
		alertify.error('Digite un nombre de usuario');
		$("#formUserL").addClass("has-error");
		return false;
	}else{
		$("#formUserL").removeClass("has-error");
	}
	if(pass.length==0){
		alertify.error('Debe completar su contraseña');
		$("#formPasswL").addClass("has-error");
		return false;
	}else{
		$("#formPasswL").removeClass("has-error");
	}
	form=document.getElementById(formulario);
	form.submit();
	return true;
}

function validarRegistro(formulario){
	var nombres = $('#txtNombres').val();
	var apellidos = $('#txtApellidos').val();
	var empresa = $('#txtEmpresa').val();
	var usuario = $('#txtUser').val();
	var pass = $('#txtPassw').val();
	if(nombres.length==0){
		alertify.error('Complete su nombre');
		$("#formNombresR").addClass("has-error");
		return false;
	}else{
		$("#formNombresR").removeClass("has-error");
	}
	if(empresa.length==0){
		alertify.error('Digite la empresa para la que realizará la cadena de suministros.');
		$("#formEmpresaR").addClass("has-error");
		return false;
	}else{
		$("#formEmpresaR").removeClass("has-error");
	}
	if(usuario.length==0){
		alertify.error('Digite un nombre de usuario');
		$("#formUserR").addClass("has-error");
		return false;
	}else{
		$("#formUserR").removeClass("has-error");
	}
	if(pass.length==0){
		alertify.error('Debe completar su contraseña');
		$("#formPasswR").addClass("has-error");
		return false;
	}else{
		$("#formPasswR").removeClass("has-error");
	}
	form=document.getElementById(formulario);
	form.submit();
	return true;
}


function validarRecurso (form) {
	var nombre = $('#txtRecurso').val();
	var descripcion = $('#txtDescripcion').val();
	var nivel = $('#cboNivel').val();
	if(nombre.length<3){
		alertify.error('Debe registrar un recurso o proveedor válido');
		$("#formNombre").addClass("has-error");
		return false;
	}else{
		$("#formNombre").removeClass("has-error");
	}
	if(descripcion.length<3){
		alertify.error('Debe registrar una descripción válida');
		$("#formDescripcion").addClass("has-error");
		return false;
	}else{
		$("#formDescripcion").removeClass("has-error");
	}
	form=document.getElementById('regRecurso');
	form.submit();
	return true;
}

function limpiarRecurso(){
	$('#txtRecurso').val('');
	$('#txtDescripcion').val('');
	$('#cboNivel').val(1);
}

function validarCliente (form) {
	var nombre = $('#txtCliente').val();
	var descripcion = $('#txtDescripcion').val();
	var nivel = $('#cboNivel').val();
	if(nombre.length<3){
		alertify.error('Debe registrar un Cliente o distribuidor válido');
		$("#formNombre").addClass("has-error");
		return false;
	}else{
		$("#formNombre").removeClass("has-error");
	}
	if(descripcion.length<3){
		alertify.error('Debe registrar una descripción válida');
		$("#formDescripcion").addClass("has-error");
		return false;
	}else{
		$("#formDescripcion").removeClass("has-error");
	}
	form=document.getElementById('regCliente');
	form.submit();
	return true;
}

function limpiarCliente(){
	$('#txtCliente').val('');
	$('#txtDescripcion').val('');
	$('#cboNivel').val(1);
}

function seleccionFilaCsm(tabla, e, ruta, tipo){
	base_url=ruta;
	rowSelected.push(e); 
    indexSelected=rowSelected[rowSelected.length-1].cells[0].firstChild.nodeValue;
    var valueSelected=rowSelected[rowSelected.length-1].cells[1].firstChild.nodeValue;
    var codSelected=rowSelected[rowSelected.length-1].cells[3].firstChild.nodeValue;
    if(tabla=='tblOrigen'){
	    if($(e).hasClass("info")){
	        origenSeleccionadoCsm(indexSelected, valueSelected, codSelected, false, e, tipo);
	    }else{
			origenSeleccionadoCsm(indexSelected, valueSelected, codSelected, true, e, tipo);
	    }
    }else{
    	if($(e).hasClass("warning")){
	        destinoSeleccionadoCsm(indexSelected, valueSelected, codSelected, false, e, tipo);
	    }else{
			destinoSeleccionadoCsm(indexSelected, valueSelected, codSelected, true, e, tipo);
	    }
    }
}

function origenSeleccionadoCsm(indexSelected, valueSelected, codSelected, flag, e, tipo){
	if(flag){
		$(".info").removeClass("info"); 
		$(e).addClass("info");
		getDestinosCsm(codSelected, tipo);
		$('#txtOrigen').val(valueSelected);
		$('#txtCodOrigen').val(codSelected);
		$('#txtDestino').val('');
		$('#txtCodDestino').val('');
	}else{
		getDestinosCsm(0);
		$(".info").removeClass("info");
	    $('#txtOrigen').val('');
	    $('#txtCodOrigen').val('');
	    $('#txtDestino').val('');
	    $('#txtCodDestino').val('');
	}
}

function destinoSeleccionadoCsm(indexSelected, valueSelected, codSelected, flag, e, tipo){
	if(flag){
		$(".warning").removeClass("warning"); 
		$(e).addClass("warning");
		$('#txtDestino').val(valueSelected);
		$('#txtCodDestino').val(codSelected);
	}else{
		$(".warning").removeClass("warning");
	    $('#txtDestino').val('');
	    $('#txtCodDestino').val('');
	}
}

function getDestinosCsm(codSelected, tipo){
	if(tipo=='P'){
		$.ajax({
	        url: base_url+'csm/getDestinosR',
	        type: 'POST',
	        data: 'cod='+codSelected,
	        success:function(respuesta){
	        	document.getElementById('tblDestino').innerHTML=respuesta;
	        },error: function(respuesta){
	            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
	        }
	    });
	}
	if(tipo=='C'){
		$.ajax({
	        url: base_url+'csm/getDestinosC',
	        type: 'POST',
	        data: 'cod='+codSelected,
	        success:function(respuesta){
	        	document.getElementById('tblDestino').innerHTML=respuesta;
	        },error: function(respuesta){
	            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
	        }
	    });
	}
}

function validarRelation(formulario) {
	var origen = $('#txtOrigen').val();
	var destino = $('#txtDestino').val();
	if(origen.trim().length==0){
		if(formulario=='frmRelacionRecursos'){
			alertify.error('Debe seleccionar un proveedor o recurso de origen válido');
		}else{
			alertify.error('Debe seleccionar un distribuidor o cliente de origen válido');
		}
		$("#formOrigen").addClass("has-error");
		return false;
	}else{
		$("#formOrigen").removeClass("has-error");
	}
	if(destino.trim().length==0){
		if(formulario=='frmRelacionRecursos'){
			alertify.error('Debe seleccionar un proveedor o recurso de destino válido');
		}else{
			alertify.error('Debe seleccionar un distribuidor o cliente de destino válido');
		}
		$("#formDestino").addClass("has-error");
		return false;
	}else{
		$("#formDestino").removeClass("has-error");
	}
	form=document.getElementById(formulario);
	form.submit();
	return true;
}



//*****************************************************
//GRAFICO DE CADENA DE SUMINISTROS
//*****************************************************


window.onload = function() {
	try{
		init();
	}catch(e){	}
}


  function doubleTreeLayout(diagram) {
    // Within this function override the definition of '$' from jQuery:
    var $ = go.GraphObject.make;  // for conciseness in defining templates
    diagram.startTransaction("Double Tree Layout");

    // split the nodes and links into two Sets, depending on direction
    var leftParts = new go.Set(go.Part);
    var rightParts = new go.Set(go.Part);
    separatePartsByLayout(diagram, leftParts, rightParts);
    // but the ROOT node will be in both collections

    // create and perform two TreeLayouts, one in each direction,
    // without moving the ROOT node, on the different subsets of nodes and links
    var layout1 =
      $(go.TreeLayout,
        { angle: 180,
          arrangement: go.TreeLayout.ArrangementFixedRoots,
          setsPortSpot: false });

    var layout2 =
      $(go.TreeLayout,
        { angle: 0,
          arrangement: go.TreeLayout.ArrangementFixedRoots,
          setsPortSpot: false });

    layout1.doLayout(leftParts);
    layout2.doLayout(rightParts);

    diagram.commitTransaction("Double Tree Layout");
  }

  function separatePartsByLayout(diagram, leftParts, rightParts) {
    var root = diagram.findNodeForKey("Root");
    if (root === null) return;
    // the ROOT node is shared by both subtrees!
    leftParts.add(root);
    rightParts.add(root);
    // look at all of the immediate children of the ROOT node
    root.findTreeChildrenNodes().each(function(child) {
        // in what direction is this child growing?
        var dir = child.data.dir;
        var coll = (dir === "left") ? leftParts : rightParts;
        // add the whole subtree starting with this child node
        coll.addAll(child.findTreeParts());
        // and also add the link from the ROOT node to this child node
        coll.add(child.findTreeParentLink());
      });
  }

