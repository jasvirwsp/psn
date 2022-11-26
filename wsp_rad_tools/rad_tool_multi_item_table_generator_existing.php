<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Multi Table Ex</title>
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
<label>1. Inputs to generate(example name>i [name is input name and i is input,<br> 2.You can use h for hidden and s for select(for options use another delimited ">" and put options with slashes option1/option1)], <br>3.Separate inputs with comma<br> 4.To get input type number put name>i>n <br> 5. For custom date give input name "custom_date".</label>
<textarea class="enter_field form-control" name="inputs_to_generate" rows="5" placeholder="Enter Input Names Separatedy by , comma" cols="20"><?php if(isset($_POST["inputs_to_generate"])) { echo $_POST["inputs_to_generate"]; }?></textarea>
<br>
<div class="form-group ic_need_stats col-md-5 d-inline-block">
             <label class="need_stats" for="need_stats">Stats</label>
            <select class="form-control need_stats" name="need_stats">
                    <option value="yes">Yes</option>
                                              <option value="no">No</option>
                                                   </select>
                </div> <br>
<input type="submit" class="btn btn-info">
</form>
<br>
<?php 
$mega_gen_input_form = "";
$mega_gen_update_form = "";
$mega_gen_input_javascript = "";
if(isset($_POST["inputs_to_generate"])){
    $col_class= "col-md-5 d-inline-block";
    $need_stats = $_POST["need_stats"];
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
        <?php $mega_gen_input_form = '&lt;!-- Multi Item Table for '.$rec_type.'  --&gt;'; ?>
        <?php $mega_gen_input_form .= '
        &lt;!-- '.$inputs.' --&gt
        '; ?>

        <?php $mega_gen_input_form .= '&lt;h4 class="text-center w-100"&gt;'.beautify_meta_name($rec_type).'(You can add Multiple)&lt;/h4&gt;
        &lt;hr&gt;        
        <!-- Multi RAD Items Table -->
        &lt;div class="col-sm-12"&gt;  
        <!-- '.$rec_type.' Parent ID -->
        &lt;input type="hidden" name="'.$rec_type.'_parent_id" value="&lt;?php echo $rec_id; ?&gt;"&gt; 
        <!-- '.$rec_type.' Parent ID -->
        &lt;table class="table multi_items_table_'.$rec_type.'"&gt;

&lt;thead class="bg-dark"&gt;
<!-- Head Row -->
&lt;tr class="item_header text-white"&gt;
';        
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
if($type != "h"){
$mega_gen_input_form .='&lt;th class="text-center multi_item_label_'.$html_name.'"&gt;'.$human_readable.'&lt;/th&gt;
';
}


}
$mega_gen_input_form .='&lt;th class="text-center multi_item_label_'.$rec_type.'_actions"&gt;Actions&lt;/th&gt;';
$mega_gen_input_form .= '&lt;/tr&gt;
&lt;!-- Head Row --&gt;
&lt;/thead&gt;
&lt;tbody&gt;

&lt;?php
//Where array
$record_type_multi_item = "'.$rec_type.'";
$where_array_multi_item = array("'.$rec_type.'_id"=&gt;$rec_id);
$results_multi_item = $records_fetch_controller-&gt;fetch_record_with_where([$record_type_multi_item,$where_array_multi_item]);
$count_'.$rec_type.' = 1;
$results_multi_item_count = count($results_multi_item);
if($results_multi_item_count &gt; 0){
foreach($results_multi_item as $single_multi_item){     
    //Remove author, date_created and date_updated 
    $unset_array = array("date_created","date_updated",$record_type_multi_item."_insert_author");
    foreach($unset_array as $s_unset){
    unset($single_multi_item[$s_unset]);
    }
    //Remove date_created and date_updated 
    
    $imploded_value = implode("~|~",$single_multi_item);
    
    ?&gt;
&lt;!-- Current Input value/ Imploded String --&gt;
&lt;input type="hidden" name="'.$rec_type.'_[]" item_no="&lt;?php echo $count_'.$rec_type.'; ?&gt;" class="multi_item_'.$rec_type.'_&lt;?php echo $count_'.$rec_type.'; ?&gt;" value="&lt;?php echo $imploded_value; ?&gt;"&gt; 
&lt;!-- Current Input value/ Imploded String --&gt;

&lt;!-- Row --&gt;
&lt;tr class="multi_item_row_'.$rec_type.'"&gt;
&lt;input type="hidden" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$rec_type.'_record_id" value="&lt;?php echo $single_multi_item["record_id"]; ?&gt;"&gt;   
';
?>

<?php
foreach($explode_inputs as $input_name){
    
    
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));    
?>

<?php 
if($type == "i"){     
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
 &lt;td&gt;
 &lt;input type="'.$sub_type_html.'" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'" value="&lt;?php echo $single_multi_item["'.$html_name.'"]; ?&gt;"&gt;
 &lt;/td&gt;
 '; ?><?php } ?>
<?php if($type == "h"){ ?>
    <?php $mega_gen_input_form .= '&lt;input type="hidden" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'" value="&lt;?php echo $single_multi_item["'.$html_name.'"]; ?&gt;"&gt;
    ';?> <?php } ?>
<?php if($type == "t"){ ?>
    <?php $mega_gen_input_form .= '
    &lt;td&gt;
        &lt;textarea class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'"&gt;&lt;?php echo $single_multi_item["'.$html_name.'"]; ?&gt;&lt;/textarea&gt;
        &lt;/td&gt;
        ';?> <?php } ?>
<?php if($type == "s"){
   $get_options = explode("/",$explode_type[2]);    
    ?>
      <?php $mega_gen_input_form .= '
      &lt;td&gt;
      &lt;select class="form-control db_auto_chose multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'" db_auto_chose_value="&lt;?php echo $single_multi_item["'.$html_name.'"]; ?&gt;"&gt;';?>
            <?php foreach($get_options as $single_option){ 
                $human_readable = ucwords(str_replace("_"," ",$single_option));
                if($single_option == "select"){
                    $single_option = "";
                }
                ?>
<?php $mega_gen_input_form .= '&lt;option value="'.$single_option.'"&gt;'.$human_readable.'&lt;/option&gt;
';?>
                                      <?php } ?>            <?php $mega_gen_input_form .= '&lt;/select&gt;
&lt;/td&gt;
';?><?php } ?> 

<?php }
$mega_gen_input_form .='
&lt;td&gt;
    &lt;a href="javascript:void(0)" record_id="&lt;?php echo $single_multi_item["record_id"]; ?&gt;" item_no="&lt;?php echo $count_'.$rec_type.'; ?&gt;" class="btn btn-danger multi_item_'.$rec_type.'_remove_item mb-1 mr-1 delete_'.$rec_type.'"&gt;&lt;i class="fe-trash"&gt;&lt;/i&gt;&lt;/a&gt; &lt;/td&gt; 
';
?>
<?php $mega_gen_input_form .= '&lt;/tr&gt
<!-- Row -->
&lt;?php 
    $count_'.$rec_type.'++;
}

}else{ 
    //Show empty row
?&gt;
&lt;!-- Row --&gt;
&lt;input type="hidden" name="'.$rec_type.'_[]" class="multi_item_'.$rec_type.'_1"&gt;
&lt;tr class="multi_item_row_'.$rec_type.'"&gt;
&lt;input type="hidden" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$rec_type.'_record_id"&gt;
';
?>
<?php
foreach($explode_inputs as $input_name){
    
    
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));    
?>

<?php 
if($type == "i"){     
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
 &lt;td&gt;
 &lt;input type="'.$sub_type_html.'" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'"&gt;
 &lt;/td&gt;
 '; ?><?php } ?>
<?php if($type == "h"){ ?>
    <?php $mega_gen_input_form .= '&lt;input type="hidden" class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'"&gt;
    ';?> <?php } ?>
<?php if($type == "t"){ ?>
    <?php $mega_gen_input_form .= '
    &lt;td&gt;
        &lt;textarea class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'"&gt;&lt;/textarea&gt;
        &lt;/td&gt;
        ';?> <?php } ?>
<?php if($type == "s"){
   $get_options = explode("/",$explode_type[2]);    
    ?>
      <?php $mega_gen_input_form .= '
      &lt;td&gt;
      &lt;select class="form-control multi_item_input_'.$rec_type.' multi_item_input_'.$rec_type.'_series multi_item_input_'.$html_name.'"&gt;';?>
            <?php foreach($get_options as $single_option){ 
                $human_readable = ucwords(str_replace("_"," ",$single_option));
                if($single_option == "select"){
                    $single_option = "";
                }
                ?>
<?php $mega_gen_input_form .= '&lt;option value="'.$single_option.'"&gt;'.$human_readable.'&lt;/option&gt;
';?>
                                      <?php } ?>            <?php $mega_gen_input_form .= '&lt;/select&gt;
&lt;/td&gt;
';?><?php } ?> 

<?php } 
$mega_gen_input_form .='
&lt;td&gt;
    &lt;a href="javascript:void(0)" class="btn btn-danger multi_item_'.$rec_type.'_remove_item delete_'.$rec_type.' mb-1 mr-1" item_no="1" record_id=""&gt;&lt;i class="fe-trash"&gt;&lt;/i&gt;&lt;/a&gt; &lt;/td&gt; 
';
?>
<?php $mega_gen_input_form .= '&lt;/tr&gt
<!-- Row -->';
$mega_gen_input_form .= '
&lt;?php
}
?&gt;
&lt;/tbody&gt;
&lt;/table&gt;
<!-- Add item button -->
&lt;a href="javascript:void(0)" class="btn btn-warning item multi_item_add_'.$rec_type.' mb-3"&gt;(+)&lt;/a&gt; 
<!-- Add item button -->
';
if($need_stats == "yes"){
$mega_gen_input_form .= '
<!-- Multi Item Stats Bar -->
&lt;div class="multi_item_stats_'.$rec_type.' text-right bg-light p-2 mb-3"&gt;

                        <!-- Box -->
                        &lt;div class="form-group ic_multi_item_total_items col-md-2 d-inline-block"&gt;
         &lt;label class="multi_item_total_items" for="multi_item_total_items"&gt;Total Items&lt;/label&gt;
        &lt;input type="number" class="form-control multi_item_total_items" placeholder="Total Items" readonly value="1"&gt;
            &lt;/div&gt;     
            <!-- Box -->

            <!-- Box -->
            &lt;div class="form-group ic_multi_item_total_quantity col-md-2 d-inline-block"&gt;
         &lt;label class="multi_item_total_quantity" for="multi_item_total_quantity"&gt;Total Qty&lt;/label&gt;
        &lt;input type="number" class="form-control multi_item_total_quantity" placeholder="Total Items" readonly value="0"&gt;
            &lt;/div&gt;     
            <!-- Box -->
            &lt;/div&gt;
                          <!-- Multi Item Stats Bar -->
                          '; }
                          $mega_gen_input_form .= '
                          &lt;/div&gt;
                          <!-- Multi RAD Items Table for '.$rec_type.' -->
'; ?>
        
        <?php } ?>
        
        
  
  <h3>HTML Code</h3>
<textarea class="select_this form-control" cols="10" rows="20">
<?php echo $mega_gen_input_form; ?>
</textarea>

<h3>Include sticky header</h3>
<textarea class="select_this form-control" cols="10" rows="2">
<script src="wsp_rad/assets/js/jquery.stickytableheaders.min.js"></script>
</textarea>

<h3>Javascript Code</h3>
<textarea class="select_this form-control" cols="10" rows="20">
//RAD Multi Items tables Functions for <?php echo $rec_type;?> Update page
//$(".multi_items_table_<?php echo $rec_type;?>").stickyTableHeaders();

var form_id_<?php echo $rec_type;?> = "#";
if(form_id_<?php echo $rec_type;?> == "#"){
    swal("Form Id is invalid for Multi Table of <?php echo $rec_type;?>");
}
//Append new row
$(document).on("click",".multi_item_add_<?php echo $rec_type;?>",function(){
var items_length_<?php echo $rec_type;?> = $(".multi_item_<?php echo $rec_type;?>_remove_item:last").attr("item_no");
var new_length_<?php echo $rec_type;?> = parseInt(items_length_<?php echo $rec_type;?>) + parseInt(1);    
var item_string_<?php echo $rec_type;?> = $(".multi_item_row_<?php echo $rec_type;?>")[0].outerHTML;
$(".multi_items_table_<?php echo $rec_type;?> tbody").append(item_string_<?php echo $rec_type;?>);
$(form_id_<?php echo $rec_type;?>).append('<input type="hidden" name="<?php echo $rec_type;?>_[]" class="multi_item_<?php echo $rec_type;?>_'+new_length_<?php echo $rec_type;?>+'" item_no="'+new_length_<?php echo $rec_type;?>+'">');


//Change Item No on Trash
$(".multi_item_<?php echo $rec_type;?>_remove_item:last").attr("item_no",new_length_<?php echo $rec_type;?>);

//Empty out last row
$(".multi_item_row_<?php echo $rec_type;?>:last .multi_item_input_<?php echo $rec_type;?>_series").val("");
$(".multi_item_<?php echo $rec_type;?>_remove_item:last").attr("record_id","");

//Restore some fields from first row or with default values
//$(".multi_item_row_<?php echo $rec_type;?>:last .multi_item_input_field_name").val();

//Focus first input of last tr
$(".multi_item_row_<?php echo $rec_type;?>:last").children().find(".multi_item_input_<?php echo $rec_type;?>").first().focus();
update_stats_<?php echo $rec_type;?>();

//Scroll to bottom if required on adding new element
//$('html, body').animate({scrollTop:$(document).height()}, 'slow');
});

//Append new row ends

//On change of any input
$(document).on("change",".multi_item_input_<?php echo $rec_type;?>",function(){    
    var led_separator_<?php echo $rec_type;?> = "~|~";
    var item_no_<?php echo $rec_type;?> = $(this).parents("tr:first").find(".multi_item_<?php echo $rec_type;?>_remove_item:first").attr("item_no");
    var item_string_<?php echo $rec_type;?> = "";
    $(this).parents("tr:first").find(".multi_item_input_<?php echo $rec_type;?>").each(function(){
        item_string_<?php echo $rec_type;?> = item_string_<?php echo $rec_type;?> + led_separator_<?php echo $rec_type;?> + $(this).val();
    });
    
    $(".multi_item_<?php echo $rec_type;?>_"+item_no_<?php echo $rec_type;?>).val(item_string_<?php echo $rec_type;?>.substring(led_separator_<?php echo $rec_type;?>.length));
   update_stats_<?php echo $rec_type;?>();
});
//On change of any input

//Remove item
$(document).on("click",".multi_item_<?php echo $rec_type;?>_remove_item",function(){
    
});
//Remove item

//Stats code
function update_stats_<?php echo $rec_type;?>(){

    <?php if($need_stats =="yes") { ?>
    //Items Total Quantity
    var multi_item_total_quantity = 0;
    $(".multi_item_input_<?php echo $rec_type;?>_quantity").each(function(){
        var this_amount = $(this).val();
        
        multi_item_total_quantity = Number(multi_item_total_quantity) + Number(this_amount);
    });

    //You can also use .toFixed(2) method to add two or desired zeroes after decimal
    $(".multi_item_total_quantity").val(multi_item_total_quantity);    

    //Total Items

    var total_items = $(".multi_item_row_<?php echo $rec_type;?>").length;

    $(".multi_item_total_items").val(total_items);

    <?php } ?>
}
//Stats code ends

//Custom functions on inputs
// $(document).on("change",".multi_item_input_<?php echo $rec_type;?>_class",function(){    
    
// });

//Only for Update page 
$(document).ready(function(){
    update_stats_<?php echo $rec_type;?>();
});

// Delete Operation
var delete_record_button_class_<?php echo $rec_type;?> = ".delete_<?php echo $rec_type;?>"; // .classname
var primary_record_key_attribute_name_<?php echo $rec_type;?> = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_<?php echo $rec_type;?> = "api/<?php echo $rec_type;?>/delete_<?php echo $rec_type;?>.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_<?php echo $rec_type;?>,function(e){
    e.preventDefault();

    var item_no_<?php echo $rec_type;?> = $(this).attr("item_no");
    var this_button_<?php echo $rec_type;?> = $(this);
    var record_id_<?php echo $rec_type;?> = $(this).attr(primary_record_key_attribute_name_<?php echo $rec_type;?>);
    if(record_id_<?php echo $rec_type;?> != ""){


 
swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
 

  $.post(delete_api_url_<?php echo $rec_type;?>,{"record_id":record_id_<?php echo $rec_type;?>});

  
              swal("Processing", {
    icon: "success",
    timer: 1000
  }).then(function(){
    $(this_button_<?php echo $rec_type;?>).parents("tr:first").remove();
    var item_plus_<?php echo $rec_type;?> = parseInt(item_no_<?php echo $rec_type;?>);
    $(".multi_item_<?php echo $rec_type;?>_"+item_plus_<?php echo $rec_type;?>).remove();
    update_stats_<?php echo $rec_type;?>();
    
    var items_length_<?php echo $rec_type;?> = $(".multi_items_table_<?php echo $rec_type;?> tbody tr").length;
    if(items_length_<?php echo $rec_type;?> == 0){
        location.reload();
    }    

  });
  
} 
});

}else{
   
    var items_length_<?php echo $rec_type;?> = $(".multi_items_table_<?php echo $rec_type;?> tbody tr").length;
    if(items_length_<?php echo $rec_type;?> == 1 && record_id_<?php echo $rec_type;?> == ""){
        swal("Nothing to Delete");
    }else{
    $(this).parents("tr:first").remove();
    var item_no_<?php echo $rec_type;?> = $(this).attr("item_no"); 
    var item_plus_<?php echo $rec_type;?> = parseInt(item_no_<?php echo $rec_type;?>);
    $(".multi_item_<?php echo $rec_type;?>_"+item_plus_<?php echo $rec_type;?>).remove();
    }  
}
});

