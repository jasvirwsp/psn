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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("{{mega_gen_record_type}}")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        {{mega_gen_update_form}}
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
var update_button_class_{{mega_gen_record_type}}= ".update_{{mega_gen_record_type}}"; // .classname
var form_id_{{mega_gen_record_type}} = "#form_update_{{mega_gen_record_type}}";
var update_api_url_{{mega_gen_record_type}} = "api/{{mega_gen_record_type}}/update_{{mega_gen_record_type}}.php"; // /api/update.php
 var form_id_parameter_name_{{mega_gen_record_type}} = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_{{mega_gen_record_type}},function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_{{mega_gen_record_type}} = form_id_{{mega_gen_record_type}} + "_" + $(this).attr(form_id_parameter_name_{{mega_gen_record_type}});

    	 $.post(update_api_url_{{mega_gen_record_type}},$(form_to_process_{{mega_gen_record_type}}).serializeArray(),function(data){
        var response_json_{{mega_gen_record_type}} = data;

if(response_json_{{mega_gen_record_type}}["status"] == "failure"){
  var get_errors_{{mega_gen_record_type}} = response_json_{{mega_gen_record_type}}["errors"];
 
    var errors_returned_{{mega_gen_record_type}} = "";
  $(get_errors_{{mega_gen_record_type}}).each(function(index,value){
            errors_returned_{{mega_gen_record_type}} = errors_returned_{{mega_gen_record_type}} + " => " + value;
    });

    swal("Error",errors_returned_{{mega_gen_record_type}}, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_{{mega_gen_record_type}})[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_{{mega_gen_record_type}} = response_json_{{mega_gen_record_type}}["record_id"];
var customized_content_{{mega_gen_record_type}} = document.createElement("div");
customized_content_{{mega_gen_record_type}}.innerHTML = "<a href='edit_{{mega_gen_record_type}}.php?cache="+Math.random()+"&{{mega_gen_record_type}}_id="+entry_id_{{mega_gen_record_type}}+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='{{mega_gen_record_type}}.php?cache="+Math.random()+"#add_{{mega_gen_record_type}}' class='btn btn-sm btn-warning mt-1'>Add New {{mega_gen_record_type}}</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_{{mega_gen_record_type}},
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>