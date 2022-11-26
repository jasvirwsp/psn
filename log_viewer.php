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
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Log Viewer : Loggin Status : <?php echo $log_error; ?> (1=ON,0=OFF)</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                                        <!-- file>s>select -->

        <!-- Form Row Starts -->
        <form method="post" action="" id="form_log_rad615191a9ebcfc">   
        <div class="row">
        <div class="form-group ic_log_file col-md-6 d-inline-block">
             <label class="log_file" for="log_file">File</label>
            <select class="form-control db_auto_chose" name="log_file" db_auto_chose_value="<?php echo safe_post("log_file"); ?>">
                    <option value="">Select</option>
                    <?php
    $dir = __DIR__ . "/wsp_rad/logs/";
    $files = preg_grep('~\.(rad)$~', scandir($dir,0));
    $cc = 1;
    foreach($files as $single_file){
        echo "<option value='" . $single_file ."'>" . $single_file . "</option>"; 
        $cc++;
    }   
    ?>
                                                   </select>
                </div>            
                 
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_log" value="View Log" form_id="rad615191a9ebcfc"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
        <hr>
        <div class="row">
<div class="col-sm-12">
    <?php 
    if(safe_post("log_file") != ""){
        $log_file_contents = file_get_contents(__DIR__ . "/wsp_rad/logs/".safe_post("log_file"));
        $explode_requests = explode("|||||",$log_file_contents);
        foreach($explode_requests as $single_request){
            $explode_single = explode(",",$single_request);
        if($single_request[0] == "/auth/login.php"){
            continue;
        }
?>
<!-- //Log Item -->
<div class="card text-left">      
      <div class="card-body">
        <h4 class="card-title">
            <h3 class="bg-warning p-1"><?php echo $explode_single[1]; ?></h3>
            <h3 class="bg-success p-1"><?php echo $explode_single[0]; ?></h3>
        </h4>
        <p class="card-text"><?php  
        $decoded_body = urldecode($explode_single[2]);
        $explode_decoded_body = explode("&",$decoded_body);
        foreach($explode_decoded_body as $single_parameter){
echo $single_parameter . "<br>";
        }
        ?></p>
      </div>
    </div>
    <!-- //Log Item -->
<?php        
        }
    }
     ?>
    
</div>

        </div>
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        
<?php //include("footer.php"); ?>