<?php include("header.php"); ?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           <?php //include("left_sidebar.php"); ?>
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page ml-0">
                <div class="content">

                    <!-- Topbar Start -->
                    <?php //include("topbar.php"); ?>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                  
                        <!-- Form Row Starts -->
        <div class="row">        
        <?php $rec_id = safe_get("email_id");
        $record_type = "email";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
     <div class="col-sm-12">
     <?php echo get_single_value($rec_meta,"email_body"); ?>
     </div>
        </div>
        <!-- Form Row Ends -->
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

        </script>
<?php //include("footer.php"); ?>