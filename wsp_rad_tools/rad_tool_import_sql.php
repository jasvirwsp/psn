<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php

if(isset($_GET["file_name"])){
$file_name = $_GET["file_name"];
$sql = file_get_contents($file_name);

$mysqli = new mysqli($mysql_db_hostname, $mysql_db_username, $mysql_db_password, $mysql_db_dbname);
if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "success";
} else {
   echo "error".mysqli_error($mysqli);
}
}else{
    echo "Please set get parameter file_name with sql file name";
}
?>