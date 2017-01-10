<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">Universidad Nacional de Trujillo</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
            </ul>
            <!-- /.navbar-top-links -->
        </nav>


        <div >
            <div class="container">
                
            
                <br>
                <br>
                <!-- /.container-fluid -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="text-primary"><small>¿Aun no tienes tu cuenta?</small>
                                    Regístrate!</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="<?php echo base_url(); ?>csm/registrar" role="form" id="frmRegistrar" method="POST">
                                        <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-10"  id="formNombresR">
                                                <label class="control-label" for="txtNombres">Nombres:</label>
                                                <input type="text" class="form-control" minlength="3" name="txtNombres" id="txtNombres" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-10"  id="formApellidosR">
                                                <label class="control-label" for="txtApellidos">Apellidos:</label>
                                                <input type="text" class="form-control" minlength="3" name="txtApellidos" id="txtApellidos" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-10"  id="formEmpresaR">
                                                <label class="control-label" for="txtEmpresa">Empresa a la que pertenece:</label>
                                                <input type="text" class="form-control" minlength="3" name="txtEmpresa" id="txtEmpresa" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-10"  id="formUserR">
                                                <label class="control-label" for="txtUser">Nombre de Usuario:</label>
                                                <input type="text" class="form-control" minlength="4" maxlength="10" name="txtUser" id="txtUser" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-10"  id="formPasswR">
                                                <label class="control-label" for="txtPassw">Contraseña:</label>
                                                <input type="password" class="form-control" minlength="4" maxlength="15" name="txtPassw" id="txtPassw" required>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <button type="button" class="btn btn-default btn-circle btn-xl" onclick="return validarRegistro('frmRegistrar');">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3>Log in</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="<?php echo base_url(); ?>csm/autenticar" role="form" id="frmLogin" class="form-horizontal" method="POST">
                                        <div class="row">
                                            <div class="form-group" id="formUserL">
                                                <label class="control-label col-md-4" for="txtUserL">Usuario:</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="txtUser" id="txtUserL" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group" id="formPasswL">
                                                <label class="control-label col-md-4" for="txtPasswL">Contraseña:</label>
                                                <div class="col-md-7">
                                                    <input type="password" class="form-control" name="txtPassw" id="txtPasswL" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <button type="button" class="btn btn-info btn-circle btn-xl" onclick="return validarLogin('frmLogin');">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper