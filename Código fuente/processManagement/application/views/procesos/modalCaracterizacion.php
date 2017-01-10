            

            <!--START OF MODAL-->
            <div class="modal fade" id="modalCaracterizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                          <!-- TITULO -->
                          <h3 id="cabeceraModalSubProcesos"type="hidden" class="modal-title subfuente text-center">Hoja de Caracterización de Proceso</h3>
                        </div>

                        <div class="modal-body">
                            <!-- CONTENIDO DE MODAL -->

                            <div class="table-responsive">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <!-- Proceso y responsable  -->
                                        <thead>
                                            <tr class="active">
                                                <td style="vertical-align: middle;" colspan="3" width="50%">
                                                    <b>PROCESO: </b><label id="proceso"></label>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <b>RESPONSABLE: </b><label id="responsable"></label>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Mision  -->
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                   Mision 
                                                </td>
                                                <td style="vertical-align: middle;" colspan="3">
                                                    <textarea name="txtMision" style="resize: none;" id="txtMision" rows="3" class="form-control sinborde"><?php 
                                                        if(isset($mision)){
                                                            if(strlen($mision)>0){
                                                                echo $mision;
                                                            }
                                                        }
                                                     ?></textarea>
                                                </td>
                                            </tr>
                                            <!-- Alcance -->
                                            <tr>
                                                <td style="vertical-align: middle;" rowspan="3" width="15%">
                                                    ALCANCE
                                                </td>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Empieza
                                                </td>
                                                <td style="vertical-align: middle;" colspan="2">
                                                    <input type="text" class="form-control sinborde" id="txtEmpieza" name="txtEmpieza">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Incluye
                                                </td>
                                                <td style="vertical-align: middle;" colspan="2">
                                                    <input type="text" class="form-control sinborde" id="txtIncluye" name="txtIncluye">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Termina
                                                </td>
                                                <td style="vertical-align: middle;" colspan="2">
                                                    <input type="text" class="form-control sinborde" id="txtTermina" name="txtTermina">
                                                </td>
                                            </tr>
                                            <!-- Entradas -->
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Entradas
                                                </td>
                                                <td style="vertical-align: middle;" colspan="3">
                                                    <input type="text" class="form-control sinborde" id="txtEntrada" name="txtEntrada">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Proveedores
                                                </td>
                                                <td style="vertical-align: middle;" colspan="3">
                                                    <input type="text" class="form-control sinborde" id="txtProveedor" name="txtProveedor">
                                                </td>
                                            </tr>
                                            <!-- Salidas -->
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Salidas
                                                </td>
                                                <td style="vertical-align: middle;" colspan="3">
                                                    <input type="text" class="form-control sinborde" id="txtSalida" name="txtSalida">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" width="15%">
                                                    Clientes
                                                </td>
                                                <td style="vertical-align: middle;" colspan="3">
                                                    <input type="text" class="form-control sinborde" id="txtCliente" name="txtCliente">
                                                </td>
                                            </tr>
                                            <!-- Inspecciones y registras -->
                                            <tr>
                                               <td style="vertical-align: middle;" colspan="3" width="50%">
                                                   INSPECCIONES
                                               </td> 
                                               <td style="vertical-align: middle;">
                                                   REGISTROS
                                               </td> 
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" colspan="3" width="50%">
                                                   <textarea name="txtInspecciones" style="resize: none;" id="txtInspecciones" rows="3" class="form-control sinborde"><?php 
                                                        if(isset($inspecciones)){
                                                            if(strlen($inspecciones)>0){
                                                                echo $inspecciones;
                                                            }
                                                        }
                                                     ?></textarea>
                                               </td>
                                               <td style="vertical-align: middle;">
                                                   <textarea name="txtRegistros" style="resize: none;" id="txtRegistros" rows="3" class="form-control sinborde"><?php 
                                                        if(isset($registros)){
                                                            if(strlen($registros)>0){
                                                                echo $registros;
                                                            }
                                                        }
                                                     ?></textarea>
                                               </td>
                                            </tr>
                                            <!-- Variable e indicadores -->
                                            <tr>
                                               <td style="vertical-align: middle;" colspan="3" width="50%">
                                                   VARIABLES DE CONTROL
                                               </td> 
                                               <td style="vertical-align: middle;">
                                                   INDICADORES
                                               </td> 
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle;" colspan="3" width="50%">
                                                   <textarea name="txtVariables" style="resize: none;" id="txtVariables" rows="3" class="form-control sinborde"><?php 
                                                        if(isset($variables)){
                                                            if(strlen($variables)>0){
                                                                echo $variables;
                                                            }
                                                        }
                                                     ?></textarea>
                                               </td>
                                               <td style="vertical-align: middle;">
                                                   <textarea name="txtIndicadores" style="resize: none;" id="txtIndicadores" rows="3" class="form-control sinborde"><?php 
                                                        if(isset($indicadores)){
                                                            if(strlen($indicadores)>0){
                                                                echo $indicadores;
                                                            }
                                                        }
                                                     ?></textarea>
                                               </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 col-md-offset-8">
                                    <input type="text" id="txtCodProcesoModal" hidden readonly="true">
                                    <button class="btn btn-block btn-primary" onClick="setCaracteristicas('<?php echo base_url(); ?>');">GUARDAR</button>   <!-- id="btnSaveCaracterizacion" -->
                                </div>
                            </div>

                            <!-- FIN CONTENIDO DE MODAL -->
                        </div>

                    </div>
                </div>
            </div>
            <!--END OF MODAL-->