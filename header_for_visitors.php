<?php include("wsp_rad/wsp_rad.inc.php");


//User ID For Visitors
$user_role = "visitor";
$user_id = 0; // 0 ID is reserved for visitors
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
@media only screen and (max-width: 768px){
    .btn{
    width: 100%;
    display: block;
    text-align: center;
    margin: 1% 0;
    }
}

</style>
    </head>