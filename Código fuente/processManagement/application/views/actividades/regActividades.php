<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Realizar seguimiento de actividades</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Agregar nueva actividad en el proceso
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="POST" id="formAddActividad" class="form-horizontal" action="#">
                                    <div class="col-md-11">
                                        <div class="col-md-12">
                                            <div class="form-group" id="formDescripcion">
                                                <div class="col-md-2">
                                                    <label for="txtDescripcion" class="control-label">Actividad:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="txtDescripcion" id="txtDescripcion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div id="formResponsable">
                                                    <div class="col-md-2">
                                                        <label for="txtResponsable" class="control-label">Responsable:</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input class="form-control" name="txtResponsable" id="txtResponsable">
                                                        <input type="text" name="txtCodProceso" id="txtCodProceso" value="<?php if(isset($codProceso)){
                                                            if($codProceso){
                                                                echo $codProceso;
                                                            }
                                                        } ?>" hidden class="hidden">
                                                        <input type="text" name="txtCodFlujo" id="txtCodFlujo" value="<?php if(isset($codFlujo)){
                                                            if($codFlujo){
                                                                echo $codFlujo;
                                                            }
                                                        } ?>" hidden class="hidden">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="control-label">* El tiempo asignado a las actividades será en <?php if(isset($unidadTiempo)){
                                                            if($unidadTiempo){
                                                                echo $unidadTiempo;
                                                            }
                                                        } ?></label>
                                                    <input type="text" name="txtUnidadTiempo" id="txtUnidadTiempo" value="<?php if(isset($unidadTiempo)){
                                                            if($unidadTiempo){
                                                                echo $unidadTiempo;
                                                            }
                                                        } ?>" hidden class="hidden">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-11 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="return validarActividad('<?php echo PROJECT_NAME; ?>');"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <!-- table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tblActividades">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="vertical-align: middle; text-align: center;">Descripción de actividad</th>
                                    <th style="vertical-align: middle; text-align: center;"><img src="<?php echo PROJECT_NAME; ?>img/operacion.png" width="40"></th>
                                    <th style="vertical-align: middle; text-align: center;"><img src="<?php echo PROJECT_NAME; ?>img/demora.png" width="40"></th>
                                    <th style="vertical-align: middle; text-align: center;"><img src="<?php echo PROJECT_NAME; ?>img/transporte.png" width="40"></th>
                                    <th style="vertical-align: middle; text-align: center;"><img src="<?php echo PROJECT_NAME; ?>img/inspeccion.png" width="40"></th>
                                    <th style="vertical-align: middle; text-align: center;"><img src="<?php echo PROJECT_NAME; ?>img/combinada.png" width="40"></th>
                                    <th style="vertical-align: middle; text-align: center;">Responsable</th>
                                    <th style="vertical-align: middle; text-align: center;">* Tiempo empleado</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($actividades){
                                    $cont = 1;
                                    foreach($actividades->result() as $dactividades){ ?>
                                        <?php $codActiv = $dactividades->codActividad; ?>
                                            <tr class="even pointer" >      <!-- onclick="seleccionActividad('tblActividades', '<?php //echo PROJECT_NAME; ?>', this);" -->
                                                <form role="form" method="POST" class="form-horizontal" action="<?php echo base_url(); ?>actividades/updateActividad">
                                                    <td width="4%" class="a-center"> <?php echo $cont;?> </td>
                                                    <td style="vertical-align: middle;" width="35%"> <input type="text" class="form-control sinborde" name="txtDescripcion" id="txtDescripcion-<?php echo $codActiv; ?>" value="<?php echo $dactividades->descripcion ?>"> </td>
                                                    <?php $tipo=$dactividades->tipo;?>
                                                    <td style="vertical-align: middle;" onClick="seleccionarTipoAct('OPE', '<?php echo $codActiv; ?>', this);" width="5%" 
                                                        <?php if($tipo=='OPE'){
                                                            echo 'class="success"';
                                                        } ?> >
                                                    </td>
                                                    <td style="vertical-align: middle;" onClick="seleccionarTipoAct('DEM', '<?php echo $codActiv; ?>', this);" width="5%" 
                                                        <?php if($tipo=='DEM'){
                                                            echo 'class="success"';
                                                        } ?> >
                                                    </td>
                                                    <td style="vertical-align: middle;" onClick="seleccionarTipoAct('TRA', '<?php echo $codActiv; ?>', this);" width="5%" 
                                                        <?php if($tipo=='TRA'){
                                                            echo 'class="success"';
                                                        } ?> >
                                                    </td>
                                                    <td style="vertical-align: middle;" onClick="seleccionarTipoAct('INS', '<?php echo $codActiv; ?>', this);" width="5%" 
                                                        <?php if($tipo=='INS'){
                                                            echo 'class="success"';
                                                        } ?> >
                                                    </td>
                                                    <td style="vertical-align: middle;" onClick="seleccionarTipoAct('COM', '<?php echo $codActiv; ?>', this);" width="5%" 
                                                        <?php if($tipo=='COM'){
                                                            echo 'class="success"';
                                                        }
                                                         ?> >
                                                    </td>
                                                    <td style="vertical-align: middle;" width="20%"> <input type="text" class="form-control sinborde" name="txtResponsable" id="txtResponsable-<?php echo $codActiv; ?>" value="<?php echo $dactividades->rol; ?>"> </td>
                                                    <td style="vertical-align: middle;" width="8%"> <input type="number" step="any" min="0" class="form-control sinborde" name="txtTiempo" id="txtTiempo-<?php echo $codActiv; ?>" value="<?php echo $dactividades->tiempo; ?>"></td>
                                                    <td class="hidden"><input name="txtCodProceso" id="txtCodProceso-<?php echo $codActiv; ?>" type="text" value="<?php echo $dactividades->codProceso; ?>" hidden readonly="true"></td>
                                                    <td class="hidden"><input name="txtCodFlujo" id="txtCodFlujo-<?php echo $codActiv; ?>" type="text" value="<?php echo $dactividades->codFlujo; ?>" hidden readonly="true"></td>
                                                    <td class="hidden"><input name="txtCodActividad" id="txtCodActividad-<?php echo $codActiv; ?>" type="text" value="<?php echo $codActiv; ?>" hidden readonly="true"></td>
                                                    <td class="hidden"><input name="txtTipoActividad" id="txtTipoActividad-<?php echo $codActiv; ?>" type="text" value="<?php echo $tipo; ?>" hidden readonly="true"></td>
                                                    <td style="vertical-align: middle;" width="4%"> 
                                                        <button type="button" class="btn btn-success btn-circle btn-sm" onclick="return updateActividad('<?php echo PROJECT_NAME; ?>', '<?php echo $codActiv; ?>');"><i class="fa fa-save"></i>
                                                        </button>
                                                    </td>
                                                    <td style="vertical-align: middle;" width="4%"> 
                                                        <button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return deleteActividad('<?php echo PROJECT_NAME; ?>', '<?php echo $codActiv; ?>');"><i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                            <?php
                                            $cont = $cont +1;
                                    }
                                }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <a href="javascript:history.back(-1);" class="btn btn-circle btn-lg btn-default"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <div class="col-md-3 col-md-offset-7" id="btnResumen">
                            <input id="txtCodSelected" type="text" hidden readonly="true">
                            <button class="btn btn-block btn-lg btn-warning" onClick="verResumen('<?php echo PROJECT_NAME; ?>');">
                                RESUMEN DE ANÁLISIS
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper