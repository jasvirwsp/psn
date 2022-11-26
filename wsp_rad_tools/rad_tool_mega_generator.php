<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Mega Gen</title>
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
<input type="text" name="record_type" placeholder="Record Type" class="enter_field form-control" value="<?php if(isset($_POST["record_type"])) { echo $_POST["record_type"]; }?>"><br>
<br>
<label>1. Inputs to generate(example name>i [name is input name and i is input,<br> 2.You can use h for hidden and s for select(for options use another delimited ">" and put options with slashes option1/option1)], <br>3.Separate inputs with comma<br> 4.To get input type number put name>i>n <br> 5. For custom date give input name "custom_date". <br> 6. for radio test>r>Gender>M/F/O and for inline test>r>Gender>M/F/O>inline<br> 6. for radio test>r>Main Title>value1/value2 and for inline test>r>Main Title>value1/value2>inline <br> 7. for checkbox test>c>Main Title>value1/value2 and for inline test>c>Main Title>value1/value2</label>
<textarea class="enter_field form-control" name="inputs_to_generate" rows="5" placeholder="Enter Input Names Separatedy by , comma" cols="20"><?php if(isset($_POST["inputs_to_generate"])) { echo $_POST["inputs_to_generate"]; }?></textarea>
<br>

<input type="submit" class="btn btn-info">
</form>
<br>
<?php 
$mega_gen_input_form = "";
$mega_gen_update_form = "";
$mega_gen_input_javascript = "";
if(isset($_POST["inputs_to_generate"])){
    $col_class= "col-md-6 d-inline-block";
$inputs = $_POST["inputs_to_generate"];
$inputs = preg_replace("/\r|\n/", "", $inputs);
$explode_inputs = explode(",",$inputs);
$record_type = $_POST["record_type"] . "_";
$rec_type = $_POST["record_type"];
$inputs_count = count($explode_inputs);

?>
<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-6" style="width:49%;">
        <?php
$meta_keys_array = "'record_id',";
foreach($explode_inputs as $input_name){
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];    
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));
    
    $meta_keys_array = $meta_keys_array . "'" . $html_name."',";
?>


<?php if($type == "i"){
    @$sub_type = $explode_type[2];
$sub_type_html = "text";
if(isset($sub_type)){
if($sub_type == "n"){
    $sub_type_html = "number";
}
if($sub_type == "p"){
    $sub_type_html = "password";
}
if($sub_type == "e"){
    $sub_type_html = "email";
}
if($sub_type == "d"){
    $sub_type_html = "date";
}
}else{
    $sub_type_html = "text";
}
    ?>
    
    <?php } ?>
           
