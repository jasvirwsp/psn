<?php include("header.php"); ?>
<style>
    .booking-div {
        display: flex;
    justify-content: space-between; 
    }
    .details-div {
        display: flex;
    justify-content: space-between;
    background: #183672;
    margin: 0px;
    padding: 15px 10px;
    border-radius: 5px;
    color: #ffffff;
    }
    .details-div a {
        font-weight: 600;
    text-decoration: none;
    color: #ffffff;
    }
</style>
<body>

<!-- Begin page -->
<div id="wrapper" data-barba="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <?php include("left_sidebar.php"); ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page" data-barba="container" data-barba-namespace="home">
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


<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
<!-- <div class="col-sm-3 text-center">
<div class="switchery-demo">
<input type="checkbox" checked data-plugin="switchery" data-color="#039cfd" style="display:none;"/>
<span class="switchery switchery-default" style="background-color: rgb(3, 156, 253); border-color: rgb(3, 156, 253); box-shadow: rgb(3, 156, 253) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
        </span>
                                                
            
                                            </div>
</div> -->
</div>      

<div class="row">
<!-- Col 1 -->
<div class="col-sm-12 text-center">
<table class="table mb-0">
                                               
                                                <tbody>
<?php
//fetch query of booking fetch #start
$where_array_booking_fetch = array(""=>"");
$options_array_booking_fetch = array();
$results_booking_fetch = $records_fetch_controller->fetch_record_with_where(["booking",$where_array_booking_fetch,$options_array_booking_fetch]);
$count_results_booking_fetch = count($results_booking_fetch);
//Lets loop through 
                        foreach($results_booking_fetch as $single_result_booking_fetch){
                            $rec_id_booking_fetch = $single_result_booking_fetch["record_id"];  
                           $booking_user = $single_result_booking_fetch["booking_user_id"];  
                           $booking_table_id = $single_result_booking_fetch["booking_desk_id"];
                           $booking_date = $single_result_booking_fetch["date_created"];
                            $booking_user_name = get_user_meta_value_with_user_id($booking_user,'user_name') ;  
                            $booking_email = get_user_meta_value_with_user_id($booking_user,'email') ;                         
?>
 <tr>
                                                    <td scope="row" class="text-left">
                                                    <div class="booking-div">  
                                                    <div class="customer-details">  
                                                    <?php echo $booking_user_name; ?> X <?php echo $booking_table_id; ?><br>
                                                        
                                                        <?php echo beautify_date($booking_date, '').' '.$single_result_booking_fetch['booking_visit_time']; ?>
                                                    </div>
                                                    <div class="show-customer-details">
                                                    <span class="text-right badge badge-success p-2">Success</span>
                                                    </div>
<!-- Modal -->
<div class="modal fade" id="booking-no-<?php echo $rec_id_booking_fetch; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $booking_user_name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo $booking_user_name; ?> <br>
      <?php echo $booking_email; ?> <br>
       table - <?php echo $booking_table_id; ?> <br>
                                                        Dietary requirements - <?php echo $single_result_booking_fetch['booking_special_requirements']; ?> <br>
                                                        <?php echo beautify_date($booking_date, '').' '.$single_result_booking_fetch['booking_visit_time']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


                                                    </div>
                                                  
                                                            
<div class="details-div mt-2">
    <div class="customer-details">Coustomer</div>
    <div class="show-customer-details"><a href="#" data-toggle="modal" data-target="#booking-no-<?php echo $rec_id_booking_fetch; ?>">Click to view details Coustomer <i class="fe-chevron-down"></i></a></div>
</div>
                                                        </td>
                                                    </tr>
                                                  
                                            
   <?php } 
//fetch query of booking  fetch #ends    


?>
                                                 
                                                </tbody>
</table>
</div>
</div>



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