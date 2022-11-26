<?php include("wsp_rad/wsp_rad.inc.php");
$wsp_auth->do_check_auth();

//Logged User Data
$username = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];
$user_role = $_SESSION["role"];
$user_permissions = $_SESSION["permissions"];
$user_id = $_SESSION["user_id"];
$user_meta = get_user_meta_with_user_id($user_id);
$logged_user = array(
    "username"=>$_SESSION["user_name"],
    "email"=>$_SESSION["user_email"],
    "role"=>$_SESSION["role"],
    "user_id"=>$_SESSION["user_id"],
    "user_meta"=>$user_meta
);
//Logged User Data

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo get_branding("branding_title") ?: "WSP";?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo get_branding("branding_logo") ?: "assets/images/wsp_logo.png" ;?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    

        <?php include("core_css.php"); ?>
       

    </head>

    <style>

@media only screen and (max-width: 768px){
    .btn, input, select{
    width: 100%;
    display: block;
    text-align: center;
    margin: 1% 0;
    }
}
</style>

 <?php if($under_maintenance == 1){
        ?>
    <div class="bg-warning text-white text-center p-2 w-100" style="z-index:99999;position:fixed;bottom:0">We are working on resolving some technical issues. You can view records. Please don't create or update any record.</div>
    <?php } ?>

    <?php if($live == 0){
        ?>
    <div class="bg-danger text-white text-center p-2 w-100" style="z-index:99999;position:fixed;top:40%">We are working on resolving some technical issues. Please wait until this message is removed.</div>
    <?php 
exit();
} ?>