<?php }
?>
<?php } ?>
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
        <div class="col-sm-6" style="width:49%">
        
        <?php
        if(isset($_POST["inputs_to_generate"])){ ?>
        <?php $mega_gen_input_form = '&lt;!-- '.$inputs.' --&gt'; ?>

        <?php $mega_gen_input_form .= '&lt;!-- Form Row Starts --&gt;
        &lt;form method="post" action="" id="form_'.$rec_type.'_'.$unique_id.'" class="w-100"&gt;
        &lt;div class="row"&gt;';        
        ?>
<?php
$how_many_columns = 3;
$col_size = 12/$how_many_columns;

foreach($explode_inputs as $input_name){
    
    
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));    
?>
<?php if($type == "i"){     
    @$sub_type = $explode_type[2];
$sub_type_html = "text";
if(isset($sub_type)){
if($sub_type == "n"){
    $sub_type_html = "number";
}
if($sub_type == "p"){
    $sub_type_html = "password";
}
if($sub_type == "e"){
    $sub_type_html = "email";
}
if($sub_type == "d"){
    $sub_type_html = "date";
}
}else{
    $sub_type_html = "text";
}
    ?>
 <?php $mega_gen_input_form .= '
 &lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
         &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;input type="'.$sub_type_html.'" class="form-control '.$html_name.'" placeholder="'.$human_readable.'"  name="'.$html_name.'"&gt;
            &lt;/div&gt;'; ?><?php } ?>
<?php if($type == "h"){ ?>
    <?php $mega_gen_input_form .= '
    &lt;input type="hidden" class="form-control '.$html_name.'" name="'.$html_name.'"&gt;';?> <?php } ?>
<?php if($type == "t"){ ?>
    <?php $mega_gen_input_form .= '
    &lt;div class="form-group ic_'.$html_name.' col-sm-6 d-inline-block align-top"&gt;
         &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;textarea class="form-control '.$html_name.'" placeholder="'.$human_readable.'" name="'.$html_name.'"&gt;&lt;/textarea&gt;
        &lt;/div&gt;';?> <?php } ?>
<?php if($type == "s"){
   $get_options = explode("/",$explode_type[2]);    
    ?>
      <?php $mega_gen_input_form .= '
      &lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
            &lt;select class="form-control '.$html_name.'" name="'.$html_name.'"&gt;';?>
            <?php foreach($get_options as $single_option){ 
                $human_readable = ucwords(str_replace("_"," ",$single_option));
                if($single_option == "select"){
                    $single_option = "";
                }
                ?>
        <?php $mega_gen_input_form .= '
        &lt;option value="'.$single_option.'"&gt;'.$human_readable.'&lt;/option&gt;';?>
                                      <?php } ?>            <?php $mega_gen_input_form .= '
                                      &lt;/select&gt;
                &lt;/div&gt;';?><?php } ?>
                 <?php if ($type == "r") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?>
                    <?php $mega_gen_input_form .= '&lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="'.$html_name.'" for="'.$html_name.'"&gt;'.$radio_label.'&lt;/label&gt;  &lt;/br&gt;';    
            foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            $mega_gen_input_form .= '&lt;div class="form-check'.$inline_yes.'"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="radio" name="'.$html_name.'" value="'.$single_option.'"&gt;'.$human_readable.' 
            &lt;/label&gt; 
            &lt;/div&gt;';
            };
            $mega_gen_input_form .= '&lt;/div&gt;'; } ?>
            <?php if ($type == "c") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?><?php $mega_gen_input_form .= '&lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="'.$html_name.'" for="'.$html_name.'"&gt;'.$radio_label.'&lt;/label&gt;  &lt;/br&gt;';?>
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?><?php $mega_gen_input_form .= '&lt;div class="form-check'.$inline_yes.'"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="checkbox" name="'.$html_name.'[]" value="'.$single_option.'"&gt;'.$human_readable.' 
            &lt;/label&gt; 
            &lt;/div&gt;';?>
            <?php } ?><?php $mega_gen_input_form.='&lt;/div&gt;'?> <?php } ?>              
