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
                                   
                                    <h4 class="page-title">Welcome, <?php echo get_single_value($user_meta,"user_name","title"); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
<?php $show_stats_panels = false;
if($show_stats_panels){ ?> 

<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-dark card"><div class="hyperlink_body"><h3><i class="fe-bar-chart text-warning"></i> </h3>
        <h3 class="text-silver">Link</h3></div></a>
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-dark card"><div class="hyperlink_body"><h3><i class="fe-users text-warning"></i> </h3>
        <h3 class="text-silver">Link</h3></div></a>
        </div>
<!-- Col 2 ends -->

<!-- Col 3 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-dark card"><div class="hyperlink_body"><h3><i class="fe-file-text text-warning"></i> </h3>
        <h3 class="text-silver">Link</h3></div></a>
        </div>
<!-- Col 3 ends -->
<!-- Col 4 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-dark card"><div class="hyperlink_body"><h3><i class="fe-file-text text-warning"></i> </h3>
        <h3 class="text-silver">Link</h3></div></a>
        </div>
<!-- Col 4 ends -->
         </div>
<!-- Row Ends -->


 <!-- Row Starts -->
 <div class="row">
<!-- Col 1 -->
        <div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-light text-dark  card"><div class="hyperlink_body"><h3><i class="fe-plus-circle text-warning"></i> </h3>
        <h3>Link</h3></div></a>
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-light text-dark card"><div class="hyperlink_body"><h3><i class="fe-plus-circle text-warning"></i> </h3>
        <h3>Link</h3></div></a>
        </div>
<!-- Col 2 ends -->

<!-- Col 3 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-light text-dark  card"><div class="hyperlink_body"><h3><i class="fe-plus-circle text-warning"></i> </h3>
        <h3>Link</h3></div></a>
        </div>
<!-- Col 3 ends -->
<!-- Col 4 -->
<div class="col-sm-3 text-center">
        <a href="#" class="p-3 shadow bg-light text-dark  card"><div class="hyperlink_body"><h3><i class="fe-plus-circle text-warning"></i> </h3>
        <h3>Link</h3></div></a>
        </div>
<!-- Col 4 ends -->
         </div>
<!-- Row Ends -->


<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-12">
        <div class="card">
                                    <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <h4 class="header-title">Stats Chart</h4>
    
                                        <canvas id="bar" height="437" class="mt-4 chartjs-render-monitor" width="672" style="display: block; height: 350px; width: 100%;"></canvas>
                                    </div>
                                </div>
              </div>
<!-- Col 1 ends-->


         </div>
<!-- Row Ends -->      
                      

<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-6">
        <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">RECENT HAPPENINGS</h4>
                                        <p class="text-muted font-13">
                                           Some Text
                                        </p>
            
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end card-body -->
                                </div>
              </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
<div class="col-sm-6">
<div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">RECENT HAPPENINGS</h4>
                                        <p class="text-muted font-13">
                                           Some Text
                                        </p>
            
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end card-body -->
                                </div>
              </div>
<!-- Col 2 ends-->

         </div>
<!-- Row Ends -->            
<?php } ?>
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                       
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        
     <script>

     </script>
<?php include("footer.php"); ?>