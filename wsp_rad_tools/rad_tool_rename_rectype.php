<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Rename Rec Type</title>
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
                                    
                                    <h4 class="page-title">Rename Rec Type</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                                        <!-- type>s>fetch/insert/update/delete,rec_type>i -->

              
                        <!-- end row -->
                        <form method="get" action="" id="form_rectype_rad5ef831f5c072b">   
                        <div class="row">                            
<div class="form-group ic_rectype_existing col-md-5 d-inline-block">
         <label class="rectype_existing" for="rectype_existing">Existing</label>
        <input type="text" class="form-control rectype_existing" placeholder="Existing"  name="rectype_existing" value="<?php echo safe_get('rectype_existing');?>">
            </div>            
<div class="form-group ic_rectype_new col-md-5 d-inline-block">
         <label class="rectype_new" for="rectype_new">New</label>
        <input type="text" class="form-control rectype_new" placeholder="New"  name="rectype_new" value="<?php echo safe_get('rectype_new');?>">
            </div>            
            <div class="form-group ic_rectype_replace_hooks col-md-5 d-inline-block">
             <label class="rectype_replace_hooks" for="rectype_replace_hooks">Replace Hooks File Contents</label>
             <span class="mb-2 w-100 d-block bg-danger text-white">Please note, Hooks contain multiple types of rec types. Make sure you have checked the hooks file if it has any similar rec_type. Example : if you are replacing quote with something, make sure hooks.php doesn't have anything with quote keyword of different rec_type</span>
            <select class="form-control rectype_replace_hooks" name="rectype_replace_hooks">
                    <option value="no">No</option>
                                              <option value="yes">Yes</option>
                                                   </select>
                </div>            
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_rectype" value="Rename Rectype" form_id="rad5ef831f5c072b"> 
        </div>
        </form>


        <div class="response p-4 bg-warning w-100">
<?php 
if(safe_get("rectype_existing") != ""){
    $existing_rectype = safe_get("rectype_existing");
    $new_rectype = safe_get("rectype_new");
    
//Step 1 . Rename>Replace Root Directory Files. 
echo "<h3>Renaming Root Fiels</h3>";
$root_dir = "../";
$root_files = [$existing_rectype.".php","edit_".$existing_rectype.".php","view_".$existing_rectype.".php"];
foreach($root_files as $single_root_file){
    $new_name = str_replace($existing_rectype,$new_rectype,$single_root_file);    
    rename($root_dir.$single_root_file,$root_dir.$new_name);
    //Replace contents    
    $get_content = file_get_contents($root_dir.$new_name);
    $new_content = str_replace($existing_rectype,$new_rectype,$get_content);
    $new_content = str_replace(beautify_meta_name($existing_rectype),beautify_meta_name($new_rectype),$new_content);
    file_put_contents($root_dir.$new_name,$new_content);

    echo $single_root_file . " > ".$new_name . "<br>";
}


//Step 2 . Rename>Replace API Folder and files.
echo "<h3 class='mt-2'>Renaming>Replacing API Files</h3>";
$api_dir = "../api/";
$full_api_dir = "../api/".$existing_rectype."/";
$api_files = [
    "auto_suggest_".$existing_rectype.".php",
    "delete_".$existing_rectype.".php",
    "insert_".$existing_rectype.".php",
    "m.delete_".$existing_rectype.".php",
    "m.fetch_".$existing_rectype.".php",
    "m.fetch_single_".$existing_rectype.".php",
    "m.insert_".$existing_rectype.".php",
    "m.update_".$existing_rectype.".php",
    "update_".$existing_rectype.".php"];
foreach($api_files as $single_api_file){
    $new_name = str_replace($existing_rectype,$new_rectype,$single_api_file);    
    rename($full_api_dir.$single_api_file,$full_api_dir.$new_name);
    //Replace contents    
    $get_content = file_get_contents($full_api_dir.$new_name);
    $new_content = str_replace($existing_rectype,$new_rectype,$get_content);
    $new_content = str_replace(beautify_meta_name($existing_rectype),beautify_meta_name($new_rectype),$new_content);
    file_put_contents($full_api_dir.$new_name,$new_content);
    
    echo $single_api_file . " > ".$new_name . "<br>";
}
//Rename Directory
rename($api_dir.$existing_rectype,$api_dir.$new_rectype);


//Step 3 . Update Meta Key File
echo "<h3 class='mt-2'>Renaming>Update Meta Key File</h3>";
$mk_dir = "../wsp_rad/meta_keys.php";
    //Replace contents    
    $get_content = file_get_contents($mk_dir);
    $new_content = str_replace($existing_rectype,$new_rectype,$get_content);
    file_put_contents($mk_dir,$new_content);
    echo $existing_rectype . " > ".$new_rectype . "<br>";

  

//Step 4 . New table and remove existing
echo "<h3 class='mt-2'>Create New Table and Columns</h3>";
//Table Name Update
$meta_keys_array_name = "meta_keys_of_".$new_rectype;
$meta_keys_array = $$meta_keys_array_name;
//unset Record it
$key = array_search("record_id", $meta_keys_array);
unset($meta_keys_array[$key]);
array_push($meta_keys_array,"date_created","date_updated",$new_rectype."_insert_author");

    $meta_names = "";
    foreach($meta_keys_array as $single_key){
    $meta_names = $meta_names . $single_key . " TEXT NOT NULL,";
    };
    $meta_names = trim($meta_names,",");
    $sql = "CREATE TABLE $new_rectype(record_id INT(255) AUTO_INCREMENT PRIMARY KEY,".$meta_names.")";
    echo $sql;
    $pdo->exec($sql);
echo "Table Created with New Columns<br>";
$sql = "DROP table ".$existing_rectype;
$pdo->exec($sql);
echo "Existing Table Deleted";

if(safe_get("rectype_replace_hooks") == "yes"){
//Step 5 . Update Hooks File
echo "<h3 class='mt-2'>Renaming>Update Hooks File</h3>";
$hooks_dir = "../hooks.php";
    //Replace contents    
    $get_content = file_get_contents($hooks_dir);
    $new_content = str_replace($existing_rectype,$new_rectype,$get_content);
    file_put_contents($hooks_dir,$new_content);
    echo $existing_rectype . " > ".$new_rectype . "<br>";  
}

}
?>

        </div>
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