<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Customize Fields</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!-- Bootstrap core CSS     -->
    <link href="../wsp_rad/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<style>
.select_this{margin:20px 0;width:90%;}
.enter_field{width:100%;font-size:30px;font-weight:bold;font-family:Helvetica}
.col-sm-6{display:inline-block}
</style>
</head>

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
                                    
                                    <h4 class="page-title">Customize Fields</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                                        <!-- type>s>fetch/insert/update/delete,rec_type>i -->

              
                        <!-- end row -->
                                        <!-- rectype>i,action>s>select/add/remove/update,field_name>i,replace_hooks>s>no/yes -->

        <!-- Form Row Starts -->
        <form method="get" action="" id="form_customize_rad5ef84c3309771">      
        <div class="row">
          
<div class="form-group ic_customize_rectype col-md-5 d-inline-block">
         <label class="customize_rectype" for="customize_rectype">Rectype (ex: person)</label>
        <input type="text" class="form-control customize_rectype" placeholder="Rectype"  name="customize_rectype" value="<?php echo safe_get('customize_rectype');?>">
            </div>  
<div class="form-group ic_customize_field_name col-md-5 d-inline-block">
         <label class="customize_field_name" for="customize_field_name">Field Name (ex: name)</label>
        <input type="text" class="form-control customize_field_name" placeholder="New Name"  name="customize_field_name" value="<?php echo safe_get('customize_field_name');?>">
            </div>        
            <div class="form-group ic_customize_new_name col-md-5 d-inline-block">
         <label class="customize_new_name" for="customize_new_name">New Name</label>
        <input type="text" class="form-control customize_new_name" placeholder="New Name"  name="customize_new_name" value="<?php echo safe_get('customize_new_name');?>">
            </div>    
            <div class="form-group ic_customize_action col-md-5 d-inline-block">
             <label class="customize_action" for="customize_action">Action</label>
            <select class="form-control customize_action db_auto_chose" db_auto_chose_value="<?php echo safe_get('customize_action');?>" name="customize_action">
                    <option value="">Select</option>
                                              <option value="add">Add</option>
                                              <option value="remove">Remove</option>
                                              <option value="update">Update</option>
                                                   </select>
                </div>    
        <div class="form-group ic_customize_replace_hooks col-md-5 d-inline-block">
             <label class="customize_replace_hooks" for="customize_replace_hooks">Replace Hooks</label>
            <select class="form-control customize_replace_hooks db_auto_chose" db_auto_chose_value="<?php echo safe_get('customize_replace_hooks');?>" name="customize_replace_hooks">
                    <option value="no">No</option>
                                              <option value="yes">Yes</option>
                                                   </select>
                </div>            
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_customize" value="DO Customize" form_id="rad5ef84c3309771"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
        
        <div class="response bg-warning p-4 w-100 text-white">
            <?php if(safe_get("customize_rectype")){
$rectype = safe_get("customize_rectype");
$action = safe_get("customize_action");
$field_name = safe_get("customize_rectype"). "_" . safe_get("customize_field_name");
$new_name = safe_get("customize_rectype"). "_" . safe_get("customize_new_name");
$replace_hooks = safe_get("customize_replace_hooks");

//New Field
if($action == "add"){
    //remove column
    $sql = "ALTER TABLE `".$rectype."` ADD COLUMN `". $field_name . "` TEXT NOT NULL";
    $pdo->exec($sql);
    echo "Added to Database<br>";
    //remove from meta_keys
    $mk_dir = "../wsp_rad/meta_keys.php";
    //Replace contents    
    $meta_keys_array_name = "meta_keys_of_".$rectype;
    $meta_keys_array = $$meta_keys_array_name;
    $count = count($meta_keys_array);    
    $last_meta = $meta_keys_array[$count-1];
    $get_content = file_get_contents($mk_dir);
    $new_content = str_replace($last_meta."');",$last_meta."','".$field_name."');",$get_content);
    file_put_contents($mk_dir,$new_content);
    echo "Added to Meta Keys<br>";
}


//Update Field
if($action == "update"){
    //remove column
    $sql = "ALTER TABLE `".$rectype."` CHANGE `". $field_name . "` `".$new_name."` TEXT NOT NULL";
    $pdo->exec($sql);
    echo "Updated Database<br>";
    //remove from meta_keys
    $mk_dir = "../wsp_rad/meta_keys.php";
    //Replace contents        
    $get_content = file_get_contents($mk_dir);
    $new_content = str_replace($field_name,$new_name,$get_content);
    file_put_contents($mk_dir,$new_content);
    echo "Updated Meta Keys<br>";
}


//Remove Field
if($action == "remove"){
    //remove column
    $sql = "ALTER TABLE `".$rectype."` DROP `".$field_name."`";
    $pdo->exec($sql);
    echo "Removed from Database<br>";
    //remove from meta_keys
    $mk_dir = "../wsp_rad/meta_keys.php";
    //Replace contents    
    $get_content = file_get_contents($mk_dir);
    $new_content = str_replace(",'".$field_name."'","",$get_content);
    file_put_contents($mk_dir,$new_content);
echo "Removed from Meta Keys<br>";
}

            }
            ?>
        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});
</script>
<?php include("footer.php"); ?>