<?php }
?>
         <?php $mega_gen_input_form .= '
        
        &lt;div class="form-group col-md-12"&gt;
        &lt;input type="submit" class="btn btn-success btn-sm insert_'.$rec_type.'" value="Add '.beautify_meta_name($rec_type).'" form_id="'.$unique_id.'"&gt; 
        &lt;/div&gt;
        &lt;/form&gt;
        &lt;/div&gt;
        &lt;!-- Form Row Ends --&gt;';?>
        <?php } ?>
        
       <?php $mega_gen_input_javascript = '
        //Insert variables
        var insert_button_class_'.$rec_type.' = ".insert_'.$rec_type.'"; // .classname
                var form_id_'.$rec_type.' = "#form_'.$rec_type.'";  // #entry_form
                var insert_api_url_'.$rec_type.' = "api/'.$rec_type.'/insert_'.$rec_type.'.php"; // /api/insert.php
                var form_id_parameter_name = "form_id";
                
                //Insert Operation
                $(document).on("click",insert_button_class_'.$rec_type.',function(e){                
                e.preventDefault();
                //Processing
                swal("Processing","Please Wait","warning");
                //Processing
                var form_to_process_'.$rec_type.' = form_id_'.$rec_type.' + "_" + $(this).attr(form_id_parameter_name);
        
                $.post(insert_api_url_'.$rec_type.',$(form_to_process_'.$rec_type.').serializeArray(),function(data){
        
                    var response_json_'.$rec_type.' = data;
        
                    if(response_json_'.$rec_type.'["status"] == "failure"){
                  var get_errors_'.$rec_type.' = response_json_'.$rec_type.'["errors"];
                  var errors_returned_'.$rec_type.' = "";
                  $(get_errors_'.$rec_type.').each(function(index,value){
                    errors_returned_'.$rec_type.' = errors_returned_'.$rec_type.' + " => " + value;
                        
                    });
                    swal("Error",errors_returned_'.$rec_type.', {
              icon: "error"
            });
        
                    }else{
                    
        
                        //Reset Form
                    // $(form_to_process_'.$rec_type.')[0].reset();
        
                    //Focus to first input
                    $(form_to_process_'.$rec_type.' + " input[type=text]").first().focus();
        
                    //To show updated values on same page
                    // $(updated_data_container_class).load(updated_data_file_url);
        
        
                    // Other functions to execure on success
                        
                    
//Customized buttons
var entry_id_'.$rec_type.' = response_json_'.$rec_type.'["record_id"];
var customized_content_'.$rec_type.' = document.createElement("div");
customized_content_'.$rec_type.'.innerHTML = "<a href='."'".'edit_'.$rec_type.'.php?'.$rec_type.'_id="+entry_id_'.$rec_type.'+"'."'".' class='."'".'btn btn-sm btn-warning mt-1'."'".'>Edit '.beautify_meta_name($rec_type).'</a> <a href='."'".'#'."'".' onclick='."'".'location.reload()'."'".' class='."'".'btn btn-sm btn-warning mt-1'."'".'>Add New '.beautify_meta_name($rec_type).'</a> <!--<a href='."'".'#'."'".' class='."'".'btn btn-sm btn-success mt-1'."'".'>Another Action</a> <a href='."'".'#'."'".' class='."'".'btn btn-sm btn-info mt-1'."'".'>Another Action</a> --><br><br><a href='."'".'#'."'".' onclick='."'".'var loc = location.href.replace(location.hash,\"\");window.location.assign(loc);'."'".' class='."'".'btn btn-sm btn-danger'."'".'>Close & Refresh</a> <a href='."'".'#'."'".' onclick='."'".'swal.close()'."'".' class='."'".'btn btn-sm btn-danger'."'".'>X</a>";
swal({
    title: "Success",
    text: "Choose next action",
  content: customized_content_'.$rec_type.',
  buttons: false,
  icon : '."'".'success'."'".',
});
//Customized buttons

                         }
        
        
        
                });// .post function ends
        
            });//Insert function ends';?>
  
        
        <?php
        if(isset($_POST["inputs_to_generate"])){ ?>
        <?php $mega_gen_update_form .= '&lt;!-- Form Row Starts --&gt;
        &lt;form method="post" action="" id="form_update_'.$rec_type."_".$unique_id.'" class="w-100"&gt;
        &lt;div class="row"&gt;        
        &lt;?php $rec_id = safe_get("'.$rec_type.'_id");
        $record_type = "'.$rec_type.'";
        //Permission Check
        check_record_ownership("fetch",$user_id, $user_role, $record_type, $rec_id);
        //Permission Check
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?&gt;
        &lt;input type="hidden" name="record_id" value="&lt;?php echo $rec_id; ?&gt;">'; ?>
<?php
$how_many_columns = 3;
$col_size = 12/$how_many_columns;

foreach($explode_inputs as $input_name){
    $col_class= "col-md-6 d-inline-block";
    
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));    
?>
<?php if($type == "i"){ 
    @$sub_type = $explode_type[2];
    $sub_type_html = "text";
    if(isset($sub_type)){
    if($sub_type == "n"){
        $sub_type_html = "number";
    }
    if($sub_type == "p"){
        $sub_type_html = "password";
    }
    if($sub_type == "e"){
        $sub_type_html = "email";
    }
    if($sub_type == "d"){
        $sub_type_html = "date";
    }
    }else{
        $sub_type_html = "text";
    }    
    ?>

<?php $mega_gen_update_form .= '
&lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
         &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;input type="'.$sub_type_html.'" class="form-control '.$html_name.'" placeholder="'.$human_readable.'" name="'.$html_name.'" value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;"&gt;
            &lt;/div&gt;';?><?php } ?>
<?php if($type == "h"){ ?>
    <?php $mega_gen_update_form .= '
    &lt;input type="hidden" class="form-control '.$html_name.'" name="'.$html_name.'" value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;"&gt;';?> <?php } ?>
<?php if($type == "t"){ ?>
    <?php $mega_gen_update_form .= '
    &lt;div class="form-group ic_'.$html_name.' col-sm-6 d-inline-block align-top"&gt;
         &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;textarea class="form-control '.$html_name.'" placeholder="'.$human_readable.'" name="'.$html_name.'"&gt;&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;&lt;/textarea&gt;
        &lt;/div&gt;';?><?php } ?>
<?php if($type == "s"){
   $get_options = explode("/",$explode_type[2]);    
    ?>
      <?php $mega_gen_update_form .= '
      &lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="label_'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
            &lt;select class="form-control db_auto_chose" name="'.$html_name.'" db_auto_chose_value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;"&gt;';?>
            <?php foreach($get_options as $single_option){ 
                $human_readable = ucwords(str_replace("_"," ",$single_option));
                if($single_option == "select"){
                    $single_option = "";
                }
                ?>
        <?php $mega_gen_update_form .= '
        &lt;option value="'.$single_option.'"&gt;'.$human_readable.'&lt;/option&gt;'; ?>
                                      <?php } ?>            <?php $mega_gen_update_form .= '
                                      &lt;/select&gt;';?>
                                      <?php $mega_gen_update_form .= '
                                      &lt;/div&gt;';?><?php } ?>    
                                      <?php if ($type == "r") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?><?php $mega_gen_update_form .= '&lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="'.$html_name.' db_radio_check" db_radio_check_value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;" for="'.$html_name.'"&gt;'.$radio_label.'&lt;/label&gt;  &lt;/br&gt;';?>    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?><?php $mega_gen_update_form .='&lt;div class="form-check'.$inline_yes.'"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="radio" name="'.$html_name.'" value="'.$single_option.'"&gt;'.$human_readable.'
            &lt;/label&gt; 
            &lt;/div&gt;';?>
            <?php } ?>           
                <?php $mega_gen_update_form .= '&lt;/div&gt;';?><?php } ?>     
                <?php if ($type == "c") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?><?php $mega_gen_update_form .= '&lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="'.$html_name.' db_checkbox_check" db_checkbox_check_value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;" for="'.$html_name.'"&gt;'.$radio_label.'&lt;/label&gt;  &lt;/br&gt;';?>    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?><?php $mega_gen_update_form .= '&lt;div class="form-check'.$inline_yes.'"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="checkbox" name="'.$html_name.'[]" value="'.$single_option.'"&gt;'.$human_readable.' 
            &lt;/label&gt; 
            &lt;/div&gt;';?>
            <?php } ?>           
                <?php $mega_gen_update_form .= '&lt;/div&gt;' ?><?php } ?>          
