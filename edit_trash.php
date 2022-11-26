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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("trash")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_trash_rad605d4f6f1213a" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("trash_id");
        $record_type = "trash";
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
<div class="form-group ic_trash_record_type col-md-6 d-inline-block">
         <label class="label_trash_record_type" for="trash_record_type">Record Type</label>
        <input type="text" class="form-control trash_record_type" placeholder="Record Type" name="trash_record_type" value="<?php echo get_single_value($rec_meta,"trash_record_type"); ?>">
            </div>
<div class="form-group ic_trash_record_id col-md-6 d-inline-block">
         <label class="label_trash_record_id" for="trash_record_id">Record Id</label>
        <input type="text" class="form-control trash_record_id" placeholder="Record Id" name="trash_record_id" value="<?php echo get_single_value($rec_meta,"trash_record_id"); ?>">
            </div>
<div class="form-group ic_trash_record_data col-md-6 d-inline-block">
         <label class="label_trash_record_data" for="trash_record_data">Record Data</label>
        <input type="text" class="form-control trash_record_data" placeholder="Record Data" name="trash_record_data" value="<?php echo get_single_value($rec_meta,"trash_record_data"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_trash" value="Update Trash" form_id="rad605d4f6f1213a"> 
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
var update_button_class_trash= ".update_trash"; // .classname
var form_id_trash = "#form_update_trash";
var update_api_url_trash = "api/trash/update_trash.php"; // /api/update.php
 var form_id_parameter_name_trash = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_trash,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_trash = form_id_trash + "_" + $(this).attr(form_id_parameter_name_trash);

    	 $.post(update_api_url_trash,$(form_to_process_trash).serializeArray(),function(data){
        var response_json_trash = data;

if(response_json_trash["status"] == "failure"){
  var get_errors_trash = response_json_trash["errors"];
 
    var errors_returned_trash = "";
  $(get_errors_trash).each(function(index,value){
            errors_returned_trash = errors_returned_trash + " => " + value;
    });

    swal("Error",errors_returned_trash, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_trash)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_trash = response_json_trash["record_id"];
var customized_content_trash = document.createElement("div");
customized_content_trash.innerHTML = "<a href='edit_trash.php?cache="+Math.random()+"&trash_id="+entry_id_trash+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='trash.php?cache="+Math.random()+"#add_trash' class='btn btn-sm btn-warning mt-1'>Add New trash</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_trash,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>