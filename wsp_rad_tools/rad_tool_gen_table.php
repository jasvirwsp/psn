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
.select_this{margin:20px 0;width:95%;}
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
                

        <input type="submit" class="btn btn-success btn-lg" value="Generate Table"> 
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
<h2>Featured Table php code for <?php echo $api_name; ?> ( Please edit configurations and initial query section in code)</h2>
<textarea class="select_this" rows="40">
&lt;!-- RAD Featured Table--&gt;
&lt;!-- Row Starts --&gt;
&lt;div class="row"&gt;
&lt;!-- Col 1 --&gt;
        &lt;div class="col-sm-8"&gt;
        &lt;?php

//Configurations
$record_type = "<?php echo $api_name; ?>";
$show_date_column = true;
$enable_export_tools = false;

//Search
$search_by_columns = "all"; //you can also put "all" or array.
$enable_date_filter = true;
//Columns
$columns_to_list = "all";  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_<?php echo $api_name; ?>.php?<?php echo $api_name; ?>_id=";
$view_button_url = "view_<?php echo $api_name; ?>.php?<?php echo $api_name; ?>_id=";
$delete_button_class = "delete_<?php echo $api_name; ?>";
//Records
$per_page = 10;
//Offset settings
if(isset($_GET["override_limit"])){
    $per_page = safe_get("override_limit");
}
$offset= 0;
$page= 1;
if(isset($_GET["page"])){
    $page = safe_get("page");
    if($page &gt; 0){
        $offset = ($page-1) * $per_page;
    }
}

//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;

//Initial records query 
$where_array = array("meta_name"=&gt;$meta_keys_array[1]);
$options_array = array("orderBy"=&gt;"date_created DESC","limit"=&gt;$per_page,"offset"=&gt;$offset);

//End Configurations



//Search By Columns
if($search_by_columns == "all"){
    $search_by_columns = $meta_keys_array;
}
        ?&gt;

                        &lt;!-- by&gt;s&gt;this,keyword&gt;i --&gt;

        &lt;!-- Form Row Starts --&gt;
        &lt;div class="row"&gt;
        &lt;form method="get" action="" id="form_search_rad5c40c114c0d28"&gt;        
        &lt;div class="form-group d-inline-block"&gt;
             &lt;label for="search_by"&gt;Search By&lt;/label&gt;
            &lt;select required class="form-control db_auto_chose reset_me" name="search_by" db_auto_chose_value="&lt;?php echo safe_get('search_by');?&gt;"&gt;
            &lt;option value=""&gt;Select Search By&lt;/option&gt;
            &lt;?php foreach($search_by_columns as $single_column){
                ?&gt;
     &lt;option value="&lt;?php echo $single_column;?&gt;"&gt;&lt;?php echo beautify_meta_name($single_column); ?&gt;&lt;/option&gt;
                &lt;?php
            }?&gt;
               
                                                   &lt;/select&gt;
                &lt;/div&gt;            
&lt;div class="form-group d-inline-block"&gt;
         &lt;label for="search_keyword"&gt;Search Keyword&lt;/label&gt;
        &lt;input type="text" class="form-control reset_me" placeholder="Keyword"  name="search_keyword" value="&lt;?php echo safe_get('search_keyword');?&gt;"&gt;
            &lt;/div&gt;   
            &lt;!-- Date Filter    --&gt;
            &lt;?php if($enable_date_filter){ ?&gt;
            &lt;div class="form-group d-inline-block"&gt;
         &lt;label for="search_start_date"&gt;Start Date&lt;/label&gt;
        &lt;input type="date" class="form-control reset_me" placeholder="Start Date"  name="search_start_date" value="&lt;?php echo safe_get('search_start_date');?&gt;"&gt;
            &lt;/div&gt;            
            &lt;div class="form-group d-inline-block"&gt;
         &lt;label for="search_end_date"&gt;End Date&lt;/label&gt;
        &lt;input type="date" class="form-control reset_me" placeholder="End Date"  name="search_end_date" value="&lt;?php echo safe_get('search_end_date');?&gt;"&gt;
            &lt;/div&gt; 
            &lt;?php } ?&gt;    
&lt;!-- Date Filter    --&gt;
        &lt;div class="form-group col-md-12"&gt;
        &lt;input type="submit" class="btn btn-success btn-sm insert_search" value="SEARCH" form_id="rad5c40c114c0d28"&gt; 

        &lt;input type="button" class="btn btn-info btn-sm reset_form" value="RESET FILTERS" form_id="rad5c40c114c0d28"&gt;
        &lt;/div&gt;
        &lt;/form&gt;
        &lt;/div&gt;
        &lt;!-- Form Row Ends --&gt;
        
        &lt;/div&gt;
&lt;!-- Col 1 ends--&gt;

