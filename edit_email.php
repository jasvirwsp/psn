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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("email")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_email_rad5ded33b8eb689" class="w-100">
        <?php $rec_id = safe_get("email_id");
        $record_type = "email";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_email_from col-md-5 d-inline-block">
         <label class="email_from" for="email_from">From</label>
        <input type="email" class="form-control email_from" placeholder="From" name="email_from" value="<?php echo get_single_value($rec_meta,"email_from"); ?>">
            </div>
<div class="form-group ic_email_to col-md-5 d-inline-block">
         <label class="email_to" for="email_to">To</label>
        <input type="email" class="form-control email_to" placeholder="To" name="email_to" value="<?php echo get_single_value($rec_meta,"email_to"); ?>">
            </div>
<div class="form-group ic_email_subject col-md-5 d-inline-block">
         <label class="email_subject" for="email_subject">Subject</label>
        <input type="text" class="form-control email_subject" placeholder="Subject" name="email_subject" value="<?php echo get_single_value($rec_meta,"email_subject"); ?>">
            </div>
      <div class="form-group ic_email_status col-md-5 d-inline-block">
             <label class="email_status" for="email_status">Status</label>
            <select class="form-control db_auto_chose" name="email_status" db_auto_chose_value="<?php echo get_single_value($rec_meta,"email_status"); ?>">
        <option value="success">Success</option>
        <option value="failure">Failure</option>
                                      </select>
                                      </div>
    <div class="form-group ic_email_body col-sm-12">
         <label class="email_body" for="email_body">Body</label>
        <textarea class="form-control email_body" placeholder="Body" name="email_body"><?php echo get_single_value($rec_meta,"email_body"); ?></textarea>
        </div>
<div class="form-group ic_email_attachments col-md-5 d-inline-block">
         <label class="email_attachments" for="email_attachments">Attachments</label>
        <input type="text" class="form-control email_attachments" placeholder="Attachments" name="email_attachments" value="<?php echo get_single_value($rec_meta,"email_attachments"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_email" value="Update Email" form_id="rad5ded33b8eb689"> 
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
var update_button_class_email= ".update_email"; // .classname
var form_id_email = "#form_update_email";
var update_api_url_email = "api/email/update_email.php"; // /api/update.php
 var form_id_parameter_name_email = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_email,function(e){
e.preventDefault();
    		  var form_to_process_email = form_id_email + "_" + $(this).attr(form_id_parameter_name_email);

    	 $.post(update_api_url_email,$(form_to_process_email).serializeArray(),function(data){
        var response_json_email = data;

if(response_json_email["status"] == "failure"){
  var get_errors_email = response_json_email["errors"];
 
    var errors_returned_email = "";
  $(get_errors_email).each(function(index,value){
            errors_returned_email = errors_returned_email + " => " + value;
    });

    swal("Error",errors_returned_email, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_email)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_email = response_json_email["record_id"];
var customized_content_email = document.createElement("div");
customized_content_email.innerHTML = "<a href='edit_email.php?cache="+Math.random()+"&email_id="+entry_id_email+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='email.php?cache="+Math.random()+"#add_email' class='btn btn-sm btn-warning mt-1'>Add New email</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_email,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>