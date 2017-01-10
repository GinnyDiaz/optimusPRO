            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalBSC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-left: 30px; margin-right: 30px; width: auto;">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h4 id="cabeceraModalRelacion"type="hidden" class="modal-title subfuente text-center"><b>INDICADOR:</b><i id="tituloIndicador2"></i></h4>
                        </div>

                        <div class="modal-body">
                              <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <br>
                                <form class="form-horizontal">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <b>NOMBRE DEL PROCESO: </b>
                                            </div>
                                            <div class="col-md-9">
                                                <?php echo $descProceso; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <b>Responsable del Proceso: </b>
                                            </div>
                                            <div class="col-md-9">
                                                <?php echo $respProceso; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                               <b><label for="cboObjetivos" class="control-label">Objetivo de indicador: </label></b> 
                                            </div>
                                            <div class="col-md-9">
                                                <select id="cboObjetivos" class="form-control">
                                                    <?php 
                                                        $this->db->reconnect();
                                                        $objetivos = $this->modObjetivos->getObjetivos($usuario, $codProceso);
                                                        foreach($objetivos->result() as $dobjetivos){ ?>
                                                            <option value="<?php echo $dobjetivos->descripcion; ?>"><?php echo $dobjetivos->descripcion; ?></option>
                                                            <?php
                                                        }
                                                     ?>
                                                 </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <table class="table table-hover table-bordered" id="tblCuadroIndicador">
                                            <thead>
                                                <tr>
                                                    <th width="17%">INDICADOR</th>
                                                    <th width="20%">FÓRMULA</th>
                                                    <th width="7%">LÍNEA BASE</th>
                                                    <th width="8%">VALOR META</th>
                                                    <th width="13%">FRECUENCIA DE MEDICIÓN</th>
                                                    <th width="35%" class="text-center">SEMÁFORO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="17%">
                                                        <textarea style="resize: none;" id="txtIndicadorBSC" rows="3" class="form-control sinborde"></textarea>
                                                    </td>
                                                    <td width="20%">
                                                        <input type="text" class="form-control sinborde" id="txtFormulaBSC">
                                                    </td>
                                                    <td width="7%">
                                                        <input type="text" class="form-control sinborde" id="txtLineaBaseBSC">
                                                    </td>
                                                    <td width="8%">
                                                        <input type="number" step="0.01" class="form-control sinborde" id="txtMetaBSC">
                                                    </td>
                                                    <td width="13%">
                                                        <div id="frecuenciaMed"></div>
                                                    </td>
                                                    <td width="35%">
                                                        <form class="form-horizontal">
                                                            <div class="row">
                                                                <div class="col-md-2 text-right">
                                                                    <img src="<?php echo PROJECT_NAME; ?>img/red.png" width="15">
                                                                    <b> < </b>
                                                                </div>
                                                                <div class="col-md-3 text-center">
                                                                    <input type="number" step="0.01" class="form-control sinborde" id="txtCondMenor">
                                                                </div>
                                                                <div class="col-md-2 text-center">
                                                                    <b> <= </b>
                                                                    <img src="<?php echo PROJECT_NAME; ?>img/yellow.png" width="15">
                                                                    <b> < </b>
                                                                </div>
                                                                <div class="col-md-3 text-center">
                                                                    <input type="number" step="0.01" class="form-control sinborde" id="txtCondMayor">
                                                                </div>
                                                                <div class="col-md-2 text-left">
                                                                    <b> <= </b>
                                                                    <img src="<?php echo PROJECT_NAME; ?>img/green.png" width="15">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    &nbsp &nbsp &nbsp<h3>Cuadro de Mando:</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="">
                                        <table class="table" style="border: none !important;" id="tblCuadroIndicador">
                                            <tr>
                                                <td style="border-top: none;" width="">
                                                    <label for="txtObjetivoBSC">Objetivo:</label>
                                                    <textarea style="resize: none;" id="txtObjetivoBSC" rows="3" class="form-control" readonly="true" disabled></textarea>
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaRight.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <label for="txtNombreIndicadorBSC">Indicador:</label>
                                                    <textarea style="resize: none;" id="txtNombreIndicadorBSC" rows="3" class="form-control"  readonly="true" disabled></textarea>
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaRight.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <label for="metaBSC">Valor meta:</label>
                                                    <input type="number" step="0.01" class="form-control" id="metaBSC" readonly="true" disabled> 
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaRight.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <label>Semáforo:</label>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="<?php echo PROJECT_NAME; ?>img/red.png" width="10">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div id="condGreen"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="<?php echo PROJECT_NAME; ?>img/yellow.png" width="10">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div id="condYellow"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="<?php echo PROJECT_NAME; ?>img/green.png" width="10">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div id="condRed"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width="" class="text-center">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaUp.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width="" class="text-center">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaUp.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width=""></td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width=""></td>
                                                <td style="border-top: none;" width="" colspan="3">
                                                    <label for="txtIniciativasBSC">Iniciativas:</label>
                                                    <textarea style="resize: none;" id="txtIniciativasBSC" rows="3" class="form-control"></textarea>
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <img src="<?php echo PROJECT_NAME; ?>img/flechaRight.png" width="20">
                                                </td>
                                                <td style="border-top: none;" width="">
                                                    <label for="txtResponsableBSC">Responsable de indicador:</label>
                                                    <input type="text" class="form-control" id="txtResponsableBSC">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-8">
                                    <button class="btn btn-lg btn-block btn-primary" onclick="updIndicador('<?php echo PROJECT_NAME; ?>');"">GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->

