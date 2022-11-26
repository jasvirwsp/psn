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
                                    
                                    <h4 class="page-title">Edit <?php echo title_case("setting"); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                       
                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_setting_rad5d60c8b0ea37c" class="w-100">
        <?php $rec_id = $_GET["setting_id"];
        $record_type = "setting";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_setting_name col-md-12 d-inline-block">
         <label class="setting_name" for="setting_name">Name</label>
        <input type="text" class="form-control setting_name" placeholder="Name" name="setting_name" value="<?php echo get_single_value($rec_meta,"setting_name"); ?>">
            </div>
    <div class="form-group ic_setting_value col-sm-12">
         <label class="setting_value" for="setting_value">Value</label>
        <textarea rows="10" class="form-control setting_value" placeholder="Value" name="setting_value"><?php echo get_single_value($rec_meta,"setting_value"); ?></textarea>
        </div>

        <div class="form-group ic_setting_category col-md-5 d-inline-block">
             <label class="setting_category" for="setting_category">Category</label>
            <select class="form-control db_auto_chose" name="setting_category" db_auto_chose_value="<?php echo get_single_value($rec_meta,"setting_category"); ?>">
                    <option value="">Select</option>
                    <?php 
                    foreach($settings_category as $single_category){
                        ?>
                        <option value="<?php echo $single_category;?>"><?php echo beautify_meta_name($single_category);?></option>
                        <?php
                    }
                    ?>
                                                   </select>
                </div>     
        <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_setting" value="Update SETTING" form_id="rad5d60c8b0ea37c"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
                       
                        
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
var update_button_class_setting= ".update_setting"; // .classname
var form_id_setting = "#form_update_setting";
var update_api_url_setting = "api/setting/update_setting.php"; // /api/update.php
 var form_id_parameter_name_setting = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_setting,function(e){
e.preventDefault();
    		  var form_to_process_setting = form_id_setting + "_" + $(this).attr(form_id_parameter_name_setting);

    	 $.post(update_api_url_setting,$(form_to_process_setting).serializeArray(),function(data){
        var response_json_setting = data;

if(response_json_setting["status"] == "failure"){
  var get_errors_setting = response_json_setting["errors"];
 
    var errors_returned_setting = "";
  $(get_errors_setting).each(function(index,value){
            errors_returned_setting = errors_returned_setting + " => " + value;
    });

    swal("Error",errors_returned_setting, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_setting)[0].reset();

        

    		 // Other functions to execute on success
    		  swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        location.reload();
    });
}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>