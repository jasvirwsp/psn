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
                                    
                                    <h4 class="page-title">Edit <?php echo title_case("branding"); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_branding_rad5daab8abe3135" class="w-100">
        <?php $rec_id = $_GET["branding_id"];
        $record_type = "branding";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
<div class="form-group ic_branding_title col-md-5 d-inline-block">
         <label class="branding_title" for="branding_title">Title</label>
        <input type="text" class="form-control branding_title" placeholder="Title" name="branding_title" value="<?php echo get_single_value($rec_meta,"branding_title"); ?>">
            </div>
      <div class="form-group ic_branding_color_scheme col-md-5 d-inline-block">
             <label class="branding_color_scheme" for="branding_color_scheme">Color Scheme</label>
            <select class="form-control db_auto_chose" name="branding_color_scheme" db_auto_chose_value="<?php echo get_single_value($rec_meta,"branding_color_scheme"); ?>">
        <option value="light">Light</option>
        <option value="dark">Dark</option>
        <option value="blue">Blue</option>
        <option value="yellow">Yellow</option></select></div>
        <div class="form-group ic_branding_footer col-md-5 d-inline-block">
         <label class="branding_footer" for="branding_footer">Footer</label>
        <input type="text" class="form-control branding_footer" placeholder="Footer" name="branding_footer" value="<?php echo get_single_value($rec_meta,"branding_footer"); ?>">
            </div>     
            <div class="form-group ic_branding_logo_width_sm col-md-5 d-inline-block">
         <label class="branding_logo_width_sm" for="branding_logo_width_sm">Logo Width Sm (Without %)</label>
        <input type="number" class="form-control branding_logo_width_sm" placeholder="Logo Width Sm" name="branding_logo_width_sm" value="<?php echo get_single_value($rec_meta,"branding_logo_width_sm"); ?>">
            </div>            

<div class="form-group ic_branding_logo_width_lg col-md-5 d-inline-block">
         <label class="branding_logo_width_lg" for="branding_logo_width_lg">Logo Width Lg (Without %)</label>
        <input type="number" class="form-control branding_logo_width_lg" placeholder="Logo Width Lg" name="branding_logo_width_lg" value="<?php echo get_single_value($rec_meta,"branding_logo_width_lg"); ?>">
            </div>      

            <div class="branding_logo_container w-100">
<div class="already_uploaded_files">
<label> Uploaded Documents</label>
                        <table class="table" id="files_table_branding_logo">
                        <thead>                       
                        </thead>
                        <tbody>
                        <p class="text-primary">Uploaded Files of Branding Logo</p>
                        <?php
                        $file_upload_meta_name = "branding_logo";                       
                        $file_ids = ltrim(get_single_value($rec_meta,"branding_logo"),",");
                        $explode_ids = explode_array($file_ids,",");
                        $record_type_file = "file_upload";
                        foreach($explode_ids as $single_id){
                            $file_meta = get_rec_meta_by_rec_id($record_type_file,$single_id);               $file_name = get_single_value($file_meta,"file_upload_file_name");
                            if($file_name == ""){
                                continue;
                            }         
                            ?>
                        <tr class="file_<?php echo $single_id;?>">
                        <td><?php echo get_single_value($file_meta,"file_upload_file_name");?></td>
                        <td>
                        <a href="javascript:void(0)" class="delete_file_upload btn btn-danger" record_id="<?php echo $single_id;?>">Delete</a> <a href="uploads/<?php echo get_single_value($file_meta,"file_upload_file_name");?>" class="btn btn-success" target="_blank">View / Download</a>
                        </td>
                        </tr>


                            <?php
                        }


                        ?>
                        </tbody>
                        </table>

                        </div>
                        <div class="form-group col-sm-12 upload_files_container">
         <label for="branding_logo" class="text-primary">Upload More Files</label>
         <input type="hidden" class="form-control" name="branding_logo" value="<?php echo $file_ids;?>">             
        <div class="upload_files_branding_logo">

        </div>
        <div class="uploaded_files_branding_logo">
        <ul class="uploaded_file_ids_branding_logo uploaded_files_list_container" style="list-style-type:none;">
        </ul>
        </div>
        </div>
        </div>



        <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_branding" value="Update BRANDING" form_id="rad5daab8abe3135"> 
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
        <script src="wsp_rad/assets/js/upload_core.js"></script>
<script src="wsp_rad/assets/js/upload_main.js"></script>

        <script>
                
        //Auto chose select values
        $(".db_auto_chose").each(function(){  
        var db_auto_chose_name = $(this).attr("name");
        var db_auto_chose_value = $(this).attr("db_auto_chose_value");
        $(this).val(db_auto_chose_value);
        });

        //Update Variables
