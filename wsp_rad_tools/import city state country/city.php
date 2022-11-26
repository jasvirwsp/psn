<?php include("header.php"); ?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           <?php include("left_sidebar.php"); ?>
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
                                    
                                    <h4 class="page-title"><?php echo beautify_meta_name(title_case("city")); ?> <!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_city"><i class="fe-plus"></i> Add <?php echo beautify_meta_name(title_case("city"));?></button>
</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                       <!-- RAD Featured Table-->

        <?php

//Configurations
$record_type = "city";
$show_date_column = false;
$enable_export_tools = false;
$enable_footer_stats = false;
//Search
$search_by_columns = "all"; //you can also put "all" or array.
$enable_date_filter = true;
//Columns
$columns_to_list = "all";  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_city.php?city_id=";
$view_button_url = "view_city.php?city_id=";
$delete_button_class = "delete_city";
//Records
$per_page = 20;
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

//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;


//Initial records query 
$where_array = array("city_name != ?"=>""); // You can change it as per required
$options_array = array("orderBy"=>"record_id DESC","limit"=>$per_page,"offset"=>$offset);

//End Configurations


//Search By Columns
if($search_by_columns == "all"){
    $search_by_columns = $meta_keys_array;
}
        ?>

                        <!-- by>s>this,keyword>i -->

                        <div id="accordion" class="w-100 mb-3">
                                                    <div class="card mb-0">
                                                        <div class="card-header" id="headingOne">
                                                            <h4 class="m-0">
                                                                <a class="text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                                                    <i class="mdi mdi-table-search mr-1 text-primary"></i> 
                                                                    Search Records
                                                                </a>
                                                            </h4>
                                                        </div>
                                            
                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body">
                                                               
                                                            
         <!-- Row Starts -->
<div class="row">
        <!-- Col 1 -->
        <div class="col-sm-3">       
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
                </div>       
                <div class="col-sm-3"> 
<div class="form-group d-inline-block">
         <label for="search_keyword">Search Keyword</label>
        <input type="text" class="form-control reset_me" placeholder="Keyword"  name="search_keyword" value="<?php echo safe_get('search_keyword');?>">
            </div>   
            </div>
            <!-- Date Filter    -->
            <?php if($enable_date_filter){ ?>
              <div class="col-sm-3"> 
            <div class="form-group d-inline-block">
         <label for="search_start_date">Start Date</label>
        <input type="date" class="form-control reset_me" placeholder="Start Date"  name="search_start_date" value="<?php echo safe_get('search_start_date');?>">
            </div>     
            </div>
            <div class="col-sm-3">        
            <div class="form-group d-inline-block">
         <label for="search_end_date">End Date</label>
        <input type="date" class="form-control reset_me" placeholder="End Date"  name="search_end_date" value="<?php echo safe_get('search_end_date');?>">
            </div> 
            </div>
            <?php } ?>    
<!-- Date Filter    -->
        <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-secondary btn-sm insert_search" value="SEARCH" form_id="rad5c40c114c0d28"> 

        <input type="button" class="btn btn-secondary btn-sm reset_form" value="RESET FILTERS" form_id="rad5c40c114c0d28">
        </div>
        </form>
        
        
        </div>
<!-- Col 1 ends-->
</div>
<!-- Row Ends -->
</div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                        
                                                    
                                                </div>

<table class="table table-striped" id="list_table_city">
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
<thead class="bg-dark">
<tr>
<th><a href="javascript:void(0)" class="btn btn-info btn-sm select_all_to_delete mt-1" status="unchecked"><i class="fe-check-circle"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_selected mt-1"><i class="fe-trash"></i></a></th>
<?php
//Pass thru Function for titles
function pass_thru_title($single_column){
  
  $response_array = array();

  if(isset($response_array[$single_column])){  

    $return_value = $response_array[$single_column];
  
    return $return_value;
}
  }
  //Pass thru Function for titles
?>
<?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
?>
<th><?php echo pass_thru_title($single_column) ?: beautify_meta_name($single_column); ?></th>
<?php
}
?>
<?php if($show_date_column){ ?>
<th>Date Created</th>
<?php } ?>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
//Check if search query is reqeusted
if(isset($_GET["search_by"])){
    $search_by = safe_get("search_by");
    $search_keyword = safe_get("search_keyword");
    $where_array = array($search_by." LIKE ?"=>"%".$search_keyword."%");
    $options_array = array("orderBy"=>"record_id DESC");

    if($search_by == "record_id"){
      $where_array = array("record_id"=>$search_keyword);
      $options_array = array("limit"=>1);
    }

    if(isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")){        
        $start_date = safe_get("search_start_date");
        $end_date = safe_get("search_end_date");
        $options_array = array("between"=>"date(date_created),".$start_date.",".$end_date);
    }
}

