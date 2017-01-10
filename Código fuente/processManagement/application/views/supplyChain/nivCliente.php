Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Niveles en el flujo de clientes y distribuidores </h1>
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
                            Relación origen-destino de los clientes y distribuidores de la empresa
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="POST" id="frmRelacionClientes" class="form-horizontal" action="<?php echo base_url(); ?>csm/setRelacionClientes">
                                    <div class="col-md-11">
                                        <div class="col-md-6">
                                            <div class="form-group" id="formOrigen">
                                                <div class="col-md-2">
                                                    <label for="txtOrigen">Origen:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="txtOrigen" id="txtOrigen" placeholder="Seleccione de la tabla." readonly="true">
                                                    <input name="txtCodOrigen" id="txtCodOrigen" readonly="true" hidden>
                                                </div>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="formDestino">
                                                <div class="col-md-2">
                                                    <label for="txtDestino">Destino:</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="txtDestino" id="txtDestino" placeholder="Seleccione de la tabla." readonly="true">
                                                    <input name="txtCodDestino" id="txtCodDestino" readonly="true" hidden>
                                                </div>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
                                        </div>
                                    </div>               
                                    <div class="col-md-1">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-info btn-circle btn-lg" onclick="return validarRelation('frmRelacionClientes');"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.row (nested) -->

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cliente/distribuidor de origen</th>
                                                <th>Cliente/distribuidor de destino</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = 1;
                                            if(isset($relations)){
                                                if($relations){
                                                    foreach($relations->result() as $relations){ ?>
                                                        <tr class="even pointer">
                                                            <form role="form" method="POST" action="<?php echo base_url(); ?>csm/delRelationClientes">
                                                                <td class="a-center"> <?php echo $cont;?> </td>
                                                                <td> <?php echo $relations->destino ?> </td>
                                                                <td> <?php echo $relations->origen ?> </td>
                                                                <td class="hidden"> <input type="text" name="txtCodRelation" value="<?php echo $relations->cod ?>" hidden readonly></td>
                                                                <td>
                                                                    <button type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-times"></i>
                                                                    </button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                    <?php
                                                        $cont = $cont +1;
                                                    }
                                                }
                                            }
                                            if($cont==1){
                                                echo '<tr><td colspan="3" class="text-center">No se ha establecido la relación entre los clientes y distribuidores </td></tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h2><small>
                                <p class="text-info">Clientes y distribuidores de origen</p>
                            </small></h2>
                             <div class="table-responsive">
                                <table class="table table-hover" id="tblOrigen">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cliente o distribuidor</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($clientes)){
                                            $cont = 1;
                                            foreach($clientes->result() as $dclientes){ ?>
                                                <tr class="even pointer" onclick="seleccionFilaCsm('tblOrigen',this, '<?php echo base_url(); ?>', 'C');">
                                                    <td class="a-center"> <?php echo $cont;?> </td>
                                                    <td> <?php echo $dclientes->nombre ?> </td>
                                                    <td> <?php echo $dclientes->descripcion ?> </td>
                                                    <td class="hidden"><?php echo $dclientes->cod; ?></td>
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
                                <p class="text-info">Clientes y distribuidores de destino</p>
                            </small></h2>
                            <div class="table-responsive" id="tblDestino">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cliente o distribuidor</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center">Seleccione un proveedor de origen</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
   <!-- /#wrapper

