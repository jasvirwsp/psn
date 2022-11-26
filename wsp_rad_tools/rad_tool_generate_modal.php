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
    <style>
.select_this{margin:20px 0;width:100%;}
.enter_field{width:100%;font-size:30px;font-weight:bold;font-family:Helvetica}
.col-sm-6{display:inline-block}
</style>
</head>

<body>
<div class="container-fluid">
<form method="post" action="" id="form_api">
        <div class="form-group">
         <label for="api_name">Record Type</label>
        <input type="text" class="form-control" placeholder="Name"  name="api_name">
            </div>            

        <input type="submit" class="btn btn-success btn-lg insert_api" value="Create Modal Code"> 
        </form>
<?php
// Create API Folder

if(isset($_POST["api_name"]) && ($_POST["api_name"] != "")){
$api_name = $_POST["api_name"];
$restricted_names = array("file_upload","user","option");
if(in_array($api_name,$restricted_names)){
    echo $api_name . " is reserved name.Please chose another API name";
    exit();
}
?>
<br>
<h2>Create Modal Trigger</h2>

<textarea class="select_this" rows="5">
&lt;!-- Button trigger modal --&gt;
&lt;button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#<?php echo 'add_'.$api_name;?>"&gt;
  Add <?php echo beautify_meta_name($api_name); ?>
&lt;/button&gt;
</textarea>

<h2> Modal Code</h2>
<textarea class="select_this" rows="10">
&lt;!-- <?php echo beautify_meta_name('add_'.$api_name); ?> Modal Start--&gt;
&lt;div class="modal fade" id="<?php echo 'add_'.$api_name;?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo 'add_'.$api_name;?>_LongTitle" aria-hidden="true"&gt;
  &lt;div class="modal-dialog" role="document"&gt;
    &lt;div class="modal-content"&gt;
      &lt;div class="modal-header"&gt;
        &lt;h5 class="modal-title" id="exampleModalLongTitle"&gt;<?php echo beautify_meta_name('add_'.$api_name); ?>&lt;/h5&gt;
        &lt;button type="button" class="close" data-dismiss="modal" aria-label="Close"&gt;
          &lt;span aria-hidden="true"&gt;×&lt;/span&gt;
        &lt;/button&gt;
      &lt;/div&gt;
      &lt;div class="modal-body"&gt;
        ...
      &lt;/div&gt;
      &lt;div class="modal-footer"&gt;
        &lt;button type="button" class="btn btn-secondary" data-dismiss="modal"&gt;Close&lt;/button&gt;
              &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;
&lt;!-- <?php echo beautify_meta_name('add_'.$api_name); ?> Modal Ends--&gt;
</textarea>
<h2>Hide with jquery/js</h2>
<textarea class="select_this">
$('#<?php echo 'add_'.$api_name;?>').modal('hide');
</textarea>
<?php 
} ?>

</div>
<!-- Container ends -->

 <!--   Core JS Files   -->
 <script src="wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>

$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});

</script>
</body>