$total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array([$record_type,$where_array]);
$list_records = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);
$count_list_records = count($list_records);
if($count_list_records == 0){
  $zero_records = "<h4 class='text-center'>No Data Found</h4>";
}


//Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //   return "test ".$dynamic_value;
  // }

  
  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id,$data_array){
  // Ex $allowed_columns = array("dummy_column");
  $allowed_columns = array();

  if(in_array($single_column,$allowed_columns)){  

    $return_value = $single_column($single_column,$dynamic_value,$record_id,$data_array);  
  
    return $return_value;
}
  }
  //Pass thru Function

//Loop list records
$do_total_array = array(); //add columns here
$totals_array = array();
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];    

    ?>
    <tr>
    <td><div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input multi_delete" id="checkmeout_<?php echo $record_id;?>" record_id="<?php echo $record_id; ?>">
    <label class="custom-control-label" for="checkmeout_<?php echo $record_id;?>"></label>
</div></td>
    <?php
    foreach($selected_columns as $single_column){
      //Do total
      if(in_array($single_column,$do_total_array)){
        $exclude_from_pass_thru = array();
        if(in_array($single_column,$exclude_from_pass_thru)){
          $totals_array[$single_column] = $totals_array[$single_column] + $single_record[$single_column];
        }else{
        $totals_array[$single_column] = $totals_array[$single_column] + (pass_thru($single_column,$single_record[$single_column],$record_id,$single_record) ?: $single_record[$single_column]);
      }
        };
      //Do total
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
        if($single_column == "record_id"){
          ?>
<td class="<?php echo $single_column; ?> <?php echo $single_column."_".$record_id; ?>"><?php echo pass_thru($single_column,$record_id,$record_id,$single_record) ?: $record_id;?></td>
          <?php
          continue;
        }
?>
<td class="<?php echo $single_column; ?> <?php echo $single_column."_".create_slug($single_record[$single_column]); ?>"><?php echo pass_thru($single_column,$single_record[$single_column],$record_id,$single_record) ?: title_case($single_record[$single_column]);?></td>
  <?php  }
  
  if($show_date_column){
?>
<td><?php echo humanize_date($single_record["date_created"]); ?></td>
<?php
  }
  ?>
  <td>
  <!--Dyanamic buttons -->
<?php 
//Dynamic Buttons Array
//Title,Href,CSS Classes,Icon,Tooltip,Target
$dynamic_buttons = array(
  //["Example Button","example.php?example_id=$record_id","btn btn-sm w-100 mb-1 btn-danger","fe-activity","_self"]
);
//Dynamic Buttons Array

//Loop Buttons
foreach($dynamic_buttons as $single_button){
  ?>
  <a target="<?php echo $single_button[4]; ?>" class="<?php echo $single_button[2] ?: "btn btn-sm w-100 mb-1 btn-info";?>" data-toggle="tooltip" data-placement="top" title="<?php echo $single_button[4] ?: $single_button[0];?>" href="<?php echo $single_button[1]?>"><i class="<?php echo $single_button[3]?>"></i> <?php echo $single_button[0]?></a>
  <?php
}
// loop  buttons ends
?>
<!--Dyanamic buttons -->
  <a class="btn btn-info btn-sm w-100 mb-1" data-toggle="tooltip" data-placement="top" title="View/Edit" href="<?php echo $edit_button_url.$record_id; ?>"><i class="fe-edit-1"></i></a>
   <a class="btn btn-danger btn-sm  w-100 mb-1 <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fe-trash-2"></i></a>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>
<?php 
if($zero_records){
  echo $zero_records;
}
?>

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
<?php if($enable_export_tools){ ?>
  <div class="row">
<!-- Col 1 -->
        <div class="col-sm-12">
        <p><strong>Export Tools</strong></p>
        <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_city"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_city"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm print_table_city"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
        </div>
<!-- Col 1 ends -->
</div>
<!-- Row Ends -->
<?php } ?>
        
