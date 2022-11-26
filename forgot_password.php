<?php
 include("wsp_rad/wsp_rad.inc.php");
 
 if(isset($_POST["user_email"])){
    $login_details = safe_post("user_email");
    if($wsp_auth->do_forget($login_details)){
        
            header("Location: forgot_password.php?message=success");
        
        
    }else{
        header("Location: forgot_password.php?message=failure");
    }
        }
        
        if(isset($_POST["user_reset_code"])){
            $reset_code = safe_post("user_reset_code");
            $user_new_password = safe_post("user_new_password");
            $login_details = array("reset_code"=>$reset_code,"new_password"=>$user_new_password);
            if($wsp_auth->do_reset($login_details)){
                
                    header("Location: login.php?message=reset_success");
                
                
            }else{
                header("Location: forgot_password.php?message=reset_failure");
            }
                }
     ?>

 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo get_branding("branding_title") ?: "WSP"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo get_branding("branding_logo") ?: "assets/images/wsp_logo.png" ;?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     

        <?php include("core_css.php"); ?>
       
<style>
/* Custom Style */
.nice-select{width:100%;}
.nice-select.open .list{width:100%;}
html,body{
    background-image:url("assets/login_bg.jpg");
    background-size:cover;
    background-repeat: no-repeat;}
</style>
    </head>

    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <div class="card-body p-4 bg-dark">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.html">
                                    <span><img src="assets/images/covertech_logo.jpg" alt="" height="22"></span>
                                    </a>
                                    
                                </div>
                                <?php if(!$_GET){ ?>
                                <br><br>
                                    <p class="text-muted mb-4 mt-3">Enter your email address to request password reset.</p>
                                <form action="" method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your email" name="user_email">
                                    </div>

                                   

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Request Reset </button>
                                    </div>

                                </form>
                            <?php }?>
                <?php if(isset($_GET["message"])){
                    $status = safe_get("message");
                    if($status == "success"){
?>
<form action="" method="post">

<div class="form-group mb-3">
    <label for="emailaddress">Reset Code</label>
    <input class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your reset code" name="user_reset_code">
</div>

<div class="form-group mb-3">
    <label for="emailaddress">New Password</label>
    <input class="form-control" type="password" id="emailaddress" required="" placeholder="Enter your new password" name="user_new_password">
</div>

<div class="form-group mb-0 text-center">
    <button class="btn btn-primary btn-block" type="submit"> Request Reset </button>
</div>

</form>
  <?php              }}?>
                                
                                <div class="response p-4">
                                <?php if(isset($_GET["message"])){
                                    $status = safe_get("message");
                                    if($status == "success"){
                                        echo "<span class='text-success'>Email Sent. Please enter token received in your email above with new password.</span>";
                                    }
                                    if($status == "failure"){
                                        echo "<span class='text-danger'>Email not found.</span>";
                                    }


                                }?>

                                </div>
                                <div class="row">
                            <div class="col-12 text-center">
                            <p class="text-muted"> <a href="login.php" class="text-muted ml-1">Login</a></p>
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


       <?php //include("footer.php");?>