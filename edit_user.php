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
                                   
                                    <h4 class="page-title">Update User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <?php 

$requested_user_id = $_GET["user_id"];                          
if(!$requested_user_id){
    $requested_user_id = $_SESSION["user_id"];
}
$rec_meta = get_user_meta_with_user_id($requested_user_id);
$rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo '<script>
            alert("No Details Found for Record ID: '.$rec_id.'");
            </script>';
            exit();
            
        }
?> 
                        
                                    <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_update_user" class="w-100">
       
        <input type="hidden" name="user_id" value="<?php echo $requested_user_id; ?>">

<div class="form-group ic_user_name col-md-5 d-inline-block">
         <label class="user_name" for="user_name">Name</label>
        <input type="text" class="form-control user_name" placeholder="Name" name="user_name" value="<?php echo get_single_value($rec_meta,"user_name"); ?>">
            </div>            

<div class="form-group ic_user_contact_no col-md-5 d-inline-block">
         <label class="user_contact_no" for="user_contact_no">Contact No</label>
        <input type="number" class="form-control user_contact_no" placeholder="Contact No" name="user_contact_no" value="<?php echo get_single_value($rec_meta,"user_contact_no"); ?>">
            </div>            
<div class="form-group ic_user_address col-sm-12">
         <label class="user_address" for="user_address">Address</label>
        <textarea class="form-control user_address" placeholder="Address" name="user_address"><?php echo get_single_value($rec_meta,"user_address"); ?></textarea>
        </div>            

<div class="form-group ic_user_user col-md-5 d-inline-block">
         <label class="user_user" for="user_user">User</label>
        <input type="text" class="form-control user_user" placeholder="User" name="user" value="<?php echo get_single_value($rec_meta,"user"); ?>">
            </div>            

<div class="form-group ic_user_email col-md-5 d-inline-block">
         <label class="user_email" for="user_email">Email</label>
        <input type="email" class="form-control user_email" placeholder="Email" name="email" value="<?php echo get_single_value($rec_meta,"email"); ?>">
            </div>            
          <?php if($user_role == "admin"){ ?> 
        <div class="form-group ic_user_role col-md-5 d-inline-block">
             <label class="user_role" for="user_role">Role</label>
            <select class="form-control db_auto_chose" name="role" db_auto_chose_value="<?php echo get_single_value($rec_meta,"role"); ?>">
            <option value="admin">Admin</option>
                                              <option value="user">User</option>
                                                   </select>
                </div>            
        <div class="form-group ic_user_status col-md-5 d-inline-block">
             <label class="user_status" for="user_status">Status</label>
            <select class="form-control db_auto_chose" name="user_status" db_auto_chose_value="<?php echo get_single_value($rec_meta,"user_status"); ?>">
                    <option value="active">Active</option>
                                              <option value="disabled">Disabled</option>
                                                   </select>
                </div>            

                <?php }?>
                
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm update_user" value="Update USER" form_id="rad5e28ef872c856"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
            

                            


                        </div>
                        </form>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

<?php include("core_scripts.php");?>

<script>


//Update Variables
var update_button_class_user= ".update_user"; // .classname
var form_id_user = "#form_update_user";
var update_api_url_user = "api/user/update_user.php"; // /api/update.php

    //Update Operation
    	   $(document).on("click",update_button_class_user,function(e){
e.preventDefault();
    		   var form_to_process_user = form_id_user;

    	 $.post(update_api_url_user,$(form_to_process_user).serializeArray(),function(data){
        var response_json_user = data;

if(response_json_user["status"] == "failure"){
  var get_errors = response_json_user["errors"];
 
    var errors_returned_user = "";
  $(get_errors).each(function(index,value){
            errors_returned_user = errors_returned_user + " => " + value;
    });

    swal("Error",errors_returned_user, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_user)[0].reset();

        

    		 // Other functions to execute on success
    		  swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        //location.reload();
    });
}
           });

    	   });


        
</script>


<?php include("footer.php"); ?>