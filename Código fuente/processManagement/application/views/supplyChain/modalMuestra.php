            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalTerminarOperativo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                      <!-- TITULO -->
                      <h3 id="cabeceraRegistro"type="hidden" class="modal-title subfuente text-center">Finalizar operativo</h3>


                    </div>

                    <div class="modal-body">




                          <!-- CONTENIDO DE MODAL -->
                      <form action="" class="form-horizontal">
                        
                        <div id="mensaje"></div>
                        
                        <form class="form-horizontal">
                            <div class="table-responsive">
                                <div class="col-md-1 hidden-xs hidden-sm"></div>
                                <div class="col-xs-12 col-md-10">
                                    <div class="row" style="padding-left: 20px; padding-right:20px;">
                                        <div class="col-xs-12 col-sm-3">
                                        <center>
                                            <img src="../<?php echo $URL_IMG?>img/desarrollo_economico/yellow-alert.jpg" height="100" alt="">
                                        </center>
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="text-justify text-info">
                                                <h4>
                                                    <p>¿Está seguro que el operativo ha terminado?</p>
                                                </h4>
                                            </div>
                                            <div class="text-justify text-danger">
                                                <b>
                                                    <p>Esta operación no podrá ser modificada ni revertida posteriormente</p>
                                                </b>
                                            </div>    
                                        </div>
                                    </div>                                       
                                </div>
                            </div>
                            <br>
                        </form>

                        <div class="form-group">
                            <div class="row">
                                <div class="hidden-xs col-sm-1 col-lg-1"></div>
                                <div class="col-xs-12 col-sm-3 col-lg-2">
                                    <form method="POST" action="<?php echo base_url();?>desarrollo_economico/operativos/terminarOperativo">
                                        <input type="text" id="txtCodOperativo" name="txtCodOperativo" hidden>
                                        <input type="text" id="txtCodVehiculo" name="txtCodVehiculo" hidden>
                                        <input type="submit" id="btnTerminarOpe" class="btn btn-default btn-block btn-lg col-md-offset-2" value="SI" />
                                    </form>
                                </div>
                                <div class="hidden-xs col-sm-4 col-lg-6"></div>
                                <div class="col-xs-12 col-sm-3 col-lg-2">
                                    <a class="btn btn-lg btn-success btn-block col-md-offset-3" data-dismiss="modal">NO</a>
                                </div>
                            </div>
                        </div>

                      </form>

                        <!-- FIN CONTENIDO DE MODAL -->




                    </div>

                  </div>
                </div>
            </div>
            <!--END OF MODAL-->