&lt;?php if($enable_export_tools){ ?&gt;
&lt;!-- Col 2 --&gt;
        &lt;div class="col-sm-4"&gt;
        &lt;p&gt;&lt;strong&gt;Export Tools&lt;/strong&gt;&lt;/p&gt;
        &lt;a href="javascript:void" class="btn btn-info btn-sm export_to_csv_<?php echo $api_name; ?>"&gt;&lt;i class="fa fa-download" aria-hidden="true"&gt;&lt;/i&gt; CSV&lt;/a&gt;
         &lt;a href="javascript:void" class="btn btn-info btn-sm export_to_xls_<?php echo $api_name; ?>"&gt;&lt;i class="fa fa-download" aria-hidden="true"&gt;&lt;/i&gt; Excel&lt;/a&gt;
         &lt;a href="javascript:void" class="btn btn-info btn-sm print_table_<?php echo $api_name; ?>"&gt;&lt;i class="fa fa-print" aria-hidden="true"&gt;&lt;/i&gt; Print&lt;/a&gt;
        &lt;/div&gt;
&lt;!-- Col 2 ends --&gt;
&lt;?php } ?&gt;
         &lt;/div&gt;
&lt;!-- Row Ends --&gt;

&lt;table class="table table-bordered table-responsive" id="list_table_<?php echo $api_name; ?>"&gt;
&lt;?php


//set columns
$selected_columns = array($meta_keys_array[0],$meta_keys_array[1]); // if columns_to_list is blank select first two automatically
if($columns_to_list == "all"){
    $selected_columns = $meta_keys_array;
}
if(is_array($columns_to_list)){
    $selected_columns = $columns_to_list;
}

?&gt;
&lt;tr&gt;
&lt;?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
?&gt;
&lt;th&gt;&lt;?php echo beautify_meta_name($single_column); ?&gt;&lt;/th&gt;
&lt;?php
}
?&gt;
&lt;?php if($show_date_column){ ?&gt;
&lt;th&gt;Date Created&lt;/th&gt;
&lt;?php } ?&gt;
&lt;th&gt;Actions&lt;/th&gt;
&lt;/tr&gt;
&lt;?php 
//Check if search query is reqeusted
if(isset($_GET["search_by"])){
    $search_by = safe_get("search_by");
    $search_keyword = safe_get("search_keyword");
    $where_array = array("meta_name"=&gt;$search_by,"meta_value LIKE ?"=&gt;"%".$search_keyword."%");
    $options_array = array();

    if($search_by == "record_id"){
      $where_array = array("record_id"=&gt;$search_keyword);
      $options_array = array("limit"=&gt;1);
    }

    if(isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")){        
        $start_date = safe_get("search_start_date");
        $end_date = safe_get("search_end_date");
        $options_array = array("between"=&gt;"date(date_created),".$start_date.",".$end_date);
    }
}


$list_records = $records_fetch_controller->fetch_record_with_where($record_type,$where_array,$options_array);


//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];
    $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);
    
    ?&gt;
    &lt;tr&gt;
    &lt;?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
        if($single_column == "record_id"){
          ?>
          &lt;td class="&lt;?php echo $single_column; ?&gt; &lt;?php echo $single_column."_".$record_id; ?>"&gt;&lt;?php echo $record_id;?&gt;&lt;/td&gt;
          &lt;?php
          continue;
        }
?&gt;
&lt;td class="&lt;?php echo $single_column; ?&gt; &lt;?php echo $single_column."_".create_slug(get_single_value($record_meta,$single_column)); ?&gt;"&gt;&lt;?php echo beautify_meta_name(title_case(get_single_value($record_meta,$single_column)));?&gt;&lt;/td&gt;
  &lt;?php  }
  
  if($show_date_column){
?&gt;
&lt;td&gt;&lt;?php echo humanize_date($single_record["date_created"]); ?&gt;&lt;/td&gt;
&lt;?php
  }
  ?&gt;
  &lt;td&gt;
  &lt;a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View/Edit" href="&lt;?php echo $edit_button_url.$record_id; ?&gt;"&gt;&lt;i class="fe-edit-1"&gt;&lt;/i&gt; Edit / View&lt;/a&gt;
   &lt;a class="btn btn-danger btn-sm &lt;?php echo $delete_button_class; ?&gt;" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="&lt;?php echo $record_id; ?&gt;"&gt;&lt;i class="fe-trash-2"&gt;&lt;/i&gt; Delete&lt;/a&gt;
  &lt;/td&gt;
  &lt;/tr&gt;
  &lt;?php
}
?&gt;

&lt;/table&gt;


