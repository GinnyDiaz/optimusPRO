            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalFlujoActividades" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h3 id="cabeceraModalFlujoActividades"type="hidden" class="modal-title subfuente text-center">FLUJOS DE ACTIVIDADES:<b id="processName"></b></h3>
                        </div>

                        <div class="modal-body">
                            <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1" id="formDescripcion">
                                    <div class="col-md-12">
                                        <label for="txtFlujo" class="control-label">Descripción del flujo de actividades: </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" id="txtFlujo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <label for="txtUnidadTiempo" class="control-label">Análisis de tiempo en: </label>
                                    </div>
                                    <div class="col-md-12 ">
                                        <select name="cboUnidadTiempo" id="cboUnidadTiempo" class="form-control">
                                            <option value="minutos">Minutos</option>
                                            <option value="segundos">Segundos</option>
                                            <option value="horas">Horas</option>
                                            <option value="dias">Dias</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button class="btn btn-block btn-warning" onclick="addFlujoActividades()">Agregar</button>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="tblActividades">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Descripción</th>
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
                                <form role="form" method="POST" id="frmAnalisisActividades" class="form-horizontal" action="<?php echo base_url(); ?>actividades/seguimiento">
                                    <input type="text" hidden class="txtDescripcion" name="txtDescripcion">
                                    <input type="text" hidden id="txtCodFlujo" name="txtCodFlujo">
                                    <input type="text" hidden id="txtUnidadTiempo" name="txtUnidadTiempo">
                                    <input type="text" hidden class="txtCodProceso" name="txtCodProceso">
                                    <div class="col-md-4 col-md-offset-7" id="btnAnalisisActividades" hidden>
                                        <button class="btn btn-block btn-primary" onClick="submitAnalisisActividades(this.form);" >Realizar seguimiento de actividades</button>
                                    </div>
                                </form>
                            </div>

                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->