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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("booking")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_booking_rad637f1db99593a" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("booking_id");
        $record_type = "booking";
        //Permission Check
        check_record_ownership("fetch",$user_id, $user_role, $record_type, $rec_id);
        //Permission Check
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
      <div class="form-group ic_booking_desk_id col-md-6 d-inline-block">
             <label class="label_booking_desk_id" for="booking_desk_id">Desk Id</label>
            <select class="form-control db_auto_chose" name="booking_desk_id" db_auto_chose_value="<?php echo get_single_value($rec_meta,"booking_desk_id"); ?>">
      <?php
//fetch query of desk fetch #start
$where_array_desk_fetch = array(""=>"");
$results_desk_fetch = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_fetch]);
$count_results_desk_fetch = count($results_desk_fetch);

//Lets loop through washing machine
                        foreach($results_desk_fetch as $single_result_desk_fetch){
?>
<option value="<?php echo $single_result_desk_fetch["record_id"];?>"><?php echo beautify_meta_name($single_result_desk_fetch["desk_size"]);?></option>
                           <?php
                        } 
//fetch query of desk  fetch #ends    

      ?>
                                      </select>
                                      </div>

<div class="form-group ic_booking_visit_time col-md-6 d-inline-block">
         <label class="label_booking_visit_time" for="booking_visit_time">Visit Time</label>
        <input type="text" class="form-control booking_visit_time" placeholder="Visit Time" name="booking_visit_time" value="<?php echo get_single_value($rec_meta,"booking_visit_time"); ?>">
            </div>
<div class="form-group ic_booking_user_id col-md-6 d-inline-block">
         <label class="label_booking_user_id" for="booking_user_id">User Id</label>
        <input type="text" class="form-control booking_user_id" placeholder="User Id" name="booking_user_id" value="<?php echo get_single_value($rec_meta,"booking_user_id"); ?>">
            </div>

            <div class="form-group ic_booking_special_requirements col-sm-12">
         <label class="booking_special_requirements" for="booking_special_requirements">Special Requirements</label>
        <textarea class="form-control booking_special_requirements" placeholder="Special Requirements" name="booking_special_requirements"><?php echo get_single_value($rec_meta,"booking_special_requirements"); ?></textarea>
        </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_booking" value="Update Booking" form_id="rad637f1db99593a"> 
        </div>
        </form>
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

        <script>
                
        //Auto chose select values
        $(".db_auto_chose").each(function(){  
        var db_auto_chose_name = $(this).attr("name");
        var db_auto_chose_value = $(this).attr("db_auto_chose_value");
        $(this).val(db_auto_chose_value);
        });

        //Update Variables
var update_button_class_booking= ".update_booking"; // .classname
var form_id_booking = "#form_update_booking";
var update_api_url_booking = "api/booking/update_booking.php"; // /api/update.php
 var form_id_parameter_name_booking = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_booking,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_booking = form_id_booking + "_" + $(this).attr(form_id_parameter_name_booking);

    	 $.post(update_api_url_booking,$(form_to_process_booking).serializeArray(),function(data){
        var response_json_booking = data;

if(response_json_booking["status"] == "failure"){
  var get_errors_booking = response_json_booking["errors"];
 
    var errors_returned_booking = "";
  $(get_errors_booking).each(function(index,value){
            errors_returned_booking = errors_returned_booking + " => " + value;
    });

    swal("Error",errors_returned_booking, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_booking)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_booking = response_json_booking["record_id"];
var customized_content_booking = document.createElement("div");
customized_content_booking.innerHTML = "<a href='edit_booking.php?cache="+Math.random()+"&booking_id="+entry_id_booking+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='booking.php?cache="+Math.random()+"#add_booking' class='btn btn-sm btn-warning mt-1'>Add New booking</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_booking,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>