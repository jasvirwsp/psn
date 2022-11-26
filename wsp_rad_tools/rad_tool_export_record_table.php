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
                   
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Export Records and Meta</h4>
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
if(isset($_GET["search_by"])){
    $search_by = safe_get("search_by");
    $search_keyword = safe_get("search_keyword");
   $record_type = $search_keyword;
}
?>
        <?php

//Configurations
$show_date_column = false;
$enable_export_tools = true;
$search_by_columns =array("record","meta");
//Initial records query 


$where_array = array("meta_name"=>"item");

if($search_by == "meta"){ 
$where_array = array("meta_name LIKE ?"=>$record_type."_%");
}

$options_array = array("orderBy"=>"date_created DESC","limit"=>$per_page,"offset"=>$offset);

//End Configurations
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
Records Table
<table class="table table-bordered table-responsive" id="list_table_test_meta">
<caption><?php echo $search_keyword . "_".$search_by; ?></caption>


<tr>
<?php 
if($search_by == "record"){ ?>
<th>record_id</th>
<th>record_type</th>
<th>record_author</th>
<th>date_created</th>
<th>custom_insert_date</th>
<?php } ?>
<?php
if($search_by == "meta"){ ?>
<th>record_id</th>
<th>meta_name</th>
<th>meta_value</th>
<th>date_created</th>
<th>custom_insert_date</th>
<?php } ?>
</tr>
<?php 
//Check if search query is reqeusted

$list_records = $records_fetch_controller->fetch_all_records_with_record_type($record_type);

if($search_by == "meta"){
$list_records = $records_fetch_controller->fetch_record_with_where("records",$where_array);
}


$total_test_metas = 0;
//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];
   // $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);
   // $total_test_metas = $total_test_metas + get_single_value($record_meta,"test_meta_amount");
    ?>
    <tr>
    
    <?php 
if($search_by == "record"){ ?>
<td><?php echo $single_record["record_id"]; ?></td>
<td><?php echo $single_record["record_type"]; ?></td>
<td><?php echo $single_record["record_author"]; ?></td>
<td><?php echo $single_record["date_created"]; ?></td>
<td></td>
<?php } ?>
<?php 
if($search_by == "meta"){ ?>
<td><?php echo $single_record["record_id"]; ?></td>
<td><?php echo $single_record["meta_name"]; ?></td>
<td><?php echo $single_record["meta_value"]; ?></td>
<td><?php echo $single_record["date_created"]; ?></td>
<td></td>
<?php } ?>

<?php
  }
  ?>
  
  </tr>
 

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
       
        <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>    
	<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../wsp_rad/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../wsp_rad/assets/js/sweetalert.min.js"></script>
  <script src="../wsp_rad/assets/js/dependsOn.min.js"></script>
  <script src="../wsp_rad/assets/js/jquery-wizard.min.js"></script>

    <script src="../wsp_rad/assets/js/printThis.js"></script>
    <script src="../wsp_rad/assets/js/jquery.tabletoCSV.js"></script>
    <script src="../wsp_rad/assets/js/export_to_xls.js"></script>

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