//Apply responsiveness for mobile
$( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    if (isMobile) {
        $(".multi_items_table_<?php echo $rec_type;?>").addClass("table-responsive");
    }
 });

//RAD Multi Items tables Functions for Update page
</textarea>
<h3>Add this to regex_input_array in parent rec type update file .</h3>

<textarea class="select_this form-control" cols="10" rows="2">
$regex_user_input = array("<?php echo $rec_type;?>"=>"");
</textarea>
<h3>Update PHP Code for Hook</h3>
<textarea class="select_this form-control" cols="10" rows="20">
$record_controller = new records_insert_controller();
$update_record = new records_update_controller();
//Insert Items
$record_type_key = "<?php echo $rec_type;?>_";
$record_type = "<?php echo $rec_type;?>";
$filter_duplications_<?php echo $rec_type;?> = array();
foreach($insert_array[$record_type_key] as $record_value){
    if(in_array($record_value,$filter_duplications_<?php echo $rec_type;?>)){
        continue;
    }else{
	$explode_record_value = explode("~|~",$record_value);
    $rec_id_update = $explode_record_value[0];

    <?php $insert_array_string = "";
    
    $count_z = 1;
foreach($explode_inputs as $input_name){
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));
    $insert_array_string .= '"'.$html_name.'"=>$explode_record_value['.$count_z.'],';

    $count_z++;
}
$insert_array_string = rtrim($insert_array_string,",");
$insert_array_string .= ',"date_updated"=>generate_mysql_timestamp()';
    ?>
	if($explode_record_value[0] != ""){
    $where_array = array("record_id"=>$rec_id_update);
	$record_type_array = array(<?php echo $insert_array_string; ?>);
    $update_stuff = $update_record->update_record_with_new_values_and_where([$record_type_array,$where_array,$record_type]);
    array_push($filter_duplications_<?php echo $rec_type;?>,$record_value);
    }else{
        <?php $insert_array_string = "";
    $count_s = 1;
    $count_z = 2;
foreach($explode_inputs as $input_name){
    $explode_type = explode(">",$input_name);
    $type = $explode_type[1];
    $raw_html_name = $explode_type[0];
    $html_name = $record_type.$explode_type[0];
    $human_readable = ucwords(str_replace("_"," ",$explode_type[0]));

if($count_s == 1){
    $insert_array_string .= '"'.$html_name.'"=>$insert_array["'.$rec_type.'_parent_id"],';
}else{
    $insert_array_string .= '"'.$html_name.'"=>$explode_record_value['.$count_z.'],';
}


if($count_s != 1){
    $count_z++;
}
    $count_s++;
    
}
$insert_array_string = rtrim($insert_array_string,",");
$insert_array_string .= ',"date_created"=>generate_mysql_timestamp(),"date_updated"=>generate_mysql_timestamp()';
    ?>
$record_type_array = array(<?php echo $insert_array_string; ?>);
$insert_record = $record_controller->insert_record([$record_type_array,$record_type]);
array_push($filter_duplications_<?php echo $rec_type;?>,$record_value);
}

    }
	}
