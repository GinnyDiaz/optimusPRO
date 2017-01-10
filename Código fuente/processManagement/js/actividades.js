
//VARIABLES GLOBALES
var rowFlujoSelected = new Array();
var rowActividadSelected = new Array();
var descripcionFlujo = '';
var codFlujo = 0;
var codProceso = 0;
var codActividad = 0;
var unidadTiempoFlujo = '';


//*****************************************************************
//ACTIVIDADES
//*****************************************************************


function llenarModalFlujoActividades(){
    $('#flujoActividadesTittle').text('Flujos de actividades del proceso '+procesoNombre);
    $('#processName').text(procesoNombre);
    getFlujoActividades();
}

function setFlujoActividades(ruta, user){
    base_url=ruta;
    usuario=user;
    abrirModalFlujoActividades();
}

function seleccionFlujo(tabla, ruta, e){
    base_url=ruta;
    rowFlujoSelected.push(e);
    // indexSelected=rowFlujoSelected[rowFlujoSelected.length-1].cells[0].firstChild.nodeValue;
    if($(e).hasClass("info")){
        $(".info").removeClass("info");
        $('#btnAnalisisActividades').hide('fast');
        $('#txtDescripcion').val('');
        $('#txtCodFlujo').val('');
        $('#txtUnidadTiempo').val('');
    }else{
        $(".info").removeClass("info"); 
        $(e).addClass("info");
        // descripciononFlujo=rowFlujoSelected[rowFlujoSelected.length-1].cells[1].firstChild.nodeValue;
        codFlujo=rowFlujoSelected[rowFlujoSelected.length-1].cells[2].firstChild.nodeValue;
        unidadTiempoFlujo=rowFlujoSelected[rowFlujoSelected.length-1].cells[3].firstChild.nodeValue;
        descripcionFlujo=rowFlujoSelected[rowFlujoSelected.length-1].cells[1].firstChild.nodeValue;
        $('#txtDescripcion').val(descripcionFlujo);
        $('.txtDescripcion').val(descripcionFlujo);
        $('#txtCodFlujo').val(codFlujo);
        $('#txtUnidadTiempo').val(unidadTiempoFlujo);
        $('#btnAnalisisActividades').show();
    }
}


function addFlujoActividades(){
    var flujo = $('#txtFlujo').val();
    var unidadTiempo = $('#cboUnidadTiempo').val();
    if(flujo.length>1){
        $("#formDescripcion").removeClass("has-error");
        $.ajax({
            url: base_url+'index.php/actividades/addFlujoActividades',
            type: 'POST',
            data: 'cod='+codProceso+'&descripcion='+flujo+'&unidadTiempo='+unidadTiempo,
            success:function(respuesta){
                getFlujoActividades();
            },error: function(respuesta){
                // alertify.error('Lo sentimos, no se pueden guardar los datos.');
            }
        });
    }else{
        $("#formDescripcion").addClass("has-error");
        alertify.error('Debe indicar una descripción para el flujo del proceso');
        return false;
    }
}


