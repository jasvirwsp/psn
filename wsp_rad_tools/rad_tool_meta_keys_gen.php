<?php 
header("X-XSS-Protection: 0");
$unique_id = uniqid("rad");
?>
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
<style>
.select_this{margin:20px 0;width:90%;}
.enter_field{width:100%;font-size:30px;font-weight:bold;font-family:Helvetica}
.col-sm-6{display:inline-block}
</style>
</head>

<body>
<div class="container-fluid">
<form method="post" action="">
<label>Record Type</label>
<input type="text" name="record_type" placeholder="Record Type" class="enter_field form-control"><br>
<br>
<label>Paste Form</label>
<textarea class="enter_field form-control" name="inputs_to_generate" rows="10" placeholder="Enter Input Names Separatedy by , comma" cols="20"></textarea>
<br>
<input type="submit" class="btn btn-info">
</form>
<br>
<?php if(isset($_POST["inputs_to_generate"])){
$rec_type = $_POST["record_type"];
    $contents = $_POST["inputs_to_generate"];
    preg_match_all('/name="(\w+)"/',$contents,$result);
    $meta_keys_array = "'record_id',";
    foreach($result[0] as $single_ip){
        $t= trim(substr($single_ip,6),'"');
        $meta_keys_array = $meta_keys_array . "'" . $t."',";
    }
    ?>
<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-6">
        
<h3>Meta Keys Array</h3>
<textarea class="select_this form-control" cols="10" rows="5">
$meta_keys_of_<?php echo $rec_type;?> = array(<?php echo trim($meta_keys_array,",");?>);
</textarea>
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
        <div class="col-sm-6">
        
        </div>
<!-- Col 2 ends -->

         </div>
<!-- Row Ends -->
<?php } ?>
</div>
<!-- Container ends -->
<script src="wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});
</script>
</body>
</html>