<?php
 include("wsp_rad/wsp_rad.inc.php");
 $error_message = "";
 //Check if already logged In
//  session_start();
//  if(isset($_SESSION["token"])){
//     header("Location: userpanel.php");
//  }

// If token cookie is available
if(!is_array($cookie->get("csrf"))){     
    if($wsp_auth->do_login_with_auth_token($cookie->get("csrf"))){   
    header("Location:userpanel.php");
    }
}

 if(isset($_POST["user_username"])){
    $login_details = array("username"=>safe_post("user_username"),"password"=>safe_post("user_password"));
    if($wsp_auth->do_login($login_details)){
        
            header("Location: userpanel.php");
        
        
    }else{
        $error_message = "Login Details are Invalid";
    }
        }
     ?>

 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo get_branding("branding_title") ?: "WSP";?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
       

        <?php include("core_css.php"); ?>
       
<style>
/* Custom Style */
.nice-select{width:100%;}
.nice-select.open .list{width:100%;}
</style>
    </head>

    <body class="authentication-bg">

        <div class="account-pages mt-2 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card bg-dark">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                
                                    <a href="login.php">                                    
                                        <span><img class="rounded-circle" src=<?php echo get_branding("branding_logo") ?: "'assets/images/wsp_logo.png'" ;?> alt="" width="<?php echo get_branding("branding_logo_width_lg") ?: "50" ;?>%"></span>
                                    </a>
                                    <?php if(isset($_GET["message"])){
                    $status = safe_get("message");
                    if($status == "reset_success"){
?>
<p class='text-success p-2'>Password Reset Success.Please login with new password.</p>
<?php
                 }   }?>
                                    <p class="text-muted mb-4 mt-3"><h3>Sign Up</h3></p>
                                </div>

                                <form action="" method="post" id="form_user">
                                <?php 
                                if($error_message != ""){
                                    ?>
                                    <p class="bg-danger text-white p-2"><?php echo $error_message; ?></p>
                                    <?php
                                }
                                ?>
                                
                                <div class="form-group mb-3">
                                        <label for="user_name">Name</label>
                                        <input class="form-control" type="text" id="user_name" required="" placeholder="Enter Practice Name" name="user_name">
                                    </div>                                    
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name="email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Username (Without Space)</label>
                                        <input class="form-control" type="text" id="emailaddress" required="" placeholder="username" name="user">
                                    </div>

                                    <div class="form-group mb-3">                                    
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <!-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div> -->
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block insert_user" type="submit"> Register Now </button>
                                    </div>

                                </form>
                                <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted"> <a href="login.php" class="text-warning ml-1">Login</a></p>
                               
                            </div> <!-- end col -->
                        </div>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                      
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        <?php include("core_scripts.php");?>
<script>
//Insert variables
var insert_button_class_user = ".insert_user"; // .classname
    	var form_id_user = "#form_user";  // #entry_form
    	var insert_api_url_user = "api/user/insert_user_v.php?type=user"; // /api/insert.php
    	

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
                
                swal("Signing Up", {
      icon: "success",
      timer: 1000
    }).then(function(){
        window.location = "login.php";
    });
    			 }



    	});// .post function ends

    });//Insert function ends
</script>
       <?php //include("footer.php");?>