<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Relación entre <?php if(isset($titulo)){
                            echo $titulo;}
                             ?> </h3>
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
                            Relación origen-destino de los <?php if(isset($titulo)){ echo $titulo;} ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="POST" id="frmRelacionProcesos" class="form-horizontal" action="<?php echo base_url(); ?>procesos/setRelacionProcesos">
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
                                            <button type="button" class="btn btn-info btn-circle btn-lg" onclick="return validarRelProcesos('frmRelacionProcesos');"><i class="fa fa-plus"></i>
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
                                                <th>Proceso de origen</th>
                                                <th>Proceso de destino</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $sql= "call SP_PROCESOS @tipo=10, @usuario='".$usuario."', @PROCtipo='".$tipoCod."'";
                                            $relations = $this->modProcesos->getRelaciones($usuario, $tipoCod);
                                            $cont = 1;
                                            if(isset($relations)){
                                                if($relations){
                                                    foreach($relations->result() as $relations){ ?>
                                                        <tr class="even pointer">
                                                            <form role="form" method="POST" action="<?php echo base_url(); ?>procesos/delRelation">
                                                                <td class="a-center"> <?php echo $cont;?> </td>
                                                                <td> <?php echo $relations->origen ?> </td>
                                                                <td> <?php echo $relations->destino ?> </td>
                                                                <td class="hidden"> <input type="text" name="txtCodRelation" value="<?php echo $relations->cod; ?>" hidden readonly></td>
                                                                <td class="hidden"> <input type="text" name="txtCodOrigen" value="<?php echo $relations->origenCod; ?>" hidden readonly></td>
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
                                                echo '<tr><td colspan="3" class="text-center">No se ha establecido aun ninguna relación entre procesos </td></tr>';
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
                                <p class="text-info"><?php echo $titulo; ?></p>
                            </small></h2>
                             <div class="table-responsive">
                                <table class="table table-hover" id="tblOrigen">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Proceso de origen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $sql= "SP_PROCESOS @tipo=1, @PROCtipo='".$tipoCod."', @usuario='".$usuario."'";
                                        $this->db->reconnect();
                                        $procesos = $this->modProcesos->getProcesos($usuario, $tipoCod);
                                        if(isset($procesos)){
                                            $cont = 1;
                                            foreach($procesos->result() as $dprocesos){ ?>
                                                <tr class="even pointer" onclick="seleccionFilaProcRel('tblOrigen',this, '<?php echo base_url(); ?>', '<?php echo $tipoCod; ?>');">
                                                    <td class="a-center"> <?php echo $cont;?> </td>
                                                    <td> <?php echo $dprocesos->nombre ?> </td>
                                                    <td class="hidden"><?php echo $dprocesos->cod; ?></td>
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
                                <p class="text-info">Procesos disponibles</p>
                            </small></h2>
                            <div class="table-responsive" id="tblDestino">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Proceso de destino</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center">Seleccione un proceso de origen</td>
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

