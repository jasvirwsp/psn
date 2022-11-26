<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>WSP RAD</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!-- Bootstrap core CSS     -->
    <link href="../wsp_rad/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container-fluid">

<?php
// Create API Folder

if(isset($_POST["api_name"]) && ($_POST["api_name"] != "")){
$api_name = $_POST["api_name"];
$restricted_names = array("file_upload","user","option");
if(in_array($api_name,$restricted_names)){
    echo $api_name . " is reserved name.Please chose another API name";
    exit();
}
$api_folder = "../api";
if(file_exists($api_folder)){
    echo "Main API Folder Exisits. Trying user API folder . Please Refresh<br>";
    if(file_exists($api_folder."/".$api_name)){
        echo "<span style='color:red;'>User API Folder Already Exisits. Probably files too.</span>.<br>";    
        // Create Insert File
        $open_file = fopen($api_folder."/".$api_name."/insert_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/insert_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Create Update File
        $open_file = fopen($api_folder."/".$api_name."/update_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/update_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Create Delete File
        $open_file = fopen($api_folder."/".$api_name."/delete_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/delete_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Create Fetch Single File
        $open_file = fopen($api_folder."/".$api_name."/fetchSingle_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/fetchSingle_api.php");
        fwrite($open_file,$data);
        fclose($open_file);
        //Create Fetch All File
        $open_file = fopen($api_folder."/".$api_name."/fetchAll_".$api_name.".php","w");

        echo "Files Created. API Ready to use<br>";
        echo "Creating Tables<br>";

        //Create tables
        $record_type = $api_name;
$record_type_meta = $record_type . "_meta";


//Record table
$sql = file_get_contents('../wsp_rad/default_api/sql/records.sql');

$sql = str_replace("records",$record_type,$sql);

$mysqli = new mysqli($mysql_db_hostname, $mysql_db_username, $mysql_db_password, $mysql_db_dbname);
if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "Records Table Created<br>";
} else {
   echo "error";
}



// Record Meta table
$sql = file_get_contents('../wsp_rad/default_api/sql/records_meta.sql');

$sql = str_replace("records_meta",$record_type_meta,$sql);

$mysqli = new mysqli($mysql_db_hostname, $mysql_db_username, $mysql_db_password, $mysql_db_dbname);
if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "Records Meta Table Created<br>";
} else {
   echo "error";
}
//create tables
echo "All good to go"; 
    }else{
        mkdir("../api/".$api_name);
    }
}else{
    mkdir("api");
    echo "API Folder Created. Please Refresh. Press continue if asked. <br>";
}

}else{
   ?>
        <form method="post" action="" id="form_api">
        <div class="form-group">
         <label for="api_name">Record Type</label>
        <input type="text" class="form-control" placeholder="Record Type"  name="api_name">
            </div>            

        <input type="submit" class="btn btn-success btn-lg insert_api" value="Create API"> 
        </form>

<?php } ?>

</div>
<!-- Container ends -->

 <!--   Core JS Files   -->
 <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>

</script>
</body>