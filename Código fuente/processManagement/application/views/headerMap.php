<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">

    <title>
        <?php
        if(isset($titulo)){
            echo $titulo;                       //SI SE ENVIA UNA VARIABLE $DATA['TITULO'], EL TITULO PUEDE VARIAR EN CADA PANTALLA :) 
        }else{
            echo 'Chain Supply Managment';
        }
        ?>
    </title>

     <!-- Bootstrap Core CSS -->
    <link href="<?php echo PROJECT_NAME; ?>components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo PROJECT_NAME; ?>components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo PROJECT_NAME; ?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo PROJECT_NAME; ?>components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!--START SCRIPT-->
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/procesos.js"></script>
    <!--END SCRIPT-->

    <!--START GO.JS-->
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/go-debug.js"></script>
    <!--END GO.JS-->    
    
    <!--START Combo Busqueda Sensitiva-->
    <link href="<?php echo PROJECT_NAME; ?>css/select/select2.min.css" rel="stylesheet">
    <!--END Combo Busqueda Sensitiva-->

    <script src="<?php echo PROJECT_NAME; ?>components/jquery/dist/jquery.min.js"></script>
    
    <!-- alertify -->
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/alertify.js"></script>
    <link rel="stylesheet" href="<?php echo PROJECT_NAME; ?>css/alerta/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo PROJECT_NAME; ?>css/alerta/alertify.default.css" />
   
</head>