function getFlujoActividades(){
    // tipoProceso = $('#txtTipo').val();
    $.ajax({
        url: base_url+'index.php/actividades/getFlujoActividades',
        type: 'POST',
        data: 'cod='+codProceso,
        success:function(respuesta){
            document.getElementById('tblActividades').innerHTML=respuesta;
        },error: function(respuesta){
            alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}

function deleteFlujo(ruta, codFlujo){
    $.ajax({
        url: base_url+'index.php/actividades/deleteFlujoActividades',
        type: 'POST',
        data: 'cod='+codProceso+'&codFlujo='+codFlujo,
        success:function(respuesta){
            if(respuesta.trim()=='1'){
                alertify.success('Se eliminó el flujo seleccionado.');
                getFlujoActividades();
            }else{
                alertify.error('No se puede eliminar el flujo seleccionado porque tiene actividades asignadas.');
            }
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}


function submitAnalisisActividades(formulario){
    var desc = $('.txtDescripcion').val();
    var codFlujo = $('#txtCodFlujo').val();
    var codProceso = $('#txtCodProceso').val();
    var unidadTiempo = $('#txtUnidadTiempo').val();
    $('.txtCodProceso').val(codProceso);
    if(codFlujo.length>0 && desc.length>0 && unidadTiempo.length>0){
        formulario.submit();
        return true;
    }else{
        return false;
    }
}


function validarActividad(ruta){
    base_url=ruta;
    var actividad = $('#txtDescripcion').val();
    var responsable = $('#txtResponsable').val();
    codProceso = $('#txtCodProceso').val();
    var codFlujo = $('#txtCodFlujo').val();
    var unidadTiempo = $('#txtUnidadTiempo').val();
    if(actividad.length==0){
        alertify.error('Indique una descripción para la actividad');
        $("#formDescripcion").addClass("has-error");
        return false;
    }else{
        $("#formDescripcion").removeClass("has-error");
    }
    if(responsable.length==0){
        alertify.error('Digite el responsable de la actividad.');
        $("#formResponsable").addClass("has-error");
        return false;
    }else{
        $("#formResponsable").removeClass("has-error");
    }
    $.ajax({
        url: base_url+'index.php/actividades/setActividad',
        type: 'POST',
        data: 'actividad='+actividad+'&responsable='+responsable+'&codProceso='+codProceso+'&codFlujo='+codFlujo+'&unidadTiempo='+unidadTiempo,
        success:function(respuesta){
            alertify.success('Se ha registrado la actividad: '+actividad);
            location.reload();
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}


function seleccionarTipoAct(tipoSelected, codActividad, cellSelected){
    var row= new Array();
    var tipoAnterior = $('#txtTipoActividad-'+codActividad).val();
    if(tipoAnterior!=tipoSelected){
        row.push(cellSelected.parentNode);
        $(cellSelected).addClass('success');
        var celda = 0;
        switch (tipoAnterior) {
            case 'OPE': celda = row[row.length-1].cells[2];
                    break;
            case 'DEM': celda = row[row.length-1].cells[3];
                    break;
            case 'TRA': celda = row[row.length-1].cells[4];
                    break;
            case 'INS': celda = row[row.length-1].cells[5];
                    break;
            case 'COM': celda = row[row.length-1].cells[6];
                    break;
        }
        $(celda).removeClass('success');
        $('#txtTipoActividad-'+codActividad).val(tipoSelected);
    }
}

function updateActividad(ruta, codActividad){
    base_url=ruta;
    var descripcion = $('#txtDescripcion-'+codActividad).val();
    codProceso = $('#txtCodProceso-'+codActividad).val();
    var codFlujo = $('#txtCodFlujo-'+codActividad).val();
    var tipoActividad = $('#txtTipoActividad-'+codActividad).val();
    var responsable = $('#txtResponsable-'+codActividad).val();
    var tiempo = $('#txtTiempo-'+codActividad).val();
    if (descripcion.length>1 && responsable.length>1 && tiempo>=0){
        $.ajax({
            url: base_url+'index.php/actividades/updateActividad',
            type: 'POST',
            data: 'descripcion='+descripcion+'&codProceso='+codProceso+'&codFlujo='+codFlujo+'&codActividad='+codActividad+'&tipoActividad='+tipoActividad+'&responsable='+responsable+'&tiempo='+tiempo,
            success:function(respuesta){
                alertify.success('Se registró la actividad: '+descripcion);
            },error: function(respuesta){
                // alertify.error('Datos inválidos');
            }
        });
    }else{
        alertify.error('Complete todos los datos');
    }
}

function deleteActividad(ruta, codActividad){
    base_url=ruta;
    var descripcion = $('#txtDescripcion-'+codActividad).val();
    codProceso = $('#txtCodProceso-'+codActividad).val();
    var codFlujo = $('#txtCodFlujo-'+codActividad).val();
    $.ajax({
        url: base_url+'index.php/actividades/deleteActividad',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codFlujo='+codFlujo+'&codActividad='+codActividad,
        success:function(respuesta){
            alertify.success('Se ha eliminado la actividad: '+descripcion);
            location.reload();
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}

function verResumen(ruta){
    base_url=ruta;
    codActividad = $('#txtCodSelected').val();
    codProceso = $('#txtCodProceso').val();
    codFlujo = $('#txtCodFlujo').val();
    getNombreProceso(codProceso);
}

function getNombreProceso(codProceso){
    $.ajax({
        url: base_url+'index.php/actividades/getNombreProceso',
        type: 'POST',
        data: 'codProceso='+codProceso,
        success:function(respuesta){
            $('#processName').text(respuesta);
            getResumenValues();
        },error: function(respuesta){
            return '';
        }
    });
}

function getResumenValues(){
    getResumenPrcentaje('tblActividadTiempo', 'getResumenTipoActividad');
    getResumenPrcentaje('tblRolTiempo', 'getResumenRolActividad');
    abrirModalResumen();
}

function getResumenPrcentaje(tabla, controlador){
    $.ajax({
        url: base_url+'index.php/actividades/'+controlador,
        type: 'POST',
        data: 'codProceso='+codProceso+'&codFlujo='+codFlujo,
        success:function(respuesta){
            document.getElementById(tabla).innerHTML=respuesta;
        },error: function(respuesta){
            return '';
        }
    });
}




function abrirModalResumen(){
    // limpiarEmpresas();
    $('#modalResumen').modal({
        show:true,
        backdrop:'static',
    }); 
}




//************************************************************************
//OBJETIVOS
//************************************************************************


var codObjetivo = '';
var descObjetivo = '';
var rowObjetivoSelected = new Array();

function addObjetivo(ruta){
    base_url=ruta;
    descObjetivo = $('#txtObjetivo').val();
    var perspectiva = $('#cboPerspectiva').val();
    codProceso = $('#txtCodProceso').val();
    if(descObjetivo.length==0){
        alertify.error('Debe indicar el objetivo estratégico');
        $("#formObjetivo").addClass("has-error");
        return false;
    }else{
        $("#formObjetivo").removeClass("has-error");
    }
    $.ajax({
        url: base_url+'index.php/objetivos/setObjetivo',
        type: 'POST',
        data: 'descObjetivo='+descObjetivo+'&perspectiva='+perspectiva+'&codProceso='+codProceso,
        success:function(respuesta){
            alertify.success('Se ha registrado el objetivo.');
            location.reload();
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}

function deleteObjetivo(ruta, codObjetivo, codProceso){
    base_url=ruta;
    $.ajax({
        url: base_url+'index.php/objetivos/deleteObjetivo',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codObjetivo='+codObjetivo,
        success:function(respuesta){
            if(respuesta.trim()=='true'){
                alertify.success('Se ha eliminado el objetivo seleccionado');
                location.reload();
            }else{
                alertify.error('No se puede eliminar el objetivo porque está relacionado con otros objetivos en el mapa estratégico.');
            }
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}

function seleccionObjetivo(tabla, ruta, e){
    base_url=ruta;
    rowObjetivoSelected.push(e);
    if($(e).hasClass("warning")){
        $(".warning").removeClass("warning");
        $('#btnFilaObjetivos').hide('fast');
        $('#txtCodObjSelected').val('');
        $('#txtCodProcSelected').val('');
    }else{
        $(".warning").removeClass("warning"); 
        $(e).addClass("warning");
        codProceso=rowObjetivoSelected[rowObjetivoSelected.length-1].cells[3].firstChild.nodeValue;
        codObjetivo=rowObjetivoSelected[rowObjetivoSelected.length-1].cells[4].firstChild.nodeValue;
        descObjetivo=rowObjetivoSelected[rowObjetivoSelected.length-1].cells[1].firstChild.nodeValue;
        $('#txtCodObjSelected').val(codObjetivo);
        $('#txtCodProcSelected').val(codProceso);
        $('#btnFilaObjetivos').show();
    }
}

function verRelacionObj(ruta){
    base_url=ruta;
    codProceso = $('#txtCodProcSelected').val();
    codObjetivo = $('#txtCodObjSelected').val();
    $('#descripcionObj').text(descObjetivo);
    getObjetivosDisponibles();
    getObjRelacionados();
    abrirModalRelacionObj();
}

function abrirModalRelacionObj(){
    $('#modalRelacion').modal({
        show:true,
        backdrop:'static',
    }); 
}

function getObjetivosDisponibles(){
    // tipoProceso = $('#txtTipo').val();
    $.ajax({
        url: base_url+'index.php/objetivos/getObjDisponibles',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codObjetivo='+codObjetivo,
        success:function(respuesta){
            document.getElementById('tblDisponibles').innerHTML=respuesta;
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}

function getObjRelacionados(){
    // tipoProceso = $('#txtTipo').val();
    $.ajax({
        url: base_url+'index.php/objetivos/getObjRelacionados',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codObjetivo='+codObjetivo,
        success:function(respuesta){
            document.getElementById('tblObjRelacionados').innerHTML=respuesta;
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}

function seleccionarObjetivo(tblOrigen, tblDestino, ruta, e){
    try{
        rowSelected.push(e); 
        indexSelected=rowSelected[rowSelected.length-1].cells[0].firstChild.nodeValue;
        var descripcion=document.getElementById(tblOrigen).tBodies[0].rows[indexSelected-1].cells[1].innerHTML;
        var perspectiva=document.getElementById(tblOrigen).tBodies[0].rows[indexSelected-1].cells[2].innerHTML;
        codProceso=document.getElementById(tblOrigen).tBodies[0].rows[indexSelected-1].cells[3].innerHTML;
        codObjetivo=document.getElementById(tblOrigen).tBodies[0].rows[indexSelected-1].cells[4].innerHTML;
        var tds=$("#"+tblDestino).find('tr')[0].cells.length;
        var trs=$("#"+tblDestino+" tr").length;
        var nuevaFila;
        nuevaFila='<tr ondblclick="seleccionarObjetivo(\''+tblDestino+'\',\''+tblOrigen+'\',\''+ruta+'\', this);">';
        nuevaFila=nuevaFila+'<td class="a-center">'+(trs-1)+'</td> <td>'+descripcion+'</td><td>'+perspectiva+'</td><td class="hidden">'+codProceso+'</td><td class="hidden">'+codObjetivo+'</td></td></tr>';
        $("#"+tblDestino).append(nuevaFila);
        document.getElementById(tblOrigen).deleteRow(indexSelected);
        renumerarFilas(tblOrigen);
        renumerarFilas(tblDestino);
        indexSelected=0;
    }catch(e){
        alert(e);
    }
}

function setRelacionObjetivos(ruta){
    base_url=ruta;
    limpiarRelacionesObj();
}

function limpiarRelacionesObj(){
    codProceso = $('#txtCodProcSelected').val();
    codObjetivo = $('#txtCodObjSelected').val();
    $.ajax({
        url: base_url+'index.php/objetivos/limpiarRelacionesObj',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codObjetivo='+codObjetivo,
        success:function(respuesta){
            recorrerObjDestino();
        },
        error: function(respuesta){
            // alertify.error('Error al guardar los cambios');
        }
    });
}

function recorrerObjDestino(){
    var cant=$("#tblObjRelacionados tbody tr").length;
    if(cant>0){
        $("#tblObjRelacionados tbody tr").each(function (index) {
                var codObjetivoDest;
                $(this).children("td").each(function (index2) {
                    switch (index2) {
                        case 4: codObjetivoDest = $(this).text();
                                break;
                    }
                })
                saveRelacionObjetivos(codObjetivoDest);
                if(cant-1==index){
                    alertify.success('Se registraron los objetivos en los cuales influye el objetivo de '+descObjetivo);
                    $('#modalRelacion').modal('hide');
                }
            })
    }else{
        alertify.success('Se registraron los cambios realizados');
        $('#modalRelacion').modal('hide');
    } 
}


function saveRelacionObjetivos(codObjetivoDest){
    codProceso = $('#txtCodProcSelected').val();
    codObjetivo = $('#txtCodObjSelected').val();
    $.ajax({
        url: base_url+'index.php/objetivos/setRelacionObjetivos',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codObjetivo='+codObjetivo+'&codObjetivoDest='+codObjetivoDest,
        success:function(respuesta){
            return true;
        },
        error: function(respuesta){
            // alertify.error('Hay un error en la conexion');
        }
    });
}


function load() {
    mySavedModel=$('#txtMapaEstrategico').val();
    myDiagram.model = go.Model.fromJson(mySavedModel);
  }

function saveMapaEstrategico(ruta, codProceso){
    mySavedModel=myDiagram.model.toJson();
    myDiagram.isModified = false;
    // alert(mySavedModel);
        $.ajax({
            type: "POST",
            data: {mySavedModel,Guardar:'grabar',param_opcion:'grabar', codProceso:codProceso},
            url: ruta+'objetivos/setMapaEstrategico',
            success: function(datos) {
                alertify.success('Mapa estratégico actualizado');
                location.reload();
            },
            error: function(datos) {
                // alert(datos);
            }
     });
  }




//***************************************************************************
//  INDICADORES
//***************************************************************************

var tituloIndicador;
var codIndicador;
var frecMedicion;

function addIndicador(ruta){
    base_url=ruta;
    tituloIndicador = $('#txtIndicador').val();
    var formula = $('#txtFormula').val();
    var unidadMed = $('#txtUnidadMed').val();
    var meta = $('#txtMeta').val();
    var frecuencia = $('#cboFrecuencia').val();
    codProceso = $('#txtCodProceso').val();
    if(validarNewIndicador(formula, unidadMed, meta)){
        $.ajax({
            url: base_url+'index.php/objetivos/setIndicador',
            type: 'POST',
            data: 'codProceso='+codProceso+'&tituloIndicador='+tituloIndicador+'&formula='+formula+'&unidadMed='+unidadMed+'&meta='+meta+'&frecuencia='+frecuencia,
            success:function(respuesta){
                alertify.success('Se ha registrado el indicador.');
                location.reload();
            },error: function(respuesta){
                // alertify.error('Datos inválidos');
            }
        });
    }
}

function validarNewIndicador(formula, unidadMed, meta){
    if(tituloIndicador.length==0){
        alertify.error('Debe indicar un título para el indicador que está creando');
        $("#formTitulo").addClass("has-error");
        return false;
    }else{
        $("#formTitulo").removeClass("has-error");
    }
    if(formula.length==0){
        alertify.error('Debe asignar una fórmula al indicador');
        $("#formFormula").addClass("has-error");
        return false;
    }else{
        $("#formFormula").removeClass("has-error");
    }
    if(unidadMed.length==0){
        alertify.error('Debe indicar una unidad de medida para el indicador');
        $("#formUnidadMed").addClass("has-error");
        return false;
    }else{
        $("#formUnidadMed").removeClass("has-error");
    }
    if(meta.length==0){
        alertify.error('Indique la meta del indicador');
        $("#formMeta").addClass("has-error");
        return false;
    }else{
        $("#formMeta").removeClass("has-error");
    }
    return true;
}

function seleccionIndicador(tabla, ruta, e){
    base_url=ruta;
    rowSelected.push(e);
    if($(e).hasClass("warning")){
        $(".warning").removeClass("warning");
        $('#btnFilaIndicadores').hide('fast');
        $('#txtCodIndSelected').val('');
        $('#txtCodProcSelected').val('');
    }else{
        $(".warning").removeClass("warning"); 
        $(e).addClass("warning");
        codProceso=rowSelected[rowSelected.length-1].cells[6].firstChild.nodeValue.trim();
        codIndicador=rowSelected[rowSelected.length-1].cells[7].firstChild.nodeValue.trim();
        tituloIndicador=rowSelected[rowSelected.length-1].cells[1].firstChild.nodeValue;
        frecMedicion=rowSelected[rowSelected.length-1].cells[4].firstChild.nodeValue.trim();
        $('#txtCodIndSelected').val(codIndicador);
        $('#txtFrecMedSelected').val(frecMedicion);
        $('#txtCodProcSelected').val(codProceso);
        $('#btnFilaIndicadores').show();
    }
}

function deleteIndicador(ruta, codIndicador, codProceso){
    base_url=ruta;
    $.ajax({
        url: base_url+'index.php/objetivos/deleteIndicador',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codIndicador='+codIndicador,
        success:function(respuesta){
            if(respuesta.trim()=='true'){
                alertify.success('Se ha eliminado el indicador seleccionado');
                location.reload();
            }else{
                alertify.error('No se puede eliminar el indicador porque contiene datos históricos registrados.');
            }
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}

function verHistorial(ruta){
    base_url=ruta;
    codProceso = $('#txtCodProcSelected').val();
    codIndicador = $('#txtCodIndSelected').val();
    frecMedicion = $('#txtFrecMedSelected').val();
    $('#tituloIndicador').text(tituloIndicador);
    validarPeriodo();
    getHistorial();
    abrirModalHistorial();
}

function getHistorial(){
    $.ajax({
        url: base_url+'index.php/objetivos/getHistorial',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codIndicador='+codIndicador,
        success:function(respuesta){
            document.getElementById('tblHistorial').innerHTML=respuesta;
        },error: function(respuesta){
            // alertify.error('Lo sentimos, no se pueden cargar los datos.');
        }
    });
}

function abrirModalHistorial(){
    $('#modalHistorial').modal({
        show:true,
        backdrop:'static',
    });
    abrirCalendar1();
    abrirCalendar2();
    abrirCalendar3();
    abrirCalendar();
}

function validarPeriodo(){
    try{
        if(frecMedicion!='Diaria'){
            div=document.getElementById('frecuenciaDia');
            div.parentNode.removeChild(div);
        }else{
            $('#frecuenciaDia').show();
        }
        if(frecMedicion!='Mensual'){
            div=document.getElementById('frecuenciaMes');
            div.parentNode.removeChild(div);
        }else{
            $('#frecuenciaMes').show();
        }
        if(frecMedicion!='Anual'){
            div=document.getElementById('frecuenciaAnio');
            div.parentNode.removeChild(div);
        }else{
            $('#frecuenciaAnio').show();
        }
    }catch(e){}
}

function setPeriodo(e){
    $('#txtPeriodo').val(e.value);
}

function addHistorial(ruta){
    base_url=ruta;
    var periodo = $('#txtPeriodo').val().trim();
    var valor = $('#txtValor').val().trim();
    codProceso = $('#txtCodProcSelected').val();
    codIndicador = $('#txtCodIndSelected').val();
    if(validarNewHistorial(periodo, valor)){
        $.ajax({
            url: base_url+'index.php/objetivos/addHistorial',
            type: 'POST',
            data: 'codProceso='+codProceso+'&codIndicador='+codIndicador+'&periodo='+periodo+'&valor='+valor,
            success:function(respuesta){
                if(respuesta.trim()=='true'){
                    alertify.success('Se ha agregado el valor como dato histórico.');
                    $('#txtValor').val('');
                    $('#txtValor').focus();
                    getHistorial();
                }else{
                    if(respuesta.trim()=='false2'){
                        alertify.error('Aun no se han establecido los parámetros para el indicador. (semáforo).');
                    }else{
                        alertify.error('El periodo ya tiene asignado un valor.');
                    }
                }
            },error: function(respuesta){
                alertify.error('Datos inválidos');
            }
        });
    }
}

function validarNewHistorial(periodo, valor){
    if(periodo.length==0){
        alertify.error('Debe seleccionar un periodo válido');
        $("#formPeriodo").addClass("has-error");
        return false;
    }else{
        $("#formPeriodo").removeClass("has-error");
    }
    if(valor.length==0){
        alertify.error('Debe indicar el valor del indicador en el periodo seleccionado');
        $("#formValor").addClass("has-error");
        return false;
    }else{
        $("#formValor").removeClass("has-error");
    }
    if(isNaN(valor)){
        alertify.error('Ingrese un valor válido');
        $("#formValor").addClass("has-error");
        return false;
    }else{
        $("#formValor").removeClass("has-error");
    }
    return true;
}

function deleteHistorial(ruta, codHistorial){
    codProceso = $('#txtCodProcSelected').val();
    codIndicador = $('#txtCodIndSelected').val();
    $.ajax({
        url: base_url+'index.php/objetivos/deleteHistorial',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codIndicador='+codIndicador+'&codHistorial='+codHistorial,
        success:function(respuesta){
            getHistorial();
            alertify.success('Se ha eliminado el registro histórico.');
        },error: function(respuesta){
            alertify.error('Datos inválidos');
        }
    });
}

function actualizar(){
    location.reload();
}


function verBSC(ruta){
    base_url=ruta;
    codProceso = $('#txtCodProcSelected').val();
    codIndicador = $('#txtCodIndSelected').val();
    frecMedicion = $('#txtFrecMedSelected').val();
    getDatosIndicador();
    // validarPeriodo();
    // getHistorial();
    abrirModalBSC();
}

function abrirModalBSC(){
    $('#modalBSC').modal({
        show:true,
        backdrop:'static',
    });
}

function getDatosIndicador(){
    $.ajax({
        url: base_url+'index.php/objetivos/getDatosIndicador',
        type: 'POST',
        data: 'codProceso='+codProceso+'&codIndicador='+codIndicador,
        dataType: 'json',
        success:function(respuesta){
            $.each(respuesta, function(key){
                codIndicador = respuesta[key].codIndicador;
                objetivo = respuesta[key].objetivo;
                nombre = respuesta[key].nombre;
                formula = respuesta[key].formula;
                unidadMed = respuesta[key].unidadMed;
                lineaBase = respuesta[key].lineaBase;
                meta = respuesta[key].meta;
                frecMedicion = respuesta[key].frecMedicion;
                responsable = respuesta[key].responsable;
                iniciativas = respuesta[key].iniciativas;
                condMenor = respuesta[key].condMenor;
                condMayor = respuesta[key].condMayor;
            });
            llenarDatosIndicador(objetivo, nombre, formula, unidadMed, lineaBase, meta, frecMedicion, responsable, iniciativas, condMenor, condMayor);
        },error: function(respuesta){
            // alertify.error('Datos inválidos');
        }
    });
}

function llenarDatosIndicador(objetivo, nombre, formula, unidadMed, lineaBase, meta, frecMedicion, responsable, iniciativas, condMenor, condMayor){
    $('#tituloIndicador2').text(tituloIndicador);
    $('#frecuenciaMed').text(frecMedicion);
    if(meta!=0){
        $('#metaBSC').val(meta);
        $('#txtMetaBSC').val(meta);
    }else{
        $('#metaBSC').val('0');
        $('#txtMetaBSC').val('0');
    }
    if(condMenor!=0 || condMayor!=0){
        $('#condGreen').text('  i < '+condMenor);
        $('#condYellow').text(' '+condMenor+' <= i < '+condMayor);
        $('#condRed').text(' i >= '+condMayor);
        $('#txtCondMenor').val(condMenor);
        $('#txtCondMayor').val(condMayor);
    }else{
        $('#condGreen').text('');
        $('#condYellow').text('');
        $('#condRed').text('');
        $('#txtCondMenor').val('0');
        $('#txtCondMayor').val('0');
    }
    if(lineaBase!=0){
        $('#txtLineaBaseBSC').val(lineaBase);
    }else{
        $('#txtLineaBaseBSC').val('0');
    }
    $('#txtObjetivoBSC').val(objetivo);
    $('#txtIndicadorBSC').val(nombre);
    $('#txtNombreIndicadorBSC').val(nombre);
    $('#txtFormulaBSC').val(formula);
    $('#txtIniciativasBSC').val(iniciativas);
    $('#txtResponsableBSC').val(responsable);
    $('#cboObjetivos').val(objetivo.trim());
}

function updIndicador(){
    codProceso = $('#txtCodProcSelected').val();
    codIndicador = $('#txtCodIndSelected').val();
    try{
        var objetivo=$('#cboObjetivos').val().trim();
    }catch(e){
        alertify.error('Seleccione un objetivo');
        return false;
    }
    var nombre=$('#txtIndicadorBSC').val();
    var formula=$('#txtFormulaBSC').val();
    var lineaBase=$('#txtLineaBaseBSC').val();
    var meta=$('#txtMetaBSC').val();
    var condMenor=$('#txtCondMenor').val();
    var condMayor=$('#txtCondMayor').val();
    var iniciativas=$('#txtIniciativasBSC').val();
    var responsable=$('#txtResponsableBSC').val();
    if(validarBSC(objetivo, nombre, formula, lineaBase, meta, condMenor, condMayor)){
        $.ajax({
            url: base_url+'index.php/objetivos/updIndicador',
            type: 'POST',
            data: 'codProceso='+codProceso+'&codIndicador='+codIndicador+'&objetivo='+objetivo+'&nombre='+nombre
                +'&formula='+formula+'&lineaBase='+lineaBase+'&meta='+meta+'&condMenor='+condMenor+'&condMayor='+condMayor
                +'&iniciativas='+iniciativas+'&responsable='+responsable,
            success:function(respuesta){
                alertify.success('Se ha realizado los cambios.');
                $('#modalBSC').modal('hide');
            },error: function(respuesta){
                alertify.error('Datos inválidos');
            }
        });
    }
}

function validarBSC(objetivo, nombre, formula, lineaBase, meta, condMenor, condMayor){
    if(objetivo.length<1){
        alertify.error('Digite el objetivo del indicador');
        return false;
    }
    if(nombre.length<1){
        alertify.error('Digite el nombre del indicador');
        return false;
    }
    if(formula.length<1){
        alertify.error('Digite la formula del indicador');
        return false;
    }
    if(lineaBase.length<1){
        alertify.error('Digite la lineaBase del indicador');
        return false;
    }
    if(meta.length<1){
        alertify.error('Digite el valor meta del indicador');
        return false;
    }
    if(condMenor.length<1 || condMayor.length<1){
        alertify.error('Complete los valores en la condición del semáforo del indicador');
        return false;
    }
    if(condMenor>=condMayor){
        alertify.error('Los valores del semáforo son inválidos');
        return false;
    }
    return true;
}




