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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("desk")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_desk_rad637f1b233ee90" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("desk_id");
        $record_type = "desk";
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
      <div class="form-group ic_desk_size col-md-6 d-inline-block">
             <label class="label_desk_size" for="desk_size">Size</label>
            <select class="form-control db_auto_chose" name="desk_size" db_auto_chose_value="<?php echo get_single_value($rec_meta,"desk_size"); ?>">
            <option value="2">2 Persons</option>
        <option value="3">3 Persons</option>
        <option value="4">4 Persons</option>
        <option value="5">5 Persons</option>
        <option value="6">6 Persons</option>
        <option value="7">7 Persons</option>
        <option value="8">8 Persons</option>
                                      </select>
                                      </div>
      <div class="form-group ic_desk_time col-md-6 d-inline-block">
             <label class="label_desk_time" for="desk_time">Time</label>
            <select class="form-control db_auto_chose" name="desk_time" db_auto_chose_value="<?php echo get_single_value($rec_meta,"desk_time"); ?>">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
                                      </select>
                                      </div>
<div class="form-group ic_desk_count col-md-6 d-inline-block">
         <label class="label_desk_count" for="desk_count">Count</label>
        <input type="number" class="form-control desk_count" placeholder="Count" name="desk_count" value="<?php echo get_single_value($rec_meta,"desk_count"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_desk" value="Update Desk" form_id="rad637f1b233ee90"> 
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
var update_button_class_desk= ".update_desk"; // .classname
var form_id_desk = "#form_update_desk";
var update_api_url_desk = "api/desk/update_desk.php"; // /api/update.php
 var form_id_parameter_name_desk = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_desk,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_desk = form_id_desk + "_" + $(this).attr(form_id_parameter_name_desk);

    	 $.post(update_api_url_desk,$(form_to_process_desk).serializeArray(),function(data){
        var response_json_desk = data;

if(response_json_desk["status"] == "failure"){
  var get_errors_desk = response_json_desk["errors"];
 
    var errors_returned_desk = "";
  $(get_errors_desk).each(function(index,value){
            errors_returned_desk = errors_returned_desk + " => " + value;
    });

    swal("Error",errors_returned_desk, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_desk)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_desk = response_json_desk["record_id"];
var customized_content_desk = document.createElement("div");
customized_content_desk.innerHTML = "<a href='edit_desk.php?cache="+Math.random()+"&desk_id="+entry_id_desk+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='desk.php?cache="+Math.random()+"#add_desk' class='btn btn-sm btn-warning mt-1'>Add New desk</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_desk,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>