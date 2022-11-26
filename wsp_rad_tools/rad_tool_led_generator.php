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
         <label for="api_name">Input Name</label>
        <input type="text" class="form-control" placeholder="Name"  name="api_name">
            </div>            

        <input type="submit" class="btn btn-success btn-lg insert_api" value="Generate"> 
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
<h2>LED Generator for input name <?php echo $api_name; ?></h2>

<h2> Hidden Input</h2>
<textarea class="select_this" rows="1">
&lt;input type="hidden" class="form-control <?php echo $api_name; ?>_tube_light" name="<?php echo $api_name; ?>"&gt;
</textarea>

<h2> Generate buttons as below with dynamic loop of different values. Button should have value <?php echo $api_name; ?>_led_on class</h2>
<textarea class="select_this" rows="5">
&lt;?php 
                $record_type = ""; //Edit this as per requirements.
                $where_array = array(""=&gt;""); //edit this as per requirement
                $all_recs = $records_fetch_controller-&gt;fetch_record_with_where([$record_type,$where_array]);
                foreach($all_recs as $single_rec){
                    $rec_meta = get_rec_meta_by_rec_id($record_type,$single_rec["record_id"]);
             ?&gt;
             &lt;button type="button" class="btn btn-default <?php echo $api_name; ?>_led_on btn-sm" led_value="&lt;?php echo $single_rec["record_id"]; ?&gt;"&gt;&lt;?php echo get_single_value($rec_meta,"") ?&gt;&lt;/button&gt;
                &lt;?php } ?&gt;
</textarea>
<h2>JS Code</h2>
<textarea class="select_this" rows="30">
//Led bulb to tubelight for <?php echo $api_name; ?>
// ON class = <?php echo $api_name; ?>_led_on , OFF class = <?php echo $api_name; ?>_led_off
var ltt_<?php echo $api_name; ?> = "<?php echo $api_name; ?>";
var led_on_class_<?php echo $api_name; ?> = "." + ltt_<?php echo $api_name; ?> + "_led_on";
var led_on_class_<?php echo $api_name; ?>_nd = ltt_<?php echo $api_name; ?> + "_led_on"; // No dot class name
var led_off_class_<?php echo $api_name; ?> = "." + ltt_<?php echo $api_name; ?> + "_led_off";
var led_off_class_<?php echo $api_name; ?>_nd = ltt_<?php echo $api_name; ?> + "_led_off"; // No dot class name
var tube_light_class_<?php echo $api_name; ?> = "." + ltt_<?php echo $api_name; ?> + "_tube_light";
var led_separator_<?php echo $api_name; ?> = "~|~";

//On LED ON Click
$(document).on("click",led_on_class_<?php echo $api_name; ?>,function(){
      //$(this).text("Any text change if you want on click");
      $(this).addClass("btn-success " + led_off_class_<?php echo $api_name; ?>_nd);
      $(this).removeClass("btn-default " + led_on_class_<?php echo $api_name; ?>_nd);

      
      var user_selected_leds_<?php echo $api_name; ?> = "";
       
      //Get all selected options
      $(led_off_class_<?php echo $api_name; ?>).each(function() {     
         var led_value = $(this).attr("led_value");
         user_selected_leds_<?php echo $api_name; ?> = user_selected_leds_<?php echo $api_name; ?> + led_separator_<?php echo $api_name; ?> + led_value;
   });

   //Put them in tubelight
     $(tube_light_class_<?php echo $api_name; ?>).val(user_selected_leds_<?php echo $api_name; ?>.substring(led_separator_<?php echo $api_name; ?>.length));
            
});

//On LED OFF Click
$(document).on("click",led_off_class_<?php echo $api_name; ?>,function(){
    // $(this).text("Any text change if you want on click");
      $(this).addClass("btn-default " + led_on_class_<?php echo $api_name; ?>_nd);
      $(this).removeClass("btn-success " + led_off_class_<?php echo $api_name; ?>_nd);

      var user_selected_leds_<?php echo $api_name; ?> = "";      
    
    //Get all selected options
       $(led_off_class_<?php echo $api_name; ?>).each(function() {     
         var led_value = $(this).attr("led_value");
         user_selected_leds_<?php echo $api_name; ?> = user_selected_leds_<?php echo $api_name; ?> + led_separator_<?php echo $api_name; ?> + led_value;
   });

   //Put them in tubelight
     $(tube_light_class_<?php echo $api_name; ?>).val(user_selected_leds_<?php echo $api_name; ?>.substring(led_separator_<?php echo $api_name; ?>.length));

});
// LED to Tubelight Ends
</textarea>
<h2> For edit page add below code with above code.</h2>
<textarea class="select_this" rows="5">
// For Edit page

var db_leds_<?php echo $api_name; ?> = '425~|~426'; // this should have db value
if(db_leds_<?php echo $api_name; ?> != ""){
  var db_leds_array_<?php echo $api_name; ?> = db_leds_<?php echo $api_name; ?>.split(led_separator_<?php echo $api_name; ?>);
  $.each(db_leds_array_<?php echo $api_name; ?>,function(index,value){
    $("button[led_value='"+value+"']").trigger("click");
});
}</textarea>
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