<?php }
?>
       <?php $mega_gen_update_form .= '
       &lt;div class="form-group col-md-12"&gt;
       
        &lt;input type="submit" class="btn btn-success btn-sm update_'.$rec_type.'" value="Update '.beautify_meta_name($rec_type).'" form_id="'.$unique_id.'"&gt; 
        &lt;/div&gt;
        &lt;/form&gt;
        &lt;/div&gt;
        &lt;!-- Form Row Ends --&gt;';?>
        <?php } ?>
        </div>
        
<!-- Col 2 ends -->


         </div>
<!-- Row Ends -->
<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-6">
        
<h3>Meta Keys Array</h3>
<textarea class="select_this form-control" cols="10" rows="5">
$meta_keys_of_<?php echo $rec_type;?> = array(<?php echo trim($meta_keys_array,",");?>);
</textarea>

<h3>Create Tables Array <a target="_blank" class="btn btn-sm btn-warning" href="create_tables_automatically.php?do_it=yes&record_type=<?php echo $rec_type;?>&meta_keys=<?php echo str_replace("'","",trim($meta_keys_array,","));?>">Create table now</a></h3>
<textarea class="select_this form-control" cols="10" rows="5">
array(<?php echo trim($meta_keys_array,",");?>);
</textarea>

<h3>Navigation Button</h3>
<textarea class="select_this form-control" cols="10" rows="5">
&lt;li&gt;
                                &lt;a href="<?php echo $rec_type;?>.php"&gt;
                                    &lt;i class="fe-arrow-right-circle"&gt;&lt;/i&gt;                                  
                                    &lt;span&gt;<?php echo beautify_meta_name($rec_type);?>&lt;/span&gt;
                                &lt;/a&gt;
                            &lt;/li&gt;
