<?php include("header.php"); ?>

    <body>

        <!-- Begin page -->
        <div id="wrapper" data-barba="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           <?php include("left_sidebar.php"); ?>
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page" data-barba="container" data-barba-namespace="home">
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
                                   
                                    <h4 class="page-title">Add New User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                                    <!-- name>i,contact_no>i>n,address>t,user>i,email>i>e,password>i>p,role>s>admin/salesman/dealer/accountant/production,status>s>active/disabled,limit>i>n -->

        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_user" class="w-100">        
<div class="form-group ic_user_name col-md-5 d-inline-block">
         <label class="user_name" for="user_name">Full Name </label>
        <input type="text" class="form-control user_name" placeholder="Name"  name="user_name">
            </div>            
<div class="form-group ic_user_contact_no col-md-5 d-inline-block">
         <label class="user_contact_no" for="user_contact_no">Contact No</label>
        <input type="number" class="form-control user_contact_no" placeholder="Contact No"  name="user_contact_no">
            </div>            
<div class="form-group ic_user_address col-sm-12">
         <label class="user_address" for="user_address">Address</label>
        <textarea class="form-control user_address" placeholder="Address" name="user_address"></textarea>
        </div>            
<div class="form-group ic_user_user col-md-5 d-inline-block">
         <label class="user_user" for="user_user">Username (For Login) (Space not allowed)</label>
        <input type="text" class="form-control user_user" placeholder="User"  name="user" style="text-transform:lowercase;">
            </div>            
<div class="form-group ic_user_email col-md-5 d-inline-block">
         <label class="user_email" for="user_email">Email (For Login)</label>
        <input type="email" class="form-control user_email" placeholder="Email"  name="email">
            </div>            
<div class="form-group ic_user_password col-md-5 d-inline-block">
         <label class="user_password" for="user_password">Password</label>
        <input type="password" class="form-control user_password" placeholder="Password"  name="password">
            </div>            
        <div class="form-group ic_user_role col-md-5 d-inline-block">
             <label class="user_role" for="user_role">Role / Type</label>
            <select class="form-control user_role" name="role">
                    <option value="admin">Admin</option>
                                              <option value="user">User</option>                                             
                                                   </select>
                </div>            
        <div class="form-group ic_user_status col-md-5 d-inline-block">
             <label class="user_status" for="user_status">Status</label>
            <select class="form-control user_status" name="user_status">
                    <option value="active">Active</option>
                                              <option value="disabled">Disabled</option>
                                                   </select>
                </div>            
     
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_user" value="Add User" form_id="rad5e28ef872c856"> 
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
//Insert variables
var insert_button_class_user = ".insert_user"; // .classname
    	var form_id_user = "#form_user";  // #entry_form
    	var insert_api_url_user = "api/user/insert_user.php"; // /api/insert.php
    	

    	//To show updated values on same page
    	// var updated_data_container_class = "."; // .classname
    	// var updated_data_element_class = "." // .classname

    	//Insert Operation
    	$(document).on("click",insert_button_class_user,function(e){
    	e.preventDefault();
    	var form_to_process_user = form_id_user;

    	$.post(insert_api_url_user,$(form_to_process_user).serializeArray(),function(data){

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
    		// $(form_to_process_user)[0].reset();

    		//Focus to first input
    		$(form_to_process_user + " input[type=text]").first().focus();

    		//To show updated values on same page
    		// $(updated_data_container_class).load(updated_data_file_url);


    		// Other functions to execure on success
    			//Reload page on success
                
                swal("Added Successfully.", {
      icon: "success"
    }).then(function(){
        // location.reload();
    });
    			 }



    	});// .post function ends

    });//Insert function ends



</script>


<?php include("footer.php"); ?>