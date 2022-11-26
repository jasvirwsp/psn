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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("district")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_district_rad5df86d6284184" class="w-100">
        <?php $rec_id = safe_get("district_id");
        $record_type = "district";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_district_name col-md-5 d-inline-block">
         <label class=label_"district_name" for="district_name">Name</label>
        <input type="text" class="form-control district_name" placeholder="Name" name="district_name" value="<?php echo get_single_value($rec_meta,"district_name"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_district" value="Update District" form_id="rad5df86d6284184"> 
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
var update_button_class_district= ".update_district"; // .classname
var form_id_district = "#form_update_district";
var update_api_url_district = "api/district/update_district.php"; // /api/update.php
 var form_id_parameter_name_district = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_district,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_district = form_id_district + "_" + $(this).attr(form_id_parameter_name_district);

    	 $.post(update_api_url_district,$(form_to_process_district).serializeArray(),function(data){
        var response_json_district = data;

if(response_json_district["status"] == "failure"){
  var get_errors_district = response_json_district["errors"];
 
    var errors_returned_district = "";
  $(get_errors_district).each(function(index,value){
            errors_returned_district = errors_returned_district + " => " + value;
    });

    swal("Error",errors_returned_district, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_district)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_district = response_json_district["record_id"];
var customized_content_district = document.createElement("div");
customized_content_district.innerHTML = "<a href='edit_district.php?cache="+Math.random()+"&district_id="+entry_id_district+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='district.php?cache="+Math.random()+"#add_district' class='btn btn-sm btn-warning mt-1'>Add New district</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_district,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>