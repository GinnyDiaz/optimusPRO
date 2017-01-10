<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Registrar Proceso <?php echo $tipo; ?></h3>
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
                            Agregar un nuevo Proceso <?php echo $tipo; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="POST" id="regProceso" class="form-horizontal" action="<?php echo base_url(); ?>procesos/setProcesos">
                                        <div class="col-md-12">
                                            <div class="form-group" id="formNombre">
                                                <div class="col-md-3">
                                                    <label for="txtNombre" class="control-label">Nombre del proceso:</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="txtNombre" id="txtNombre">
                                                    <input class="hidden" id="txtTipo" name="txtTipo" value="<?php echo $tipoCod; ?>" hidden readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-12">
                                            <div class="form-group" id="formResponsable">
                                                <div class="col-md-2">
                                                    <label for="txtResponsable" class="control-label">Responsable:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="txtResponsable" id="txtResponsable">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-5">
                                            <div class="text-right col-md-12">
                                                <div class="form-group">
                                                    <label class="checkbox">
                                                        <input type="checkbox" id="chkMacro" name="chkMacro">Es un macro-proceso
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="return validarProceso(this.form);"><i class="fa fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-circle btn-lg" onclick="return limpiarProceso();"><i class="fa fa-eraser"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <!-- table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tblProcesos">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Proceso</th>
                                    <th>Responsable</th>
                                    <th>Es macro</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($procesos){
                                    $cont = 1;
                                    foreach($procesos->result() as $dprocesos){ ?>
                                            <tr class="even pointer" onclick="seleccionProceso('tblProcesos',this, '<?php echo PROJECT_NAME; ?>');">
                                                <form role="form" method="POST" class="form-horizontal" action="<?php echo base_url(); ?>procesos/deleteProcesos">
                                                    <td class="a-center"> <?php echo $cont;?> </td>
                                                    <td> <?php echo $dprocesos->nombre ?> </td>
                                                    <td> <?php echo $dprocesos->responsable ?> </td>
                                                    <td> <?php echo $dprocesos->esMacro ?> </td>
                                                    <td class="hidden"><input name="txtCod" type="text" value="<?php echo $dprocesos->cod; ?>" hidden readonly></td>
                                                    <td class="hidden"><?php echo $dprocesos->cod; ?></td>
                                                    <td> 
                                                        <button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return validarDeleteProceso(this.form);"><i class="fa fa-times"></i>
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
                    
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                            <div id="btnSubProcesos" hidden>
                                <button class="btn btn-block btn-warning" onClick="detallarSubProcesos('<?php echo PROJECT_NAME; ?>', '<?php echo $this->session->userdata('usuario'); ?>');">
                                    Detallar sub procesos
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="btnProcesoSelected" hidden> 
                        <div class="col-md-3" id="btnHojaCaract" >
                            <button class="btn btn-block btn-primary" onClick="detallarHojaCaract('<?php echo PROJECT_NAME; ?>', '<?php echo $this->session->userdata('usuario'); ?>');">
                                Hoja de caracterización
                            </button>
                        </div>
                        <div class="col-md-3" id="btnActividades" >
                            <button class="btn btn-block btn-primary" onClick="setFlujoActividades('<?php echo PROJECT_NAME; ?>', '<?php echo $this->session->userdata('usuario'); ?>');">
                                Análisis de actividades
                            </button>
                        </div>
                        <div class="col-md-3" id="btnObjetivos" >
                            <form method="POST" action="<?php echo base_url(); ?>objetivos/regObjetivos">
                                <input type="text" id="txtDescProceso" name="txtDescProceso" hidden class="hidden txtDescProceso" readonly="true">
                                <input type="text" id="txtCodProceso" name="txtCodProceso" hidden class="hidden txtCodProceso" readonly="true">
                                <input type="text" name="txtTipoProceso" hidden class="hidden" readonly="true" value="<?php echo $tipoCod; ?>">
                                <input type="submit" class="btn btn-block btn-primary" value="Mapa estratégico">
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form method="POST" action="<?php echo base_url(); ?>objetivos/regIndicadores">
                                <input type="text" id="txtDescProceso" name="txtDescProceso" hidden class="hidden txtDescProceso" readonly="true">
                                <input type="text" id="txtCodProceso" name="txtCodProceso" hidden class="hidden txtCodProceso" readonly="true">
                                <input type="text" id="txtRespProceso" name="txtRespProceso" hidden class="hidden txtRespProceso" readonly="true">
                                <input type="text" name="txtTipoProceso" hidden class="hidden" readonly="true" value="<?php echo $tipoCod; ?>">
                                <input type="submit" class="btn btn-block btn-primary" value="Gestión de indicadores">
                            </form>
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