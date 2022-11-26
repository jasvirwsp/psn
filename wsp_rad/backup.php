<?php
header('Content-Type: application/json');
include ("wsp_rad.inc.php");
include ('libs/backup_engine.php');
$folder = "backups/";
$backup_name = "backup_".date('Y-m-d');
try {	
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => $mysql_db_hostname,
		'username' => $mysql_db_username,
		'password' => $mysql_db_password,
        'db_name' => $mysql_db_dbname,
	));
	$world_dumper->dump($folder.$backup_name.'.sql.gz');
	if($world_dumper){
	$response = array("status"=>"success","message"=>"Backup Success","url"=>"wsp_rad/".$folder.$backup_name.'.sql.gz');
	$response = json_encode($response);
	print_r($response);
	//Send Mail
	//$wsp_mailer->send_mail("ghulianisikh@gmail.com","DB Backup","Backup Successful of ".$webapp_url,$folder.$backup_name.'.sql.gz');
	}
} catch(Shuttle_Exception $e) {
	$response = array("status"=>"failure","message"=>$e->getMessage());
	$response = json_encode($response);
	print_r($response);
}