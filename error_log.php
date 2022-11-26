<?php include("header.php"); ?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           <?php include("left_sidebar.php"); ?>
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Topbar Start -->
                    <?php include("topbar.php"); ?>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Error Logs <!-- Button trigger modal -->
<a class="btn btn-danger btn-sm" href="error_log.php?clear=yes"><i class="fe-trash"></i> Clear Logs </a></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
<?php 
 if(safe_get("clear") == "yes"){
    file_put_contents("wsp_rad/logs/php-error.log","");
    echo "<script>window.location='error_log.php';</script>";
}
?>
                        <div class="row">
                        <div class="form-group ic_error_log col-sm-12">
         <label class="error_log" for="error_log">Logs (Copy and paste below logs in a text file. Send text file to developers.)</label>
        <textarea class="form-control error_log select_this" placeholder="Log" name="error_log" rows="50"><?php $errors = file_get_contents("wsp_rad/logs/php-error.log");echo $errors;
        ?>
        </textarea>
        </div>            
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

       <script>
       $(".select_this").click(function(){
    $(this).select();
});
       </script> 
<?php include("footer.php"); ?>