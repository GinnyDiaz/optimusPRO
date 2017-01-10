            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalMacroProceso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h3 id="cabeceraModalSubProcesos"type="hidden" class="modal-title subfuente text-center">MACROPROCESO:<b id="macroName"></b></h3>
                        </div>

                        <div class="modal-body">
                              <!-- CONTENIDO DE MODAL -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info">Lista de procesos disponibles</p>
                                    </small></h2>
                                    <br>
                                     <div class="table-responsive">
                                        <table class="table table-hover" id="tblDisponibles">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Procesos disponibles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(isset($recursos)){
                                                    $cont = 1;
                                                    foreach($recursos->result() as $drecursos){ ?>
                                                        <tr class="even pointer" onclick="seleccionFila('tblOrigen',this, '<?php echo PROJECT_NAME; ?>; ?>', 'P');">
                                                            <td class="a-center"> <?php echo $cont;?> </td>
                                                            <td> <?php echo $drecursos->nombre ?> </td>
                                                            <td class="hidden"><?php echo $drecursos->cod; ?></td>
                                                        </tr>
                                                    <?php
                                                        $cont = $cont +1;
                                                    }
                                                }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2><small>
                                        <p class="text-info" id="macroNombreTittle"></p>
                                    </small></h2>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="tblSubProcesos">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sub procesos</th>
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
                                    <button class="btn btn-block btn-primary" onClick="setSubProcesos('<?php echo PROJECT_NAME; ?>');">GUARDAR</button>
                                </div>
                            </div>

                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->