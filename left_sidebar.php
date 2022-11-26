
            <div class="left-side-menu left-side-menu-<?php echo get_branding("branding_color_scheme") ?: "dark" ;?>">

<div class="slimscroll-menu">

    <!-- LOGO -->
    <?php 
    $redirection_array = ["all" => "userpanel.php","admin"=>"userpanel_admin.php"];
     ?>
    <a href="<?php echo $redirection_array[$user_role] ?: $redirection_array["all"]; ?>" class="logo text-center mb-4">
    
        <span class="logo-lg">
            <img class="rounded-circle" src=<?php echo get_branding("branding_logo") ?: "'assets/images/wsp_logo.png'" ;?> alt="" title="" width="<?php echo get_branding("branding_logo_width_lg") ?: "'50'" ;?>%">
        </span>
        <span class="logo-sm">
            <img class="rounded-circle" src=<?php echo get_branding("branding_logo") ?: "'assets/images/wsp_logo.png'" ;?> alt="" width="<?php echo get_branding("branding_logo_width_sm") ?: "'50'" ;?>%">
        </span>
    </a>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <?php
        if($user_role == "admin"){
            include("left_sidebar_admin.php");
        }
        if($user_role == "user"){
            include("left_sidebar_user.php");
        }
        ?>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
