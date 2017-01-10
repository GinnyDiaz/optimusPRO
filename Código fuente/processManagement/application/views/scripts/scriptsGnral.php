    

    <!-- jQuery -->
    <script src="<?php echo PROJECT_NAME; ?>components/jquery/dist/jquery.min.js"></script>

    
    <!--START DATEPICKER-->
       <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo PROJECT_NAME; ?>js/datepicker/daterangepicker.js"></script>
    <link href="<?php echo PROJECT_NAME; ?>css/calendar/fullcalendar.min.css" rel="stylesheet">
    <script src="<?php echo PROJECT_NAME; ?>js/calendar/fullcalendar.min.js"></script>
    
    <!--END DATEPICKER-->

    <!-- input mask -->
    <script src="<?php echo PROJECT_NAME; ?>js/input_mask/jquery.inputmask.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo PROJECT_NAME; ?>components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo PROJECT_NAME; ?>components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo PROJECT_NAME; ?>js/sb-admin-2.js"></script>

        <script>
        // $(document).ready(function () {
        //     $(".select2_single").select2({
        //         placeholder: "Seleccione un campo",
        //         allowClear: true
        //     });
        // });
    </script>
   
    
    <?php 
    if(isset($datatables)){
        if($datatables==true){
            $this ->load ->view('scripts/scriptsDatatable');
        }    
    }

    // if(isset($datepicker)){
    //     if($datepicker==true){
            $this ->load ->view('scripts/scriptsDatepicker');
    //     }    
    // }
    ?>

    

<?php 
    if(isset($forms)){
        if($forms==true){
            $this ->load ->view('scripts/scriptsForms');
        }    
    }

    if(isset($inputmask)){
        if($inputmask==true){
            $this ->load ->view('scripts/scriptsMask');
        }    
    }

    if(isset($validator)){
        if($validator==true){
            $this ->load ->view('scripts/scriptsValidator');
        }    
    }


     ?>

     </body>

</html>