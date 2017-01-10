            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalResumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h3 id="" type="hidden" class="modal-title subfuente text-center">PROCESO:  <b id="processName"></b></h3>
                        </div>

                        <div class="modal-body">
                              <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info text-center">Resumen Actividad/Tiempo</p>
                                    </small></h2>
                                    <br>
                                     <div class="table-responsive">
                                        <table class="table table-hover" id="tblActividadTiempo">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tipo actividad</th>
                                                    <th>Tiempo</th>
                                                    <th>Porcentaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info text-center">Resumen Rol/Tiempo</p>
                                    </small></h2>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="tblRolTiempo">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Rol</th>
                                                    <th>Tiempo</th>
                                                    <th>Porcentaje</th>
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
                                    <button class="btn btn-block btn-primary" data-dismiss="modal">VOLVER</button>
                                </div>
                            </div>

                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->