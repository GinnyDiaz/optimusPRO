Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Registro de recursos y proveedores</h1>
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
                            Agregar un nuevo recurso o proveedor
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="POST" id="regRecurso" class="form-horizontal" action="<?php echo base_url(); ?>csm/setRecursos">
                                        <div class="col-md-12">
                                            <div class="form-group" id="formNombre">
                                                <div class="col-md-3">
                                                    <label for="txtRecurso">Nombre de recurso o proveedor:</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="txtRecurso" id="txtRecurso" placeholder="Medicamentos, Supermercados Tottus, CocaCola, etc.">
                                                </div>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group" id="formDescripcion">
                                                <div class="col-md-2">
                                                    <label for="txtDescripcion">Descripción:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="txtDescripcion" id="txtDescripcion">
                                                </div>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="formNivel">
                                                <div class="col-md-2">
                                                    <label for="cboNivel">Nivel:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="cboNivel" id="cboNivel">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-info btn-circle btn-lg" onclick="return validarRecurso(this.form);" ><i class="fa fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-circle btn-lg" onclick="return limpiarRecurso();"><i class="fa fa-eraser"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                            
                        </div>
                        
                    </div>
                    

                    <!-- table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Recurso o proveedor</th>
                                    <th>Descripción</th>
                                    <th>Nivel</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($recursos){
                                    $cont = 1;
                                    foreach($recursos->result() as $drecursos){ ?>
                                        <tr class="even pointer">
                                            <form role="form" method="POST" class="form-horizontal" action="<?php echo base_url(); ?>csm/deleteRecursos">
                                                <td class="a-center"> <?php echo $cont;?> </td>
                                                <td> <?php echo $drecursos->nombre ?> </td>
                                                <td> <?php echo $drecursos->descripcion ?> </td>
                                                <td> <?php echo $drecursos->nivel ?> </td>
                                                <td class="hidden"><input name="txtCod" type="text" value="<?php echo $drecursos->cod; ?>" hidden readonly></td>
                                                <td> 
                                                    <button type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php 
                                        $cont = $cont +1;
                                    }
                                }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper