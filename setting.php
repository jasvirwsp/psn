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
                                    
                                    <h4 class="page-title"><?php echo title_case("settings"); ?> <?php if(safe_get("show") =="yes"){?><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_setting"><i class="fe-plus"></i> Add <?php echo title_case("setting");?></button><?php }?>
</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                       <!-- RAD Featured Table-->

        <?php

//Configurations
$record_type = "setting";
$show_date_column = true;
$enable_export_tools = false;

//Search
$search_by_columns = "all"; //you can also put "all" or array.
$enable_date_filter = true;
//Columns
$columns_to_list = array("setting_name","setting_value");  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_setting.php?setting_id=";
$view_button_url = "view_setting.php?setting_id=";
$delete_button_class = "delete_setting";
//Records
$per_page = 0;
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
$where_array = array("setting_name != ?"=>""); // You can change it as per required
$options_array = array("orderBy"=>"record_id DESC","limit"=>$per_page,"offset"=>$offset);

//End Configurations


//Search By Columns
if($search_by_columns == "all"){
    $search_by_columns = $meta_keys_array;
}
        ?>

                        <!-- by>s>this,keyword>i -->

                        <div id="accordion" class="w-100 mb-3 d-none">
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

  <?php 
                    foreach($settings_category as $single_category){
                        $where_array = array("setting_category"=>$single_category);
                        ?>
                        <hr>
<h3 class="text-center mt-1 mb-3"><?php echo beautify_meta_name($single_category); ?> Settings</h3>                        
<table class="table table-striped" id="list_table_setting">
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
<?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
?>
<th><?php echo beautify_meta_name($single_column); ?></th>
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
    $options_array = array();

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


$list_records = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);


//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];
    $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);

    ?>
    <tr>
    <?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
        if($single_column == "record_id"){
          ?>
<td class="<?php echo $single_column; ?> <?php echo $single_column."_".$record_id; ?>"><?php echo $record_id;?></td>
          <?php
          continue;
        }
?>
<td class="<?php echo $single_column; ?> <?php echo $single_column."_".create_slug($single_record[$single_column]); ?>"><?php echo $single_record[$single_column];?></td>
  <?php  }
  
  if($show_date_column){
?>
<td><?php echo humanize_date($single_record["date_created"]); ?></td>
<?php
  }
  ?>
  <td>
  <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View/Edit" href="<?php echo $edit_button_url.$record_id; ?>"><i class="fe-edit-1"></i></a>
   <a class="btn btn-danger btn-sm <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fe-trash-2"></i></a>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>

<?php
                    }
                    ?>

<?php
//Only show pagination if search is not queried
if(!isset($_GET["search_by"])){
    if(!isset($_GET["override_limit"])){
    ?>
<!-- Row Starts -->
<div class="row d-none">
<!-- Col 1 -->
        <div class="col-sm-6">
     <?php   if($page > 1){
         $prev_page = $page - 1;
         ?>
        <a href="?page=<?php echo $prev_page; ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
    <?php } ?>
        <?php 
        //Total Records for pagination
        $total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array([$record_type,$where_array,$options_array]);
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
<?php if($enable_export_tools){ ?>
<!-- Col 2 -->
        <div class="col-sm-4">
        <p><strong>Export Tools</strong></p>
        <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_setting"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_setting"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm print_table_setting"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
        </div>
<!-- Col 2 ends -->
<?php } ?>
         </div>
<!-- Row Ends -->
<?php } }
?>
<!-- RAD Featured Table-->


                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
<!-- Add setting Start-->
<div class="modal fade" id="add_setting" tabindex="-1" role="dialog" aria-labelledby="add_setting_LongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo title_case("setting");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- name>i,value>t --&gt<!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_setting_rad5d60c8b0ea37c" class="w-100">
 <div class="form-group ic_setting_name col-md-12 d-inline-block">
         <label class="setting_name" for="setting_name">Name</label>
        <input type="text" class="form-control setting_name" placeholder="Name"  name="setting_name">
            </div>
    <div class="form-group ic_setting_value col-sm-12">
         <label class="setting_value" for="setting_value">Value</label>
        <textarea rows="10" class="form-control setting_value" placeholder="Value" name="setting_value"></textarea>
        </div>
        <div class="form-group ic_setting_category col-md-12 d-inline-block">
             <label class="setting_category" for="setting_category">Category</label>
            <select class="form-control setting_category" name="setting_category">
                    <option value="">Select</option>
                    <?php 
                    foreach($settings_category as $single_category){
                        ?>
                        <option value="<?php echo $single_category;?>"><?php echo beautify_meta_name($single_category);?></option>
                        <?php
                    }
                    ?>
                                                   </select>
                </div>         
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_setting" value="Add Setting" form_id="rad5d60c8b0ea37c"> 
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
<!-- Add setting Ends-->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script>
//         $('#list_table_setting').DataTable({
//     paging: false,
//     info: false,
//     responsive: {
//         details: true
//     },
//     "language" : {
//         "search" : "Search Settings"
//     }

// });
        //Insert variables
        var insert_button_class_setting = ".insert_setting"; // .classname
                var form_id_setting = "#form_setting";  // #entry_form
                var insert_api_url_setting = "api/setting/insert_setting.php"; // /api/insert.php
                var form_id_parameter_name = "form_id";
                
                //Insert Operation
                $(document).on("click",insert_button_class_setting,function(e){
                e.preventDefault();
                var form_to_process_setting = form_id_setting + "_" + $(this).attr(form_id_parameter_name);
        
                $.post(insert_api_url_setting,$(form_to_process_setting).serializeArray(),function(data){
        
                    var response_json_setting = data;
        
                    if(response_json_setting["status"] == "failure"){
                  var get_errors_setting = response_json_setting["errors"];
                  var errors_returned_setting = "";
                  $(get_errors_setting).each(function(index,value){
                    errors_returned_setting = errors_returned_setting + " => " + value;
                        
                    });
                    swal("Error",errors_returned_setting, {
              icon: "error"
            });
        
                    }else{
                    
        
                        //Reset Form
                    // $(form_to_process_setting)[0].reset();
        
                    //Focus to first input
                    $(form_to_process_setting + " input[type=text]").first().focus();
        
                    //To show updated values on same page
                    // $(updated_data_container_class).load(updated_data_file_url);
        
        
                    // Other functions to execure on success
                        //Reload page on success
                        
                        swal("Processing", {
              icon: "success",
              timer: 1000
            }).then(function(){
                location.reload();
            });
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
var records_table_id = "#list_table_setting";
$(".export_to_csv_setting").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_setting").click(function(){
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

$(".print_table_setting").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_setting = ".delete_setting"; // .classname
var primary_record_key_attribute_name_setting = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_setting = "api/setting/delete_setting.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_setting,function(e){
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
  var record_id_setting = $(this).attr(primary_record_key_attribute_name_setting);
    
  $.post(delete_api_url_setting,{"record_id":record_id_setting});

  
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