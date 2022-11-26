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

                        <div class="row">
                           <div class="col-sm-6">
                           <?php 
                           $user_id = $user_id;                          
                           $user_details = get_user_meta_with_user_id($user_id);
                           
                           ?> 
                           <form method="post" id="form_update_user" action="">
                           <div class="form-group mb-3">
                           
                                                    <label>Name</label>
                                                    <br/>
                                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                    <input type="text" class="form-control" name="user_name" value="<?php echo get_single_value($user_details,"user_name");?>">
                                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group mb-3">
                                                    <label>Username</label>

                                                    <br/>
                                                    
                                                    <input type="text" class="form-control" name="user_username" value="<?php echo get_single_value($user_details,"user");?>">
                                                    <div class="clearfix"></div>
                                </div>
                            
                                <div class="form-group mb-3">
                                                    <label>Email</label>

                                                    <br/>
                                                    
                                                    <input type="email" class="form-control" name="user_email" value="<?php echo get_single_value($user_details,"email");?>">
                                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group mb-3">
                                                    <label>Password</label>

                                                    <br/>
                                                    
                                                    <input type="password" class="form-control" name="user_password">
                                                    <div class="clearfix"></div>
                                </div>
                                                         
                               



                               </div>

                           
</div>
                        

                            

<div class="row">
                                <div class="col-sm-12">
                            
                                <button type="submit" class="btn btn-lg btn-success update_user">Update User</button>
                                </div>
                                </div>
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
                
                swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        location.reload();
    });
    			 }



    	});// .post function ends

    });//Insert function ends





// $(document).on("click",".selected_test",function(){
	
// 	var all_tests = 0;
//       var all_test_price = 0;
//       var test_price =0;
//       var labtest_entry_tests = "";
// 	$('.selected_test').each(function() {
//             labtest_entry_tests = labtest_entry_tests + "|" + $(this).val();
//       test_price = $(this).attr("test_price");
//     all_tests = parseInt(all_tests) - parseInt(1);
//     all_test_price = parseInt(all_test_price) - parseInt(test_price);
// });

//       $(".selected_test_count").text(Math.abs(all_tests));
//       $(".selected_test_price").text(Math.abs(all_test_price)); 

//       //Add entries to input fields
//       $(".labtest_entry_price").val(all_test_price);
//       $(".labtest_entry_tests").val(labtest_entry_tests);
// });

$(document).on("click",".select_discount",function(){
      
      $(this).addClass("btn-success selected_discount");
      $(this).removeClass("select_discount btn-default");
});

$(document).on("click",".selected_discount",function(){
    
      $(this).addClass("btn-default select_discount");
      $(this).removeClass("selected_discount btn-success");
});



$(document).on("click",".select_discount",function(){		
        var user_selected_discounts = "";
      $('.selected_discount').each(function() {
          user_selected_discounts = user_selected_discounts + "|" + $(this).val();
        
  });
          $(".user_discounts").val(user_selected_discounts);
         
  });

 $(document).on("click",".selected_discount",function(){		
        var user_selected_discounts = "";
      $('.selected_discount').each(function() {
          user_selected_discounts = user_selected_discounts + "|" + $(this).val();
        
  });
          $(".user_discounts").val(user_selected_discounts);
         
  }); 

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
       // location.reload();
    });
}
           });

    	   });
</script>


<?php include("footer.php"); ?>