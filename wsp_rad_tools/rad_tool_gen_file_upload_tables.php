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
$restricted_names = array("user","option");
if(in_array($api_name,$restricted_names)){
    echo $api_name . " is reserved name.Please chose another API name";
    exit();
}
$api_folder = "../api";
if(file_exists($api_folder)){
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
}
else{
   ?>
        <form method="post" action="" id="form_api">
        <div class="form-group">
         <label for="api_name">Record Type</label>
        <input type="text" class="form-control" placeholder="Record Type"  name="api_name" value="file_upload">
            </div>            

        <input type="submit" class="btn btn-success btn-lg insert_api" value="Create Tables"> 
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