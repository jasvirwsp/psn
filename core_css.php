 <!-- Plugins css -->
 <link href="css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
         <link href="css/app.min.css" rel="stylesheet" type="text/css" />
         <link href="wsp_rad/assets/css/colors.min.css" rel="stylesheet" type="text/css" />
        <link href="wsp_rad/assets/css/upload.css" rel="stylesheet" type="text/css" />
        <link href="wsp_rad/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="wsp_rad/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="wsp_rad/assets/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
        <style>
        .select2-container{width:100%!important;}
            .form-control{
                color:#000000;
            }
.ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;        
    background-color:#323a46;
    z-index:9999;
  }

.ui-autocomplete li{
    font-weight:bold;
    font-size:16px;
    font-family: Muli,sans-serif;
    color:#fff;
}
.upload_files_container{
    border:2px dotted grey;
    border-radius:10px;
    padding:10px;
}
.uploaded_files_list_container li{
    border:2px dotted grey;
    border-radius:10px;
    padding:5px;
    margin-top:5px;
}
.custom-control-label{vertical-align:top;}
body{
    color:#3e3e3e;
    font-size:14px;
    font-weight:500;
    background-color:#343b4a;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{
    font-weight:600;
}
.content-page{
    border-radius: 30px 0 0 30px;
    margin-top: 20px;
    background-color: #f7f7f7;

}
.bg-dark{
    color: silver;
}
.modal-xlg {
    max-width: 80%;
}
table tbody tr{border-bottom: 3px solid #dcdcdc;}
.table td, .table th{padding:0.6rem}
.left-side-menu-dark #sidebar-menu>ul>li>a.active{color: #000;
    background-color: #f7f7f7;border-radius: 30px 0 0 30px}
    
    .left-side-menu-dark{
        border-right: none;
    }
.footer{
    border-radius: 30px 0 0 30px
}
</style>

<!-- Blue Color Scheme -->
<?php 
if(get_branding("branding_color_scheme") == "blue"){
    ?>
    <style>
.left-side-menu-blue {
    background-color: #0339A6;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-right: 2px solid #2692dd;
}
#sidebar-menu>ul>li>a{
    color:#ffffff;
}
.nav-second-level li a, .nav-thrid-level li a{
    color:#ffffff;
}
</style>
<?php }
?>

<!-- Yellow Color Scheme -->
<?php 
if(get_branding("branding_color_scheme") == "yellow"){
    ?>
    <style>
.left-side-menu-yellow {
    background-color: #F2B705;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-right: 2px solid #d4a106;
}
#sidebar-menu>ul>li>a, .nav-second-level li a, .nav-thrid-level li a{
    color:#000000;
}
#sidebar-menu>ul>li>a.active, .nav-second-level li.active>a, .nav-thrid-level li.active>a{
    color:#ffffff;
}
.nav-second-level li a:focus, .nav-second-level li a:hover, .nav-thrid-level li a:focus, .nav-thrid-level li a:hover{
    color:#ffffff;
}
#sidebar-menu>ul>li>a:active, #sidebar-menu>ul>li>a:focus, #sidebar-menu>ul>li>a:hover{
    color:#ffffff;
}
</style>
<?php }
?>