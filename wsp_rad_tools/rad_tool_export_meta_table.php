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
.has_ch{
    width:100%;
}
.ch{
    width:100%;
}
</style>
</head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Topbar Start -->
                    <?php include("topbar.php"); ?>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Tree</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                       
                        <!-- RAD Featured Table-->
<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-8">
        <?php

//Configurations
$record_type = "bill";
$show_date_column = false;
$enable_export_tools = true;

//Search
$search_by_columns = array("test_meta"); //you can also put "all" or array.
$enable_date_filter = false;
//Columns
$columns_to_list = array("test_meta");  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_test_meta.php?test_meta_id=";
$view_button_url = "view_test_meta.php?test_meta_id=";
$delete_button_class = "delete_test_meta";
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
    if($page > 0){
        $offset = ($page-1) * $per_page;
    }
}
//Initial records query 
$where_array = array("meta_name LIKE ?"=>$record_type."_%");
$options_array = array("orderBy"=>"date_created DESC","limit"=>$per_page,"offset"=>$offset);

//End Configurations

//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;

//Search By Columns
if($search_by_columns == "all"){
    $search_by_columns = $meta_keys_array;
}
        ?>

                        <!-- by>s>this,keyword>i -->

        <!-- Form Row Starts -->
        <div class="row">
        <form method="get" action="" id="form_search_rad5c40c114c0d28">        
        <div class="form-group d-inline-block">
             <label for="search_by">Search By</label>
            <select required class="form-control db_auto_chose reset_me" name="search_by" db_auto_chose_value="<?php echo safe_get('search_by');?>">
            <option value="">Select Search By</option>
            <?php foreach($search_by_columns as $single_column){
                ?>
     <option value="<?php echo $single_column;?>"><?php echo beautify_meta_name($single_column); ?></option>
                <?php
            }?>
               
                                                   </select>
                </div>            
<div class="form-group d-inline-block">
         <label for="search_keyword">Search Keyword</label>
        <input type="text" class="form-control reset_me" placeholder="Keyword"  name="search_keyword" value="<?php echo safe_get('search_keyword');?>">
            </div>   
            <!-- Date Filter    -->
            <?php if($enable_date_filter){ ?>
            <div class="form-group d-inline-block">
         <label for="search_start_date">Start Date</label>
        <input type="date" class="form-control reset_me" placeholder="Start Date"  name="search_start_date" value="<?php echo safe_get('search_start_date');?>">
            </div>            
            <div class="form-group d-inline-block">
         <label for="search_end_date">End Date</label>
        <input type="date" class="form-control reset_me" placeholder="End Date"  name="search_end_date" value="<?php echo safe_get('search_end_date');?>">
            </div> 
            <?php } ?>    
<!-- Date Filter    -->
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_search" value="SEARCH" form_id="rad5c40c114c0d28"> 

        <input type="button" class="btn btn-info btn-sm reset_form" value="RESET FILTERS" form_id="rad5c40c114c0d28">
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
        
        </div>
<!-- Col 1 ends-->

<?php if($enable_export_tools){ ?>
<!-- Col 2 -->
        <div class="col-sm-4">
        <p><strong>Export Tools</strong></p>
        <a href="javascript:void" class="btn btn-info btn-sm export_to_csv_test_meta"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
         <a href="javascript:void" class="btn btn-info btn-sm export_to_xls_test_meta"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
         <a href="javascript:void" class="btn btn-info btn-sm print_table_test_meta"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
        </div>
<!-- Col 2 ends -->
<?php } ?>
         </div>
<!-- Row Ends -->
Meta Table
<table class="table table-bordered table-responsive" id="list_table_test_meta">
<caption><?php echo $record_type . "_meta"; ?></caption>
<?php


//set columns
$selected_columns = array($meta_keys_array[0],$meta_keys_array[1]); // if columns_to_list is blank select first two automatically
if($columns_to_list == "all"){
    $selected_columns = $meta_keys_array;
}
if(is_array($columns_to_list)){
    $selected_columns = $columns_to_list;
}

?>
<tr>

