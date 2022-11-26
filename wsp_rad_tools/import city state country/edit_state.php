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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("state")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_state_rad5df9bba2f1785" class="w-100">
        <?php $rec_id = safe_get("state_id");
        $record_type = "state";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_state_name col-md-5 d-inline-block">
         <label class=label_"state_name" for="state_name">Name</label>
        <input type="text" class="form-control state_name" placeholder="Name" name="state_name" value="<?php echo get_single_value($rec_meta,"state_name"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_state" value="Update State" form_id="rad5df9bba2f1785"> 
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
var update_button_class_state= ".update_state"; // .classname
var form_id_state = "#form_update_state";
var update_api_url_state = "api/state/update_state.php"; // /api/update.php
 var form_id_parameter_name_state = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_state,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_state = form_id_state + "_" + $(this).attr(form_id_parameter_name_state);

    	 $.post(update_api_url_state,$(form_to_process_state).serializeArray(),function(data){
        var response_json_state = data;

if(response_json_state["status"] == "failure"){
  var get_errors_state = response_json_state["errors"];
 
    var errors_returned_state = "";
  $(get_errors_state).each(function(index,value){
            errors_returned_state = errors_returned_state + " => " + value;
    });

    swal("Error",errors_returned_state, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_state)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_state = response_json_state["record_id"];
var customized_content_state = document.createElement("div");
customized_content_state.innerHTML = "<a href='edit_state.php?cache="+Math.random()+"&state_id="+entry_id_state+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='state.php?cache="+Math.random()+"#add_state' class='btn btn-sm btn-warning mt-1'>Add New state</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_state,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>