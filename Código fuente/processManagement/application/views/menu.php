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
                <b><a class="navbar-brand" href="<?php echo base_url() ?>csm/recursos">Gestión por procesos</a></b>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown Session-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>csm/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown Session-->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <div class="profile_info">
                                    <p>Bienvenido,</p>
                                    <blockquote style="margin-bottom: 0px;"><p class="text-info">
                                        <?php 
                                            $user=strtolower($this->session->userdata('nombre'));
                                            echo ucwords($user); 
                                        ?>
                                    </p></blockquote>
                                </div>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-truck"></i> Recursos y Proveedores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>csm/recursos">Registrar</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>csm/nivelesR">Organización por niveles</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Clientes y distribuidores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>csm/clientes">Registrar</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>csm/nivelesC">Organización por niveles</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>csm/chainSupply"><i class="fa fa-sitemap"></i> Chain Supply</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Registro de procesos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/regPrimarios">Procesos primarios</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/regEstrategico">Procesos estratégicos</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/regApoyo">Procesos de apoyo</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Relación entre procesos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/relacionPrimarios">Procesos primarios</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/relacionEstrategicos">Procesos estratégicos</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>procesos/relacionApoyo">Procesos de apoyo</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>procesos/mapaProcesos"><i class="fa fa-sitemap"></i> Mapa de procesos</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