<?php } }
?>
<!-- RAD Featured Table-->

<?php if($enable_footer_stats){?>
<!-- Horizontal Card 3 Column -->
<div class="card text-white bg-dark mb-3 mt-3">
  <div class="card-header bg-dark">Stats</div>
  <div class="card-body">
  <!-- Row Starts -->
 <div class="row">
<!-- Col 1 -->
        <div class="col-sm-4">
        <h5 class="card-title">Stat : </h5>
    <p class="card-text">0</p>
        </div>
<!-- Col 1 ends-->

<!-- Col 2 -->
        <div class="col-sm-4">
        <h5 class="card-title">Stat : </h5>
    <p class="card-text">0</p>  
        </div>
<!-- Col 2 ends -->

<!-- Col 3 -->
        <div class="col-sm-4">
        <h5 class="card-title">Stat : </h5>
    <p class="card-text">0</p>  
        </div>
<!-- Col 3 ends -->
         </div>
<!-- Row Ends -->
  </div>
</div>
<!-- Horizontal Card 3 Column -->
<?php } ?>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
<!-- Add city Start-->
<div class="modal fade" id="add_city" tabindex="-1" role="dialog" aria-labelledby="add_city_LongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo beautify_meta_name(title_case("city"));?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- name>i --&gt<!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_city_rad5df9bb3b7415b" class="w-100">
 <div class="form-group ic_city_name col-md-5 d-inline-block">
         <label class="label_city_name" for="city_name">Name</label>
        <input type="text" class="form-control city_name" placeholder="Name"  name="city_name">
            </div>
        
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_city" value="Add City" form_id="rad5df9bb3b7415b"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
    </div>
  </div>
</div>
<!-- Add city Ends-->

<!-- Quick Edit Modal for city Start-->
<div class="modal fade" id="quick_edit_modal_city" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo beautify_meta_name(title_case("city")); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body ic_age_modal">
      <form method="post" action="" id="form_update_city_quick_edit" class="w-100">
      <input type="hidden" name="record_id" value="" class="quick_edit_city_record_id">
      <div class="modal_input_loader_city">

      </div>
      <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_city" value="Update <?php echo beautify_meta_name(title_case("city")); ?>" form_id="quick_edit"> 
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
    </div>
  </div>
</div>
<!-- Quick Edit Modal city Ends-->


                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script>
        
        //Insert variables
        var insert_button_class_city = ".insert_city"; // .classname
                var form_id_city = "#form_city";  // #entry_form
                var insert_api_url_city = "api/city/insert_city.php"; // /api/insert.php
                var form_id_parameter_name = "form_id";
                
                //Insert Operation
                $(document).on("click",insert_button_class_city,function(e){                
                e.preventDefault();
                //Processing
                swal("Processing","Please Wait","warning");
                //Processing
                var form_to_process_city = form_id_city + "_" + $(this).attr(form_id_parameter_name);
        
                $.post(insert_api_url_city,$(form_to_process_city).serializeArray(),function(data){
        
                    var response_json_city = data;
        
                    if(response_json_city["status"] == "failure"){
                  var get_errors_city = response_json_city["errors"];
                  var errors_returned_city = "";
                  $(get_errors_city).each(function(index,value){
                    errors_returned_city = errors_returned_city + " => " + value;
                        
                    });
                    swal("Error",errors_returned_city, {
              icon: "error"
            });
        
                    }else{
                    
        
                        //Reset Form
                    // $(form_to_process_city)[0].reset();
        
                    //Focus to first input
                    $(form_to_process_city + " input[type=text]").first().focus();
        
                    //To show updated values on same page
                    // $(updated_data_container_class).load(updated_data_file_url);
        
        
                    // Other functions to execure on success
                        
                    
//Customized buttons
var entry_id_city = response_json_city["record_id"];
var customized_content_city = document.createElement("div");
customized_content_city.innerHTML = "<a href='edit_city.php?city_id="+entry_id_city+"' class='btn btn-sm btn-warning mt-1'>Edit City</a> <a href='#' onclick='location.reload()' class='btn btn-sm btn-warning mt-1'>Add New City</a> <!--<a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a> --><br><br><a href='#' onclick='var loc = location.href.replace(location.hash,\"\");window.location = loc;' class='btn btn-sm btn-danger'>Close & Refresh</a> <a href='#' onclick='swal.close()' class='btn btn-sm btn-danger'>X</a>";
swal({
    title: "Success",
    text: "Choose next action",
  content: customized_content_city,
  buttons: false,
  icon : 'success',
});
//Customized buttons

                         }
        
        
        
                });// .post function ends
        
            });//Insert function ends

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
var records_table_id = "#list_table_city";
$(".export_to_csv_city").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_city").click(function(){
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

$(".print_table_city").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_city = ".delete_city"; // .classname
var primary_record_key_attribute_name_city = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_city = "api/city/delete_city.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_city,function(e){
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
  var record_id_city = $(this).attr(primary_record_key_attribute_name_city);
    
  $.post(delete_api_url_city,{"record_id":record_id_city});

  
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

//Multi select
// Select/unselect all items
$(".select_all_to_delete").click(function(){
  var availble_items_length = $(".multi_delete").length;
  
  if(availble_items_length > 0){
    
  var status = $(this).attr("status");
  if(status == "unchecked"){
  $(".multi_delete").prop("checked",true);
  $(this).attr("status","checked");
}else{
  $(".multi_delete").prop("checked",false);
  $(this).attr("status","unchecked");
}
  }else{
    swal ( "Oops" ,  "No Item to select" ,  "info" )
  }
});
//ends

//Delete selected items
$(".delete_selected").click(function(e){
  e.preventDefault();
var selected_items_length = $(".multi_delete:checked").length;
if(selected_items_length > 0){

swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
   var selected_to_delete_array = $(".multi_delete:checked").map(function(){
   return $(this).attr("record_id");
  }).get();
  var api_url = "api/city/delete_city.php"; //Replace with correct API url
	  
swal("Deleting Selected Entries", {
      icon: "warning",
    });
	  
    $.post(api_url,{"record_id":selected_to_delete_array},function(){
    
    swal("Deletion Success", {
      icon: "success",
    });
    setTimeout(function(){
      location.reload();
    },1000)

  });

  } 
});

}else{
  swal ( "Oops" ,  "No Item Selected" ,  "info" );

}

});
//Delete selected items ends
//Multi select ends

//Apply Datatables to mobile only
$(document).ready( function () {
        $( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    if (isMobile) {
        $('#list_table_city').DataTable({
    paging: false,
    info: false,
    responsive: {
        details: true
    },
    "language" : {
        "search" : "Search Table"
    }

});
    }
 });

} );
//Apply Datatables to mobile only



//Quick Edit Code for city starts
$(".quick_edit_city").click(function(){
          var quick_edit_city_record_type = 'city';
          var quick_edit_city_record_id = $(this).attr("record_id");
          $(".quick_edit_city_record_id").val(quick_edit_city_record_id);
          var quick_edit_city_input_name = $(this).attr("quick_edit_input_name");
          $("#quick_edit_modal_city").modal("show");
          $(".modal_input_loader_city").load("edit_"+quick_edit_city_record_type+".php?"+quick_edit_city_record_type+"_id="+quick_edit_city_record_id+" .ic_"+quick_edit_city_input_name);
        });
        

//Update Variables for city
var qe_update_button_class_city= ".update_city"; // .classname
var qe_form_id_city = "#form_update_city";
var qe_update_api_url_city = "api/city/update_city.php"; // /api/update.php
 var qe_form_id_parameter_name_city = "form_id";
    //Update Operation
    	   $(document).on("click",qe_update_button_class_city,function(e){
e.preventDefault();
    		  var qe_form_to_process_city = qe_form_id_city + "_" + $(this).attr(qe_form_id_parameter_name_city);

    	 $.post(qe_update_api_url_city,$(qe_form_to_process_city).serializeArray(),function(data){
        var qe_response_json_city = data;

if(qe_response_json_city["status"] == "failure"){
  var qe_get_errors_city = qe_response_json_city["errors"];
 
    var errors_returned_city = "";
  $(qe_get_errors_city).each(function(index,value){
            errors_returned_city = errors_returned_city + " => " + value;
    });

    swal("Error",errors_returned_city, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(qe_form_to_process_city)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var qe_customized_content_city = document.createElement("div");
qe_customized_content_city.innerHTML = "<a href='javascript:void(0)' onClick='location.reload()' class='btn btn-sm btn-warning mt-1'>Refresh Changes</a> <br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: qe_customized_content_city,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
//Quick Edit Code for city ends 
        </script>
<?php include("footer.php"); ?>