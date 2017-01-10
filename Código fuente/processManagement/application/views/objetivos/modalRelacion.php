            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalRelacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h4 id="cabeceraModalRelacion"type="hidden" class="modal-title subfuente text-center"><b>OBJETIVO:</b><i id="descripcionObj"></i></h4>
                        </div>

                        <div class="modal-body">
                              <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info">¿En qué objetivo influye?</p>
                                    </small></h2>
                                    <br>
                                     <div class="table-responsive">
                                        <table class="table table-hover" id="tblDisponibles">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Objetivos disponibles</th>
                                                    <th>Perspectiva</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info">Objetivos seleccionados</p>
                                    </small></h2>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="tblObjRelacionados">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Objetivos seleccionados</th>
                                                    <th>Perspectiva</th>
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
                                    <button class="btn btn-block btn-primary" onClick="setRelacionObjetivos('<?php echo PROJECT_NAME; ?>');">GUARDAR</button>
                                </div>
                            </div>

                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->