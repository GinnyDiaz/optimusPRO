<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Indicadores del proceso: <?php if(isset($descProceso)){
                            if($descProceso){
                                echo $descProceso;
                            }
                        } ?></h3>
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
                            Registro de indicadores
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="POST" id="formAddActividad" class="form-horizontal" action="#">
                                    <input type="text" name="txtCodProceso" id="txtCodProceso" value="<?php if(isset($codProceso)){
                                        if($codProceso){
                                            echo $codProceso;
                                        }
                                    } ?>" hidden class="hidden">
                                    <div class="form-group" id="formTitulo">
                                        <div class="col-md-1 col-md-offset-1">
                                            <label for="txtIndicador" class="control-label">Título:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control" name="txtIndicador" id="txtIndicador">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="formFormula">
                                            <div class="col-md-1 col-md-offset-1">
                                                <label for="txtFormula" class="control-label">Fórmula:</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input class="form-control" name="txtFormula" id="txtFormula">
                                            </div>
                                        </div>
                                        <div id="formUnidadMed">
                                            <div class="col-md-2">
                                                <label for="txtUnidadMed" class="control-label">Und. medida:</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control" name="txtUnidadMed" id="txtUnidadMed">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="">
                                        <div id="formMeta">
                                            <div class="col-md-1 col-md-offset-1">
                                                <label for="txtMeta" class="control-label">Meta:</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control" name="txtMeta" id="txtMeta">
                                            </div>
                                        </div>
                                        <div id="formFrecMedicion">
                                            <div class="col-md-2">
                                                <label for="cboFrecuencia" class="control-label">Frec. medición:</label>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="cboFrecuencia" id="cboFrecuencia" class="form-control">
                                                    <option value="Diaria">Diaria</option>
                                                    <option value="Mensual">Mensual</option>
                                                    <option value="Anual">Anual</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-md-offset-2 text-rigth">
                                            <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="return addIndicador('<?php echo PROJECT_NAME; ?>');"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
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
                        <table class="table table-hover" id="tblIndicadores">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; text-align: center;">Código</th>
                                    <th style="vertical-align: middle; text-align: center;">Indicador</th>
                                    <th style="vertical-align: middle; text-align: center;">unidad de <br> medida</th>
                                    <th style="vertical-align: middle; text-align: center;">Fórmula</th>
                                    <th style="vertical-align: middle; text-align: center;">Frecuencia</th>
                                    <th style="vertical-align: middle; text-align: center;">Meta</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($indicadores)){
                                    // $cont = 1;
                                    foreach($indicadores->result() as $dindicadores){ ?>
                                        <?php $codIndicador = $dindicadores->codIndicador; ?>
                                            <tr class="even pointer" onclick="seleccionIndicador('tblindicadores', '<?php //echo PROJECT_NAME; ?>', this);">
                                                <!-- <td class="a-center"> <?php // echo $cont;?> </td> -->
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->identificador; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->nombre; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->unidadMed; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->formula; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->frecMedicion; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->meta; ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $dindicadores->codProceso; ?> </td>
                                                <td class="hidden"><?php echo $codIndicador; ?></td>
                                                <td style="vertical-align: middle;"> 
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return deleteIndicador('<?php echo PROJECT_NAME; ?>', '<?php echo $codIndicador; ?>', '<?php echo $codProceso; ?>');"><i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            // $cont = $cont +1;
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
                             if(isset($descProceso)){
                                if($tipoProceso=='P'){
                                    $destino='Primarios';
                                }
                                if($tipoProceso=='A'){
                                    $destino='Apoyo';
                                }
                                if($tipoProceso=='E'){
                                    $destino='Estrategico';
                                }
                             }
                             ?>
                            <form method="POST" action="<?php echo base_url(); ?>procesos/reg<?php if(isset($destino)){echo $destino; }?>">
                                <button type="submit" class="btn btn-circle btn-lg btn-default"><i class="fa fa-arrow-left"></i></button>
                            </form>
                        </div>
                            <input type="text" id="txtCodProcSelected" hidden class="hidden" readonly="true">
                            <input type="text" id="txtCodIndSelected" hidden class="hidden" readonly="true">
                            <input type="text" id="txtFrecMedSelected" hidden class="hidden" readonly="true">
                            <div id="btnFilaIndicadores" hidden>
                                <div class="col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-3">
                                    <button class="btn btn-block btn-lg btn-warning" onClick="verHistorial('<?php echo PROJECT_NAME; ?>');">
                                        Reporte histórico
                                    </button>
                                </div>
                                <div class="col-md-5 col-lg-4">
                                    <button class="btn btn-block btn-lg btn-warning" onClick="verBSC('<?php echo PROJECT_NAME; ?>');">
                                        Tablero de comandos
                                    </button>
                                </div>
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