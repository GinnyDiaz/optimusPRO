            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalHistorial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="actualizar();">X</button>
                          <!-- TITULO -->
                          <h4 id="cabeceraModalRelacion"type="hidden" class="modal-title subfuente text-center"><b>INDICADOR:</b><i id="tituloIndicador"></i></h4>
                        </div>

                        <div class="modal-body">
                              <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <form role="form" method="POST" id="formAddActividad" class="form-horizontal" action="#">
                                    <div class="form-group" style="vertical-align: middle;">
                                        <div id="formPeriodo" style="padding-top: 20px;">
                                            <div class="col-md-2 col-md-offset-1" style="vertical-align: middle;">
                                                <label for="calendarMonth" class="control-label" style="vertical-align: middle;">Periodo:</label>
                                            </div>
                                            <input type="text" hidden class="hidden" readonly="true" id="txtPeriodo">
                                            <div class="col-md-3" id="frecuenciaDia" style="vertical-align: middle;" hidden>
                                                <div class="form-group input-group">
                                                    <input type="text" class="form-control" id="single_cal2" placeholder="Fecha Inicio" aria-describedby="inputSuccess2Status2" onChange="setPeriodo(this);"> 
                                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="frecuenciaMes" style="vertical-align: middle;" hidden>
                                                <div class="form-group input-group">
                                                    <input type="text" class="form-control" id="calendarMonth" placeholder="Fecha Inicio" aria-describedby="inputSuccess2Status2" onChange="setPeriodo(this);">
                                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="frecuenciaAnio" style="vertical-align: middle;" hidden>
                                                <div class="form-group input-group">
                                                    <select onChange="setPeriodo(this);" class="form-control">
                                                        <?php 
                                                        for ($i = date(Y); $i>=1990 ; $i--) {
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                         ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="formValor">
                                            <div class="col-md-1" style="vertical-align: middle;">
                                                    <label for="txtValor" class="control-label" style="vertical-align: middle;">Valor:</label>
                                            </div>
                                            <div class="col-md-2" style="vertical-align: middle;">
                                                <input type="number" step="0.01" class="form-control" name="txtValor" id="txtValor" >
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="return addHistorial('<?php echo PROJECT_NAME; ?>');"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h4>
                                        <p class="text-info">Datos históricos</p>
                                    </h4>
                                    <br>
                                     <div class="table-responsive">
                                        <table class="table table-hover" id="tblHistorial">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Periodo</th>
                                                    <th>Valor</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-8">
                                    <button class="btn btn-block btn-default" data-dismiss="modal" onclick="actualizar();">VOLVER</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->

