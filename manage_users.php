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
                                   
                                    <h4 class="page-title">Manage users</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- RAD Featured Table-->
        <?php

//Configurations
$record_type = "user";
//Permission Check
check_record_type_ownership($user_role, $record_type);
//Permission Check
//Search
$search_by_columns = array("user_name"); //you can also put "all" or array.
$enable_date_filter = false;
//Columns
$columns_to_list = array("id","user_name","user","email","role","access_token","auth_token");  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_user.php?user_id=";
$view_button_url = "view_user.php?user_id=";
$delete_button_class = "delete_user";
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
$where_array = array("user != ?"=>"");
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
                                                    
                                                    
                        
                                                    
                                                                  

<table class="table table-striped table-responsive" id="list_table_user">
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
<th><?php echo pass_thru_title($single_column) ?: beautify_meta_name_and_exclude_rec($single_column); ?></th>
<?php
}
?>
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

    if(isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")){        
        $start_date = safe_get("search_start_date");
        $end_date = safe_get("search_end_date");
        $options_array = array("between"=>"date(date_created),".$start_date.",".$end_date);
    }
}

$total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array(["users",$where_array]);
$list_records = $user_fetch_controller->fetch_user_with_where($where_array,$options_array);


//Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //  if($dynamic_value){
  //   return "test ".$dynamic_value;
  // }
  //}

  
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

$total_users = 0;
//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["id"];
    ?>
    <tr>
    <?php
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
?>
<td class="<?php echo $single_column; ?> <?php echo $single_column."_".create_slug(get_single_value($record_meta,$single_column)); ?>"><?php echo pass_thru($single_column,$single_record[$single_column],$record_id,$single_record) ?: $single_record[$single_column];?></td>
  <?php  }
  ?>
  <td>
  <a class="btn mb-1 btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Change Password" href="change_password.php?user_id=<?php echo $record_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Change Password</a>
  <a class="btn mb-1 btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View/Edit" href="<?php echo $edit_button_url.$record_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Edit / View</a>
   <a class="btn mb-1 btn-danger btn-sm <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href="javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
  </td>
  </tr>
  <?php
}
?>
</tbody>
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
                </div> <!-- content -->
               
                
<?php include("core_scripts.php");?>

<!-- Plugins js -->
        <script src="wsp_rad/assets/js/printThis.js"></script>
    <script src="wsp_rad/assets/js/jquery.tabletoCSV.js"></script>
    <script src="wsp_rad/assets/js/export_to_xls.js"></script>
    <script>
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
var records_table_id = "#list_table_user";
$(".export_to_csv_user").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_user").click(function(){
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

$(".print_table_user").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_user = ".delete_user"; // .classname
var primary_record_key_attribute_name_user = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_user = "api/user/delete_user.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_user,function(e){
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
  var record_id_user = $(this).attr(primary_record_key_attribute_name_user);
    
  $.post(delete_api_url_user,{"record_id":record_id_user});

  
              swal("Processing", {
    icon: "success",
    timer: 1000
  }).then(function(){
    location.reload();
  });
  
} 
});
});
</script>

<?php include("footer.php"); ?>