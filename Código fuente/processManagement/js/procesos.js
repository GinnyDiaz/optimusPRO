var rowSelected=new Array();
var indexSelected = 0;
var base_url;
var esMacroProceso = 'SI';
var procesoNombre = '';
var procesoResponsable = '';
var tipoProceso = '';
var codProceso = '';
var usuario = '';

function validarProceso(formulario){
	var nombres = $('#txtNombre').val();
	var responsable = $('#txtResponsable').val();
	if(nombres.length==0){
		alertify.error('Complete el nombre del proceso');
		$("#formNombre").addClass("has-error");
		return false;
	}else{
		$("#formNombre").removeClass("has-error");
	}
	if(responsable.length==0){
		alertify.error('Digite el responsable del proceso.');
		$("#formResponsable").addClass("has-error");
		return false;
	}else{
		$("#formResponsable").removeClass("has-error");
	}
	// form=document.getElementById(formulario);
	formulario.submit();
	return true;
}

function validarDeleteProceso(formulario){
    alertify.confirm("¿Esta seguro de eliminar el proceso? Recuerde que si lo elimina, también se eliminarán las relaciones que tenga establecido con otros procesos.", function(e){
            if(e){
                formulario.submit();
            }else{
                alertify.error('No se eliminó el proceso');
            }
            return false;
        }
    );
    // alertify.confirm('Confirm message', function(){alertify.success('OK')}, function(){alertify.error('No');} );
}


function limpiarProceso(){
	$('#txtNombre').val('');
	$('#txtResponsable').val('');
	$('#chkMacro').attr("checked", false);
}


function seleccionProceso(tabla, e, ruta){
	base_url=ruta;
	// var tipo = $('#txtTipo').val().trim();
	rowSelected.push(e); 
    indexSelected=rowSelected[rowSelected.length-1].cells[0].firstChild.nodeValue;
    esMacroProceso=rowSelected[rowSelected.length-1].cells[3].firstChild.nodeValue;		//Si es macro proceso
    codProceso=rowSelected[rowSelected.length-1].cells[5].firstChild.nodeValue;
    procesoNombre=rowSelected[rowSelected.length-1].cells[1].firstChild.nodeValue;
    procesoResponsable=rowSelected[rowSelected.length-1].cells[2].firstChild.nodeValue;
    if($(e).hasClass("warning")){
        $(".warning").removeClass("warning");
        $('#btnProcesoSelected').hide('fast');
        $('#btnSubProcesos').hide('fast');
		// $('#btnHojaCaract').hide('fast');
  //       $('#btnObjetivos').hide('fast');
  //       $('#btnActividades').hide('fast');
    }else{
    	$(".warning").removeClass("warning"); 
		$(e).addClass("warning");
		if(esMacroProceso.trim()=='SI'){
        	$('#btnSubProcesos').show();
        }else{
        	$('#btnSubProcesos').hide('fast');
        }
		$('#btnProcesoSelected').show();
        // $('#btnHojaCaract').show();
        // $('#btnObjetivos').show();
        // $('#btnActividades').show();
        $('.txtCodProceso').val(codProceso);
        $('.txtDescProceso').val(procesoNombre);
        $('.txtRespProceso').val(procesoResponsable);
    }
}

function detallarSubProcesos(ruta, user){
	base_url=ruta;
	usuario=user;
	abrirModalMacro();
}

function llenarModalSubProc(){
	$('#macroNombreTittle').text('Sub procesos de '+procesoNombre);
	$('#macroName').text(procesoNombre);
	getProcesosDisponibles();
	getSubProcesos();
}


