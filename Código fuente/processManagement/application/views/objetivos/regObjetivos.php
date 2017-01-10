<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Objetivos estratégicos</h3>
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
                            Registro de objetivos estratégicos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="POST" id="formAddActividad" class="form-horizontal" action="#">
                                    <div class="col-md-6 col-md-offset-1">
                                        <div class="form-group" id="formObjetivo">
                                            <div class="col-md-12">
                                                <label for="txtObjetivo" class="control-label">  Objetivo:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input class="form-control" name="txtObjetivo" id="txtObjetivo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="">
                                            <!-- <div class="col-md-3"> -->
                                                <label for="cboPerspectiva" class="control-label">  Perspectivas del BSC:</label>
                                            <!-- </div>
                                            <div class="col-md-5"> -->
                                                <select name="cboPerspectiva" id="cboPerspectiva" class="form-control">
                                                    <option value="1">Financiera</option>
                                                    <option value="2">Cliente</option>
                                                    <option value="3">Procesos internos</option>
                                                    <option value="4">Aprendizaje</option>
                                                </select>
                                                <input type="text" name="txtCodProceso" id="txtCodProceso" value="<?php if(isset($codProceso)){
                                                    if($codProceso){
                                                        echo $codProceso;
                                                    }
                                                } ?>" hidden class="hidden">
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-11 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="return addObjetivo('<?php echo PROJECT_NAME; ?>');"><i class="fa fa-plus"></i>
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
                        <table class="table table-hover" id="tblObjetivos">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="vertical-align: middle; text-align: center;">Objetivo estratégico</th>
                                    <th style="vertical-align: middle; text-align: center;">Perspectiva</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($objetivos){
                                    $cont = 1;
                                    foreach($objetivos->result() as $dobjetivos){ ?>
                                        <?php $codObjetivo = $dobjetivos->codObjetivo; ?>
                                            <tr class="even pointer" onclick="seleccionObjetivo('tblObjetivos', '<?php //echo PROJECT_NAME; ?>', this);">
                                                <td class="a-center"> <?php echo $cont;?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dobjetivos->descripcion; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dobjetivos->perspectiva; ?> </td>
                                                <td class="hidden"><?php echo $dobjetivos->codProceso; ?></td>
                                                <td class="hidden"><?php echo $codObjetivo; ?></td>
                                                <td style="vertical-align: middle;"> 
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return deleteObjetivo('<?php echo PROJECT_NAME; ?>', '<?php echo $codObjetivo; ?>', '<?php echo $codProceso; ?>');"><i class="fa fa-times"></i>
                                                    </button>
                                                </td>
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
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-lg-1">
                            <?php 
                            if($tipoProceso=='P'){
                                $destino='Primarios';
                            }
                            if($tipoProceso=='A'){
                                $destino='Apoyo';
                            }
                            if($tipoProceso=='E'){
                                $destino='Estrategico';
                            }
                             ?>
                            <form method="POST" action="<?php echo base_url(); ?>procesos/reg<?php echo $destino;?>">
                                <button type="submit" class="btn btn-circle btn-lg btn-default"><i class="fa fa-arrow-left"></i></button>
                            </form>
                        </div>
                            <input type="text" id="txtCodProcSelected" hidden class="hidden" readonly="true">
                            <input type="text" id="txtCodObjSelected" hidden class="hidden" readonly="true">
                            <div class="col-md-5 col-lg-4 col-md-offset-1 col-lg-offset-4">
                                <div id="btnFilaObjetivos" hidden>
                                    <button class="btn btn-block btn-lg btn-warning" onClick="verRelacionObj('<?php echo PROJECT_NAME; ?>');">
                                        Objetivos en los que influye
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3" id="btnMapaEstrategico">
                                <form method="POST" action="<?php echo base_url(); ?>objetivos/verMapaEstrategico">
                                    <input type="text" name="txtDescProceso" hidden class="hidden txtDescProceso" readonly="true" value="<?php echo $descProceso; ?>">
                                    <input type="text" name="txtCodProceso" hidden class="hidden txtCodProceso" readonly="true" value="<?php echo $codProceso; ?>">
                                    <input type="text" name="txtTipoProceso" hidden class="hidden" readonly="true" value="<?php echo $tipoProceso; ?>">
                                    <input type="submit" class="btn btn-block btn-primary btn-lg" value="Mapa estratégico">
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