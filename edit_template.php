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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("template")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_template_rad5df56558448a3" class="w-100">
        <?php $rec_id = safe_get("template_id");
        $record_type = "template";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_template_mail_title col-md-5 d-inline-block">
         <label class=label_"template_mail_title" for="template_mail_title">Mail Title</label>
        <input type="text" class="form-control template_mail_title" placeholder="Mail Title" name="template_mail_title" value="<?php echo get_single_value($rec_meta,"template_mail_title"); ?>">
            </div>
    <div class="form-group ic_template_mail_content col-sm-12">
         <label class="label_template_mail_content" for="template_mail_content">Mail Content</label>
        <textarea class="form-control template_mail_content" placeholder="Mail Content" name="template_mail_content"><?php echo get_single_value($rec_meta,"template_mail_content"); ?></textarea>
        </div>
        <div class="form-group ic_template_editor_content col-sm-12">
         <label class="template_editor_content" for="template_editor_content">Editor Content</label>
        <textarea class="form-control template_editor_content" placeholder="Editor Content" name="template_editor_content"><?php echo get_single_value($rec_meta,"template_editor_content"); ?></textarea>
        </div>       
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_template" value="Update Template" form_id="rad5df56558448a3"> 
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
var update_button_class_template= ".update_template"; // .classname
var form_id_template = "#form_update_template";
var update_api_url_template = "api/template/update_template.php"; // /api/update.php
 var form_id_parameter_name_template = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_template,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_template = form_id_template + "_" + $(this).attr(form_id_parameter_name_template);

    	 $.post(update_api_url_template,$(form_to_process_template).serializeArray(),function(data){
        var response_json_template = data;

if(response_json_template["status"] == "failure"){
  var get_errors_template = response_json_template["errors"];
 
    var errors_returned_template = "";
  $(get_errors_template).each(function(index,value){
            errors_returned_template = errors_returned_template + " => " + value;
    });

    swal("Error",errors_returned_template, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_template)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_template = response_json_template["record_id"];
var customized_content_template = document.createElement("div");
customized_content_template.innerHTML = "<a href='edit_template.php?cache="+Math.random()+"&template_id="+entry_id_template+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='template.php?cache="+Math.random()+"#add_template' class='btn btn-sm btn-warning mt-1'>Add New template</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_template,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>