function getProcesosDisponibles(){
	tipoProceso = $('#txtTipo').val();
	$.ajax({
        url: base_url+'index.php/procesos/getProcesosDisponibles',
        type: 'POST',
        data: 'tipo='+tipoProceso+'&usuario='+usuario,
        success:function(respuesta){
        	document.getElementById('tblDisponibles').innerHTML=respuesta;
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}

function getSubProcesos(){
	tipoProceso = $('#txtTipo').val();
	$.ajax({
        url: base_url+'index.php/procesos/getSubProcesos',
        type: 'POST',
        data: 'tipo='+tipoProceso+'&cod='+codProceso+'&usuario='+usuario,
        success:function(respuesta){
        	document.getElementById('tblSubProcesos').innerHTML=respuesta;
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}


function hacerSubProceso(tblOrigen, tblDestino, ruta, e){
	try{
		rowSelected.push(e); 
    	indexSelected=rowSelected[rowSelected.length-1].cells[0].firstChild.nodeValue;
		var proceso,codProceso;
		proceso= document.getElementById(tblOrigen).tBodies[0];
		proceso= proceso.rows[indexSelected-1];
		proceso= proceso.cells[1];
		proceso= proceso.innerHTML;	
		codProceso=document.getElementById(tblOrigen).tBodies[0].rows[indexSelected-1].cells[2].innerHTML;
		var tds=$("#"+tblDestino).find('tr')[0].cells.length;
	    var trs=$("#"+tblDestino+" tr").length;
	    var nuevaFila;
	    nuevaFila='<tr ondblclick="hacerSubProceso(\''+tblDestino+'\',\''+tblOrigen+'\',\''+ruta+'\', this);"><td class="">'+(trs-1)+'</td><td>'+proceso+'</td><td class="hidden">'+codProceso+'</td></tr>';
		$("#"+tblDestino).append(nuevaFila);
		document.getElementById(tblOrigen).deleteRow(indexSelected);
		renumerarFilas(tblOrigen);
	    renumerarFilas(tblDestino);
		indexSelected=0;
	}catch(e){
		alert(e);
	}
}

function setSubProcesos(ruta){
	base_url=ruta;
	ajaxLimpiarSubProcesos();
}

function recorrerSubprocesos(){
	var cant=$("#tblSubProcesos tbody tr").length;
    if(cant>0){
        $("#tblSubProcesos tbody tr").each(function (index) {
                var codSubProceso;
                $(this).children("td").each(function (index2) {
                    switch (index2) {
                        case 2: codSubProceso = $(this).text();
                                break;
                    }
                })
                ajaxSetSubproceso(codSubProceso);
                if(cant-1==index){
                	alertify.success('Se almacenaron los procesos correspondientes al proceso '+procesoNombre);
                	$('#modalMacroProceso').modal('hide');
                }
            })
    } 
}


function ajaxSetSubproceso(codSubProceso){
    $.ajax({
        url: base_url+'index.php/procesos/setSubProcesos',
        type: 'POST',
        data: 'cod='+codProceso+'&subProceso='+codSubProceso,
        success:function(respuesta){
            return true;
        },
        error: function(respuesta){
            alertify.error('Hay un error en la conexion');
        }
    });
}


function ajaxLimpiarSubProcesos(){
	$.ajax({
        url: base_url+'index.php/procesos/limpiarSubProcesos',
        type: 'POST',
        data: 'codMacro='+codProceso,
        success:function(respuesta){
            recorrerSubprocesos();
        },
        error: function(respuesta){
            alertify.error('Error al actualizar los subprocesos');
        }
    });
}


//********************************************************


function detallarHojaCaract(ruta, user){
	base_url=ruta;
	usuario=user;
	abrirModalCaracterizacion();
}


function llenarModalCaracterizacion(){
	$('#proceso').text(procesoNombre);
	$('#responsable').text(procesoResponsable);
	getCaracterizacion();
}

function getCaracterizacion(){
    $.ajax({
        url: base_url+'index.php/procesos/getCaracterizacion',
        type: 'POST',
        data: 'cod='+codProceso,
        dataType: 'json',
        success:function(respuesta){
            var rpta='';
            $.each(respuesta, function(key){
                mision = respuesta[key].mision;
                empieza = respuesta[key].empieza;
                incluye = respuesta[key].incluye;
                termina = respuesta[key].termina;
                entrada = respuesta[key].entradas;
                proveedor = respuesta[key].proveedores;
                salida = respuesta[key].salidas;
                cliente = respuesta[key].clientes;
                inspecciones = respuesta[key].inspecciones;
                registros = respuesta[key].registros;
                variables = respuesta[key].variables;
                indicadores = respuesta[key].indicadores;
                rpta='ok';
            });
            if(rpta=='ok'){
                llenarDatos(mision, empieza, incluye, termina, entrada, proveedor, salida, cliente, inspecciones, registros, variables, indicadores);
            }else{
                llenarDatos('', '', '', '', '', '', '', '', '', '', '', '');
            }
        },
        error: function(){
            alertify.error('Sin datos que mostrar');
        }
    });
}

function llenarDatos(mision, empieza, incluye, termina, entrada, proveedor, salida, cliente, inspecciones, registros, variables, indicadores){
    $('#txtMision').val(mision);
    $('#txtEmpieza').val(empieza);
    $('#txtIncluye').val(incluye);
    $('#txtTermina').val(termina);
    $('#txtEntrada').val(entrada);
    $('#txtProveedor').val(proveedor);
    $('#txtSalida').val(salida);
    $('#txtCliente').val(cliente);
    $('#txtInspecciones').val(inspecciones);
    $('#txtRegistros').val(registros);
    $('#txtVariables').val(variables);
    $('#txtIndicadores').val(indicadores);
}


function setCaracteristicas(ruta){
    base_url=ruta;
	var mision = $('#txtMision').val();
	var empieza = $('#txtEmpieza').val();
	var incluye = $('#txtIncluye').val();
	var termina = $('#txtTermina').val();
	var entrada = $('#txtEntrada').val();
	var proveedor = $('#txtProveedor').val();
	var salida = $('#txtSalida').val();
	var cliente = $('#txtCliente').val();
	var inspecciones = $('#txtInspecciones').val();
	var registros = $('#txtRegistros').val();
	var variables = $('#txtVariables').val();
	var indicadores = $('#txtIndicadores').val();
    if(codProceso==''){
        codProceso=$('#txtCodProcesoModal').val();
    }
	$.ajax({
        url: base_url+'procesos/setCaracteristicas',
        type: 'POST',
        data: 'cod='+codProceso+'&mision='+mision+'&empieza='+empieza+'&incluye='+incluye+'&termina='+termina+'&entrada='+entrada+'&proveedor='+proveedor+'&salida='+salida+'&cliente='+cliente+'&inspecciones='+inspecciones+'&registros='+registros+'&variables='+variables+'&indicadores='+indicadores,
        success:function(respuesta){
            alertify.success('Se actualizó exitosamente la hoja de caracterización del proceso');
			$('#modalCaracterizacion').modal('hide');
        },
        error: function(respuesta){
            alertify.error('No se puede actualizar los datos registrados');
        }
    });
}


function renumerarFilas(id){
    var table = document.getElementById(id);
    for (var i = 1, row; row = table.rows[i]; i++) {
        table.rows[i].cells[0].innerHTML=i;
    }
}

//*******************************************************************************+

function seleccionFilaProcRel(tabla, e, ruta, tipo){
    base_url=ruta;
    rowSelected.push(e); 
    indexSelected=rowSelected[rowSelected.length-1].cells[0].firstChild.nodeValue;
    procesoNombre=rowSelected[rowSelected.length-1].cells[1].firstChild.nodeValue;
    codProceso=rowSelected[rowSelected.length-1].cells[2].firstChild.nodeValue;
    if(tabla=='tblOrigen'){
        if($(e).hasClass("info")){
            origenSeleccionado(indexSelected, procesoNombre, codProceso, false, e, tipo);       //deseleccionar
        }else{
            origenSeleccionado(indexSelected, procesoNombre, codProceso, true, e, tipo);        //pintar
        }
    }else{
        if($(e).hasClass("warning")){
            destinoSeleccionadoCsm(indexSelected, procesoNombre, codProceso, false, e, tipo);      //deseleccionar
        }else{
            destinoSeleccionadoCsm(indexSelected, procesoNombre, codProceso, true, e, tipo);       //pintar
        }
    }
}

function origenSeleccionado(indexSelected, procesoNombre, codProceso, flag, e, tipo){
    if(flag){       //cuando va a pintar
        $(".info").removeClass("info"); 
        $(e).addClass("info");
        getDestinos(codProceso, tipo);
        $('#txtOrigen').val(procesoNombre);
        $('#txtCodOrigen').val(codProceso);
        $('#txtDestino').val('');
        $('#txtCodDestino').val('');
    }else{          //cuando va a deseleccionar
        getDestinos(0);
        $(".info").removeClass("info");
        $('#txtOrigen').val('');
        $('#txtCodOrigen').val('');
        $('#txtDestino').val('');
        $('#txtCodDestino').val('');
    }
}

function getDestinos(codProceso, tipo){
    $.ajax({
        url: base_url+'procesos/getDestinos',
        type: 'POST',
        data: 'cod='+codProceso+'&tipo='+tipo,
        success:function(respuesta){
            document.getElementById('tblDestino').innerHTML=respuesta;
        },error: function(respuesta){
            alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}








function validarRelProcesos(formulario) {
	var origen = $('#txtOrigen').val();
	var destino = $('#txtDestino').val();
	if(origen.trim().length==0){
		alertify.error('Debe seleccionar un proceso de origen válido');
		$("#formOrigen").addClass("has-error");
		return false;
	}else{
		$("#formOrigen").removeClass("has-error");
	}
	if(destino.trim().length==0){
		alertify.error('Debe seleccionar un proceso de destino válido');
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



//*****************************************************
//MODALES
//*****************************************************

function abrirModalMacro(){
	// limpiarEmpresas();
  	$('#modalMacroProceso').modal({
  		show:true,
  		backdrop:'static',
  	}); 
  	llenarModalSubProc();
}

function abrirModalCaracterizacion(){
	// limpiarEmpresas();
  	$('#modalCaracterizacion').modal({
  		show:true,
  		backdrop:'static',
  	}); 
  	llenarModalCaracterizacion();
}

function abrirModalFlujoActividades(){
    // limpiarEmpresas();
    $('#modalFlujoActividades').modal({
        show:true,
        backdrop:'static',
    }); 
    llenarModalFlujoActividades();
}




//*****************************************************
//GRAFICO
//*****************************************************


function saveMapa(ruta, usuario){
    mySavedModel=myDiagram.model.toJson();
    myDiagram.isModified = false;
    alert(mySavedModel);
        $.ajax({
            type: "POST",
            data: {mySavedModel,Guardar:'grabar',param_opcion:'grabar',usuario:usuario},
            url: ruta+'procesos/setMapaProcesos',
            success: function(datos) {
              // alert(datos);
                if (datos == '') {
                    document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                    myDiagram.isModified = false;
                } else {
                    location.reload();
                }
            },
            error: function(datos) {
              // alert(datos);
                document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                myDiagram.isModified = false;
            }
     });
  }

function load(ruta,empresa) {
    mySavedModel=$('#mySavedModelProcesos').val();
    myDiagram.model = go.Model.fromJson(mySavedModel);
        // $.ajax({
        //     type: "POST",
        //     data: {mySavedModel,Cargar:'Cargar',param_opcion:'Cargar',empresa:empresa},
        //     url: ruta+'procesos/mapaProcesos',
        //     success: function(datos) {
        //         if (datos =='Error') {
        //             alert(datos);
        //         } else {
        //             myDiagram.model = go.Model.fromJson(datos);
        //         }
        //     },
        //     error: function(datos) {
                          
        //     }
        // });
  }


function showCaracterizacion(codProceso, ruta){
    base_url=ruta;
    $('#btnSaveCaracterizacion').hide();
    $('#modalCaracterizacion').modal({
        show:true,
        backdrop:'static',
    }); 
    $('#txtCodProcesoModal').val(codProceso);
    $.ajax({
        url: base_url+'procesos/getCaracterizacion',
        type: 'POST',
        data: 'cod='+codProceso,
        dataType: 'json',
        success:function(respuesta){
            var rpta='';
            $.each(respuesta, function(key){
                nombre = respuesta[key].nombre;
                responsable = respuesta[key].responsable;
                mision = respuesta[key].mision;
                empieza = respuesta[key].empieza;
                incluye = respuesta[key].incluye;
                termina = respuesta[key].termina;
                entrada = respuesta[key].entradas;
                proveedor = respuesta[key].proveedores;
                salida = respuesta[key].salidas;
                cliente = respuesta[key].clientes;
                inspecciones = respuesta[key].inspecciones;
                registros = respuesta[key].registros;
                variables = respuesta[key].variables;
                indicadores = respuesta[key].indicadores;
                rpta='ok';
            });
            if(rpta=='ok'){
                llenarDatos(mision, empieza, incluye, termina, entrada, proveedor, salida, cliente, inspecciones, registros, variables, indicadores);
                $('#proceso').text(nombre);
                $('#responsable').text(responsable);
            }else{
                llenarDatos('', '', '', '', '', '', '', '', '', '', '', '');
            }
        },
        error: function(){
            alertify.error('Sin datos que mostrar');
        }
    });
}