</textarea>

        <?php
        if(isset($_POST["inputs_to_generate"])){ ?>
        <?php $mega_gen_update_form .= '&lt;!-- Form Row Starts --&gt;
        &lt;div class="row"&gt;
        &lt;form method="post" action="" id="form_update_'.$rec_type."_".$unique_id.'" class="w-100"&gt;
        &lt;?php $rec_id = $_GET["'.$rec_type.'_id"];
        $record_type = "'.$rec_type.'";
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
    $col_class= "col-md-5 d-inline-block";
    
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
         &lt;label class="'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;input type="'.$sub_type_html.'" class="form-control '.$html_name.'" placeholder="'.$human_readable.'" name="'.$html_name.'" value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;"&gt;
            &lt;/div&gt;';?><?php } ?>
<?php if($type == "h"){ ?>
    <?php $mega_gen_update_form .= '
    &lt;input type="hidden" class="form-control '.$html_name.'" name="'.$html_name.'"&gt;';?> <?php } ?>
<?php if($type == "t"){ ?>
    <?php $mega_gen_update_form .= '
    &lt;div class="form-group ic_'.$html_name.' col-sm-12"&gt;
         &lt;label class="'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
        &lt;textarea class="form-control '.$html_name.'" placeholder="'.$human_readable.'" name="'.$html_name.'"&gt;&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;&lt;/textarea&gt;
        &lt;/div&gt;';?><?php } ?>
<?php if($type == "s"){
   $get_options = explode("/",$explode_type[2]);    
    ?>
      <?php $mega_gen_update_form .= '
      &lt;div class="form-group ic_'.$html_name.' '.$col_class.'"&gt;
             &lt;label class="'.$html_name.'" for="'.$html_name.'"&gt;'.$human_readable.'&lt;/label&gt;
            &lt;select class="form-control db_auto_chose" name="'.$html_name.'" db_auto_chose_value="&lt;?php echo get_single_value($rec_meta,"'.$html_name.'"); ?&gt;"&gt;';?>
            <?php foreach($get_options as $single_option){ 
                $human_readable = ucwords(str_replace("_"," ",$single_option));
                ?>
        <?php $mega_gen_update_form .= '
        &lt;option value="'.$single_option.'"&gt;'.$human_readable.'&lt;/option&gt;'; ?>
                                      <?php } ?>            <?php $mega_gen_update_form .= '&lt;/select&gt;';?>
                                      <?php $mega_gen_update_form .= '&lt;/div&gt;';?><?php } ?>            
<?php }
?>
       <?php $mega_gen_update_form .= '
       &lt;div class="form-group col-md-12"&gt;
       
        &lt;input type="submit" class="btn btn-success btn-sm update_'.$rec_type.'" value="Update '.strtoupper($rec_type).'" form_id="'.$unique_id.'"&gt; 
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
        
<h3>Javascript</h3>
<textarea class="select_this form-control" cols="10" rows="5">

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

</body>
</html>