&lt;?php
//Only show pagination if search is not queried
if(!isset($_GET["search_by"])){
    if(!isset($_GET["override_limit"])){
    ?&gt;
&lt;!-- Row Starts --&gt;
&lt;div class="row"&gt;
&lt;!-- Col 1 --&gt;
        &lt;div class="col-sm-6"&gt;
     &lt;?php   if($page &gt; 1){
         $prev_page = $page - 1;
         ?&gt;
        &lt;a href="?page=&lt;?php echo $prev_page; ?&gt;" class="btn btn-sm btn-info"&gt;&lt;i class="fa fa-arrow-left" aria-hidden="true"&gt;&lt;/i&gt; Prev&lt;/a&gt;
    &lt;?php } ?&gt;
        &lt;?php 
        //Total Records for pagination
        $total_records = count($meta_fetch_controller-&gt;fetch_meta_with_where($record_type,$where_array));
        $this_page_records = $page * $per_page;
        
        if($total_records &gt; $this_page_records){
            $next_page = $page + 1;
            ?&gt;
&lt;a href="?page=&lt;?php echo $next_page; ?&gt;" class="btn btn-info btn-sm"&gt;&lt;i class="fa fa-arrow-right" aria-hidden="true"&gt;&lt;/i&gt; Next&lt;/a&gt;
            &lt;?php
        }
        ?&gt;
         
        &lt;/div&gt;
&lt;!-- Col 1 ends--&gt;

&lt;!-- Col 2 --&gt;
        &lt;div class="col-sm-6"&gt;
        Total Records : &lt;strong&gt;&lt;?php echo $total_records; ?&gt;&lt;/strong&gt; . Limit : &lt;strong&gt;&lt;?php echo $per_page; ?&gt; Per Page &lt;/strong&gt;
       &lt;?php if($total_records &gt; $this_page_records){ ?&gt;
    &lt;a href="?override_limit=0" class="btn btn-info btn-sm"&gt;&lt;i class="fa fa-list" aria-hidden="true"&gt;&lt;/i&gt; View All&lt;/a&gt; &lt;?php } ?&gt;
        &lt;/div&gt;
&lt;!-- Col 2 ends --&gt;

         &lt;/div&gt;
&lt;!-- Row Ends --&gt;
&lt;?php } }
?&gt;
&lt;!-- RAD Featured Table--&gt;

</textarea>

<h2>Featured Table Javascript</h2>
<textarea class="select_this" rows="40">
//Featured Tabel Javascript
//Reset Form
$(".reset_form").click(function(){
  var form_id = $(this).attr("form_id");
  $("#form_search_"+form_id+" .reset_me").val("");
});
//DB Auto Chose
$(".db_auto_chose").each(function(){  
var db_auto_chose_name = $(this).attr("name");
var db_auto_chose_value = $(this).attr("db_auto_chose_value");
$(this).val(db_auto_chose_value);
});

//Export and print codes
var records_table_id = "#list_table_<?php echo $api_name; ?>";
$(".export_to_csv_<?php echo $api_name; ?>").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_<?php echo $api_name; ?>").click(function(){
  $(records_table_id).tableExport({
filename: 'records.xls',
escape:'false'
});
});

function beforeprinttable(){
  $(records_table_id+" th:last-child,"+ records_table_id + " td:last-child").hide();
};

function afterprinttable(){
setInterval(function(){
  $(records_table_id + " th:last-child,"+ records_table_id + " td:last-child").show();
},1000);
};

$(".print_table_<?php echo $api_name; ?>").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_<?php echo $api_name; ?> = ".delete_<?php echo $api_name; ?>"; // .classname
var primary_record_key_attribute_name_<?php echo $api_name; ?> = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_<?php echo $api_name; ?> = "api/<?php echo $api_name; ?>/delete_<?php echo $api_name; ?>.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_<?php echo $api_name; ?>,function(e){
e.preventDefault();

 
swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) =&gt; {
if (willDelete) {
  var record_id_<?php echo $api_name; ?> = $(this).attr(primary_record_key_attribute_name_<?php echo $api_name; ?>);
    
  $.post(delete_api_url_<?php echo $api_name; ?>,{"record_id":record_id_<?php echo $api_name; ?>});

  
              swal("Processing", {
    icon: "success",
    timer: 1000
  }).then(function(){
      location.reload();
  });
  
} 
});
});
//Featured Tabel Ends
</textarea>
<h2>Include these js if not included</h2>
<textarea class="select_this" rows="5">
&lt;script src="wsp_rad/assets/js/sweetalert.min.js"&gt;&lt;/script&gt;
    &lt;script src="wsp_rad/assets/js/printThis.js"&gt;&lt;/script&gt;
    &lt;script src="wsp_rad/assets/js/jquery.tabletoCSV.js"&gt;&lt;/script&gt;
    &lt;script src="wsp_rad/assets/js/export_to_xls.js"&gt;&lt;/script&gt;
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