var update_button_class_branding= ".update_branding"; // .classname
var form_id_branding = "#form_update_branding";
var update_api_url_branding = "api/branding/update_branding.php"; // /api/update.php
 var form_id_parameter_name_branding = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_branding,function(e){
e.preventDefault();
    		  var form_to_process_branding = form_id_branding + "_" + $(this).attr(form_id_parameter_name_branding);

    	 $.post(update_api_url_branding,$(form_to_process_branding).serializeArray(),function(data){
        var response_json_branding = data;

if(response_json_branding["status"] == "failure"){
  var get_errors_branding = response_json_branding["errors"];
 
    var errors_returned_branding = "";
  $(get_errors_branding).each(function(index,value){
            errors_returned_branding = errors_returned_branding + " => " + value;
    });

    swal("Error",errors_returned_branding, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_branding)[0].reset();

        

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
      
      //Upload Files code for branding_logo 
//Apply Files Datatables to mobile only
$(document).ready( function () {
        $( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    if (isMobile) {
        $('#files_table_branding_logo').DataTable({
    paging: false,
    info: false,
    responsive: {
        details: true
    },
    searching : false

});
    }
 });

} );
//Apply Files Datatables to mobile only

//Upload Files code for branding_logo 
//Apply Files Datatables to mobile only
$(document).ready( function () {
        $( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    if (isMobile) {
        $('#files_table_branding_logo').DataTable({
    paging: false,
    info: false,
    responsive: {
        details: true
    },
    searching : false

});
    }
 });

} );
//Apply Files Datatables to mobile only

var hidden_file_input_name_branding_logo = "branding_logo";
     $(".upload_files_"+hidden_file_input_name_branding_logo).upload({
  action: "api/file_upload/insert_file_upload.php",
  //chunked : true,
 maxConcurrent : 1,
  multiple : true,
  //maxSize : 5000,
  maxFiles : 20,
  leave : 'Files being uploaded, please wait.',
  label : '<i class="fe-upload"></i> Upload Branding Logo',
  autoUpload : true,
  postData: {"meta_key":hidden_file_input_name_branding_logo}
}).on("filestart.upload",uploadFileStart_branding_logo).on("filecomplete.upload",uploadFileComplete_branding_logo);

function uploadFileStart_branding_logo(){
    //Progress
    swal({
            title: "Uploading...",
            text: "Please wait",
            buttons:false,    
            closeOnClickOutside: false
            });
    //Progress
}
var multiple_file_ids_branding_logo = $("input[name="+hidden_file_input_name_branding_logo+"]").val() + ",";
function uploadFileComplete_branding_logo(e,file,response){
    var response_json_file_upload_branding_logo = JSON.parse(response);
    if(response_json_file_upload_branding_logo["status"] == "failure"){
          var get_errors_file_upload_branding_logo = response_json_file_upload_branding_logo["errors"];
          var errors_returned_file_upload_branding_logo = "";
          $(get_errors_file_upload_branding_logo).each(function(index,value){
            errors_returned_file_upload_branding_logo = errors_returned_file_upload_branding_logo + " => " + value;
                
            });
            swal("Error",errors_returned_file_upload_branding_logo, {
      icon: "error"
    });

    		}else{
                var record_id_file_upload_branding_logo = response_json_file_upload_branding_logo["record_id"];
    var unique_identifier_branding_logo = response_json_file_upload_branding_logo["file_upload_identifier"];
    var multiple_file_ids_branding_logo = $("input[name="+hidden_file_input_name_branding_logo+"]").val() + ",";
    multiple_file_ids_branding_logo = multiple_file_ids_branding_logo + record_id_file_upload_branding_logo + ",";
    $("input[name="+hidden_file_input_name_branding_logo+"]").val(multiple_file_ids_branding_logo.slice(0,-1));

    var current_uploaded_ids_branding_logo = $(".uploaded_file_ids_branding_logo").html();
    $(".uploaded_file_ids_branding_logo").html(current_uploaded_ids_branding_logo + "<li class='file_"+ record_id_file_upload_branding_logo +"'><i class='fe-check-square'></i> " + unique_identifier_branding_logo + " <a href='javascript:void(0)' record_id='"+record_id_file_upload_branding_logo+"' class='delete_file_upload btn btn-sm btn-danger'><i class='fe-trash'></i></a></li>" );
    swal.close();
}
}

   // Delete File Operation

   var delete_record_button_class_file_upload = ".delete_file_upload"; // .classname
var primary_record_key_attribute_name_file_upload = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_file_upload = "api/file_upload/delete_file_upload.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_file_upload,function(e){
e.preventDefault();

   
swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    var record_id_file_upload_branding_logo = $(this).attr(primary_record_key_attribute_name_file_upload);
		  
    $.post(delete_api_url_file_upload,{"record_id":record_id_file_upload_branding_logo});

    
                swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        
        swal("File Deleted Successfully. Please click update button");
        
        var file_ids_branding_logo = $("input[name="+hidden_file_input_name_branding_logo+"]").val();
        var removeValue = function(list, value, separator) {
        separator = separator || ",";
        var values = list.split(separator);
        for(var i = 0 ; i < values.length ; i++) {
            if(values[i] == value) {
            values.splice(i, 1);
            return values.join(separator);
            }
        }
        return list;
        }
    var file_ids_new_branding_logo = removeValue(file_ids_branding_logo,record_id_file_upload_branding_logo,',');
    //Update input
    $("input[name="+hidden_file_input_name_branding_logo+"]").val(file_ids_new_branding_logo);
    $(".file_"+record_id_file_upload_branding_logo).remove(); 
    
    });
    
  } 
});
});
//Upload Files code for branding_logo ends


        </script>
<?php include("footer.php"); ?>