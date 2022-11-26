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
                                    
                                    <h4 class="page-title">Change Password</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                                          <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_user_rad5ce0f886b1995">
        <?php 
        // $user_id = safe_get("user_id");
        if(safe_get("user_id") != "" && $user_role == "admin"){
            $user_id = safe_get("user_id");
        }
        $rec_meta = get_user_meta_with_user_id($user_id);
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo '<script>
            alert("No Details Found for Record ID: '.$user_id.'");
            </script>';
            exit();
            
        }
        ?>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


<div class="form-group ic_user_new_password col-md-12 d-inline-block">
         <label class="user_new_password" for="user_new_password">New Password</label>
        <input type="password" class="form-control user_new_password" placeholder="New Password" name="user_new_password">
            </div>            

<div class="form-group ic_user_new_password_confirm col-md-12 d-inline-block">
         <label class="user_new_password_confirm" for="user_new_password_confirm">New Password Again</label>
        <input type="password" class="form-control user_new_password_confirm" placeholder="New Password Confirm" name="user_new_password_confirm">
            </div>            
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm update_user" value="Update Password" form_id="rad5ce0f886b1995"> 
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
var update_button_class_user= ".update_user"; // .classname
var form_id_user = "#form_update_user";
var update_api_url_user = "api/user/update_password.php"; // /api/update.php
 var form_id_parameter_name_user = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_user,function(e){
e.preventDefault();
    		  var form_to_process_user = form_id_user + "_" + $(this).attr(form_id_parameter_name_user);

    	 $.post(update_api_url_user,$(form_to_process_user).serializeArray(),function(data){
        var response_json_user = data;

if(response_json_user["status"] == "failure"){
  var get_errors_user = response_json_user["errors"];
 
    var errors_returned_user = "";
  $(get_errors_user).each(function(index,value){
            errors_returned_user = errors_returned_user + " => " + value;
    });

    swal("Error",errors_returned_user, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_user)[0].reset();

        

    		 // Other functions to execute on success
    		  swal("Password Updated Successfully", {
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