</textarea>

        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
        <div class="col-sm-6">
        
        </div>
<!-- Col 2 ends -->

         </div>
<!-- Row Ends -->

</div>
<!-- Container ends -->
<script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});
</script>

<?php 
if(isset($_POST["inputs_to_generate"])){
    echo "Results<br>";
$data = file_get_contents("rad_tool_mega_gen_layout.php");
$open_file = fopen("../".$rec_type.".php","w");
$data = str_replace("{{mega_gen_record_type}}",$rec_type,$data);
$data = str_replace("{{mega_gen_insert_form}}",$mega_gen_input_form,$data);
$data = str_replace("&lt;","<",$data);
$data = str_replace("&gt;",">",$data);
//Replace JS
$data = str_replace("{{mega_gen_insert_javascript}}",$mega_gen_input_javascript,$data);
//Write Data to file
fwrite($open_file,$data);
fclose($open_file);

// Create Update file
$data = file_get_contents("rad_tool_mega_gen_edit_layout.php");
$open_file = fopen("../edit_".$rec_type.".php","w");
$data = str_replace("{{mega_gen_record_type}}",$rec_type,$data);
$data = str_replace("{{mega_gen_update_form}}",$mega_gen_update_form,$data);
$data = str_replace("&lt;","<",$data);
$data = str_replace("&gt;",">",$data);
//Write Data to file
fwrite($open_file,$data);
fclose($open_file);

// Create View file
$data = file_get_contents("rad_tool_mega_gen_view_layout.php");
$open_file = fopen("../view_".$rec_type.".php","w");
$data = str_replace("{{mega_gen_record_type}}",$rec_type,$data);
$data = str_replace("&lt;","<",$data);
$data = str_replace("&gt;",">",$data);
//Write Data to file
fwrite($open_file,$data);
fclose($open_file);

//Create API
$api_name = $rec_type;
if(@$mega_gen_record_type){
    $api_name = $mega_gen_record_type;
}
$restricted_names = array("file_upload","user","option");
if(in_array($api_name,$restricted_names)){
    echo $api_name . " is reserved name.Please chose another API name";
    exit();
}
$api_folder = "../api";
if(file_exists($api_folder)){
    echo "Main API Folder Exisits. Trying user API folder . Please Refresh<br>";
    mkdir("../api/".$api_name);
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
        //Create empty index file
        $open_file = fopen($api_folder."/".$api_name."/index.php","w");        
        $data = "Hard Work is Gold";
        fwrite($open_file,$data);
        fclose($open_file);

        //Mobile APIS
        //Fetch all
        $open_file = fopen($api_folder."/".$api_name."/m.fetch_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.fetch_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Fetch single
        $open_file = fopen($api_folder."/".$api_name."/m.fetch_single_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.fetch_single_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Insert Api
        $open_file = fopen($api_folder."/".$api_name."/m.insert_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.insert_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Update File
        $open_file = fopen($api_folder."/".$api_name."/m.update_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.update_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        //Delete File
        $open_file = fopen($api_folder."/".$api_name."/m.delete_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.delete_api.php");
        $data = str_replace("entered_record_type",$api_name,$data);
        fwrite($open_file,$data);
        fclose($open_file);
        
        //Auto Suggest Api
        $open_file = fopen($api_folder."/".$api_name."/auto_suggest_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/auto_suggest_api.php");        
        fwrite($open_file,$data);
        fclose($open_file);

        //M Auto Suggest Api
        $open_file = fopen($api_folder."/".$api_name."/m.auto_suggest_".$api_name.".php","w");
        $data = file_get_contents("../wsp_rad/default_api/m.auto_suggest_api.php");        
        fwrite($open_file,$data);
        fclose($open_file);

        echo "Files Created. API Ready to use<br>";
      
//create tables
echo "All good to go"; 

        
    
}else{
    mkdir("../api");
    echo "API Folder Created. Please Refresh. Press continue if asked. <br>";
}
//Create API Ends


}
?>
</body>
</html>