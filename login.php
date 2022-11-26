<?php
include("wsp_rad/wsp_rad.inc.php");
$error_message = "";
//Check if already logged In
//  session_start();
//  if(isset($_SESSION["token"])){
//     header("Location: userpanel.php");
//  }

// If token cookie is available

if (!is_array($cookie->get("csrf"))) {
    if ($wsp_auth->do_login_with_auth_token($cookie->get("csrf"))) {
        $redirection_array = ["all" => "userpanel.php"];
        $logged_redirection = $redirection_array[$_SESSION["role"]] ?: $redirection_array["all"];
        header("Location: $logged_redirection");       
    }
}

if (isset($_POST["user_username"])) {
    $login_details = array("username" => safe_post("user_username"), "password" => safe_post("user_password"));
    if ($wsp_auth->do_login($login_details)) {
        $redirection_array = ["all" => "userpanel.php"];
        $logged_redirection = $redirection_array[$_SESSION["role"]] ?: $redirection_array["all"];
        header("Location: $logged_redirection");       
    } else {
        $error_message = "Login Details are Invalid";
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
        .nice-select {
            width: 100%;
        }

        .nice-select.open .list {
            width: 100%;
        }

        body.authentication-bg {
            background-color: #2b2f38;
        }
    </style>
</head>

<body class="authentication-bg">

    <div class="account-pages mt-2 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 mt-5">
                    <div class="card bg-dark rounded">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">

                                <a href="login.php">
                                    <span><img class="rounded-circle" src=<?php echo get_branding("branding_logo") ?: "'assets/images/wsp_logo.png'"; ?> alt="" width="<?php echo get_branding("branding_logo_width_lg") ?: "50"; ?>%"></span>
                                </a>
                                <?php if (isset($_GET["message"])) {
                                    $status = safe_get("message");
                                    if ($status == "reset_success") {
                                ?>
                                        <p class='text-success p-2'>Password Reset Success.Please login with new password.</p>
                                <?php
                                    }
                                } ?>

                            </div>

                            <form action="" method="post" class="mt-3">
                                <?php
                                if ($error_message != "") {
                                ?>
                                    <p class="bg-danger text-white p-2"><?php echo $error_message; ?></p>
                                <?php
                                }
                                ?>
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Username</label>
                                    <input class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your email" name="user_username">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="user_password">
                                </div>

                                <div class="form-group mb-3">
                                    <!-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div> -->
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p class="text-muted"> <a href="forgot_password.php" class="text-muted ml-1">Forgot your password?</a></p>

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


    <?php //include("footer.php");
    ?>