<th>record_id</th>
<th>meta_name</th>
<th>meta_value</th>
<th>date_created</th>
<th>custom_insert_date</th>
</tr>
<?php 


$list_records = $records_fetch_controller->fetch_record_with_where("records",$where_array);

$total_test_metas = 0;
//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];
   // $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);
   // $total_test_metas = $total_test_metas + get_single_value($record_meta,"test_meta_amount");
    ?>
    <tr>
    <?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
?>
<td><?php echo $single_record["record_id"]; ?></td>
<td><?php echo $single_record["meta_name"]; ?></td>
<td><?php echo $single_record["meta_value"]; ?></td>
<td><?php echo $single_record["date_created"]; ?></td>
<td></td>
  <?php  }
  
  if($show_date_column){
?>
<td><?php echo humanize_date($single_record["date_created"]); ?></td>
<?php
  }
  ?>
  
  </tr>
  <?php
}
?>

</table>


<?php
//Only show pagination if search is not queried
if(!isset($_GET["search_by"])){
    if(!isset($_GET["override_limit"])){
    ?>
<!-- Row Starts -->
<div class="row">
<!-- Col 1 -->
        <div class="col-sm-6">
     <?php   if($page > 1){
         $prev_page = $page - 1;
         ?>
        <a href="?page=<?php echo $prev_page; ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
    <?php } ?>
        <?php 
        //Total Records for pagination
        $total_records = count($records_fetch_controller->fetch_record_with_where($record_type,$where_array));
        $this_page_records = $page * $per_page;
        
        if($total_records > $this_page_records){
            $next_page = $page + 1;
            ?>
<a href="?page=<?php echo $next_page; ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i> Next</a>
            <?php
        }
        ?>
         
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
        <div class="col-sm-6">
        Total Records : <strong><?php echo $total_records; ?></strong> . Limit : <strong><?php echo $per_page; ?> Per Page </strong>
       <?php if($total_records > $this_page_records){ ?>
    <a href="?override_limit=0" class="btn btn-info btn-sm"><i class="fa fa-list" aria-hidden="true"></i> View All</a> <?php } ?>
        </div>
<!-- Col 2 ends -->

         </div>
<!-- Row Ends -->
<?php } }
?>
<!-- RAD Featured Table-->


                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

  <script src="wsp_rad/assets/js/dependsOn.min.js"></script>
  <script src="wsp_rad/assets/js/jquery-wizard.min.js"></script>

    <script src="wsp_rad/assets/js/printThis.js"></script>
    <script src="wsp_rad/assets/js/jquery.tabletoCSV.js"></script>
    <script src="wsp_rad/assets/js/export_to_xls.js"></script>

  <script>
        //reset
        $(".reset").click(function(){
            $(".node").hide();
        });
        //Hide all nodes
       $(".node").hide();

       //On click has_ch
       $(document).on("click",".has_ch",function(){
           var this_id = $(this).attr("id");
           var parent_id = $(this).attr("parent");
           var level = $(this).attr("lv");
            $(".ch").not($(this)).hide();
           $('[parent='+this_id+']').show();
          
          //Set back button level
          $(".back_level").attr("level",level);
       });
        
       $(document).on("click",".back_level",function(){ 
        var level = $(this).attr("level");
        var prev_level = parseInt(level) - parseInt(1);
        $(".node").hide();
        $("[lv="+level+"]").show();
        $(".leaf_node").hide();
        if(level != 0){
        $(this).attr("level",prev_level);
    }
       });

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
var records_table_id = "#list_table_test_meta";
$(".export_to_csv_test_meta").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_test_meta").click(function(){
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

$(".print_table_test_meta").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_test_meta = ".delete_test_meta"; // .classname
var primary_record_key_attribute_name_test_meta = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_test_meta = "api/test_meta/delete_test_meta.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_test_meta,function(e){
e.preventDefault();

 
swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
  var record_id_test_meta = $(this).attr(primary_record_key_attribute_name_test_meta);
    
  $.post(delete_api_url_test_meta,{"record_id":record_id_test_meta});

  
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

  </script>
<?php include("footer.php"); ?>