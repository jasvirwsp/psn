<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Auto Suggest</title>
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
            <label for="api_name">Meta Name</label>
        <input type="text" class="form-control" placeholder="Name"  name="meta_name">
            </div> <br>
        <input type="submit" class="btn btn-success btn-lg insert_api" value="Generate"> 
        </form>
<?php
// Create API Folder

if(isset($_POST["api_name"]) && ($_POST["api_name"] != "")){
$api_name = $_POST["api_name"];
$meta_name = $_POST["meta_name"];
$restricted_names = array("file_upload","user","option");
if(in_array($api_name,$restricted_names)){
    echo $api_name . " is reserved name.Please chose another API name";
    exit();
}
?>
<br><br>
<h2>Auto Suggestion code for <?php echo $api_name; ?></h2>

<h2>CSS File to include</h2>
<textarea class="select_this" rows="5">
&lt;link href="wsp_rad/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" /&gt;
</textarea>

<h2>Javscript File</h2>
<textarea class="select_this" rows="5">
&lt;script src="wsp_rad/assets/js/jquery-ui.js"&gt;&lt;/script&gt;
</textarea>

<h3>Add class and autocomplete off to input</h3>
<textarea class="select_this" rows="1">
 auto_suggestions_<?php echo $meta_name; ?>" autocomplete="off</textarea>

<h3>Add CSS</h3>
<textarea class="select_this" rows="10">
&lt;style&gt;
.ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;        
    background-color:#007f8e;   
  }

.ui-autocomplete li{
    font-weight:bold;
    font-size:16px;
    font-family: Muli,sans-serif;
    color:#fff;
}
&lt;/style&gt;
</textarea>

<h3>Add Javascript</h3>
<textarea class="select_this" rows="40">
// Auto suggestion for <?php echo $meta_name; ?>

var as_input_name_<?php echo $meta_name; ?> = "<?php echo $meta_name; ?>";
var record_type_<?php echo $meta_name; ?> = "<?php echo $api_name; ?>";


$(document).on("focus",".auto_suggestions_"+as_input_name_<?php echo $meta_name; ?>,function(){

$(this).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "api/"+record_type_<?php echo $meta_name; ?>+"/auto_suggest_"+record_type_<?php echo $meta_name; ?>+".php",
          dataType: "json",
          data: {
            search_input_value : request.term,
            search_input_name: record_type_<?php echo $meta_name; ?>
          },
          success: function( data ) {            
            response( data );          

          }
        } );
      },
      minLength: 1
    });

});
//Auto suggestion ends 
</textarea>

<h3>PHP Code ( Create auto_suggest_record_type.php in api>record_type) . Replace meta_name and return_meta_name_array with desired values.</h3>
<textarea class="select_this" rows="40">
&lt;?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");
$meta_name = safe_get("search_input_name");
$meta_value = safe_get("search_input_value");

$record_type = $meta_name;

$return_array = array();

$search_fields_array = array("");

$return_record_id = true;
$return_meta_name_array = array("");

foreach($search_fields_array as $single_field){

$where_array = array($single_field." LIKE ?"=&gt;"%".$meta_value."%");
$options_array = array("limit"=&gt;20);
$get_suggestions = $records_fetch_controller-&gt;fetch_record_with_where([$record_type,$where_array,$options_array]);

foreach($get_suggestions as $single_suggestion){
    $get_rec_meta = get_rec_meta_by_rec_id($record_type,$single_suggestion["record_id"]);
    $this_return_value = "";
    if($return_record_id){
        $this_return_value = $single_suggestion["record_id"];
    }
    foreach($return_meta_name_array as $single_return){
    
    $this_return_value = $this_return_value . " | ". get_single_value($get_rec_meta,$single_return);
}
    $return_array[] = ltrim($this_return_value," | ");
}
}

$filter = array_unique($return_array);
$response = json_encode($filter);
print_r($response);
?&gt;
</textarea>

<h3>Split Values</h3>
<textarea class="select_this" rows="5">
//On focus out of auto suggestion
$(document).on("focusout",".auto_suggestions_<?php echo $meta_name;?>",function(){
    var complete_value = $(this).val();
    var split_value_array = complete_value.split(" | ");   
    $(this).val(split_value_array[0]);
    
});
</textarea>
<?php 
} ?>

</div>
<!-- Container ends -->

 <!--   Core JS Files   -->
 <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>

$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});

</script>
</body>