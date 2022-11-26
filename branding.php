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
                                    
                                    <h4 class="page-title"><?php echo title_case("branding"); ?> <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_branding"><i class="fe-plus"></i> Add <?php echo title_case("branding");?></button> -->
</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                       <!-- RAD Featured Table-->

        <?php

//Configurations
$record_type = "branding";
$show_date_column = false;
$enable_export_tools = false;

//Search
$search_by_columns = "all"; //you can also put "all" or array.
$enable_date_filter = true;
//Columns
$columns_to_list = array('branding_title','branding_logo','branding_color_scheme','branding_footer','branding_logo_width_sm','branding_logo_width_lg');;  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Action Buttons
$edit_button_url = "edit_branding.php?branding_id=";
$view_button_url = "view_branding.php?branding_id=";
$delete_button_class = "delete_branding";
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

//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;


//Initial records query 
$where_array = array("branding_title != ?"=>""); // You can change it as per required
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

<table class="table table-striped" id="list_table_branding">
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

$total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array([$record_type,$where_array]);
$list_records = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);



//Pass thru custom functions
  //Ex function dummy_column($single_column,$dynamic_value,$record_id){    
  //   return "test ".$dynamic_value;
  // }

  
  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id){
  // Ex $allowed_columns = array("dummy_column");
  $allowed_columns = array();

  if(in_array($single_column,$allowed_columns)){  

    $return_value = $single_column($single_column,$dynamic_value,$record_id);  
  
    return $return_value;
}
  }
  //Pass thru Function

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
  <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo $edit_button_url.$record_id; ?>"><i class="fe-edit-1"></i> Edit</a>
   <!-- <a class="btn btn-danger btn-sm <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fe-trash-2"></i></a> -->
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
        <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_branding"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_branding"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
         <a href="javascript:void" class="btn btn-secondary btn-sm print_table_branding"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
<!-- Add branding Start-->
<div class="modal fade" id="add_branding" tabindex="-1" role="dialog" aria-labelledby="add_branding_LongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo title_case("branding");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- title>i,logo>i,color_scheme>s>light/dark --&gt<!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_branding_rad5daab8abe3135" class="w-100">
 <div class="form-group ic_branding_title col-md-5 d-inline-block">
         <label class="branding_title" for="branding_title">Title</label>
        <input type="text" class="form-control branding_title" placeholder="Title"  name="branding_title">
            </div>
 
      <div class="form-group ic_branding_color_scheme col-md-5 d-inline-block">
             <label class="branding_color_scheme" for="branding_color_scheme">Color Scheme</label>
            <select class="form-control branding_color_scheme" name="branding_color_scheme"><option value="light">Light</option><option value="dark">Dark</option></select>
                </div>
                <div class="form-group ic_branding_footer col-md-5 d-inline-block">
         <label class="branding_footer" for="branding_footer">Footer</label>
        <input type="text" class="form-control branding_footer" placeholder="Footer"  name="branding_footer">
            </div>      
                <div class="form-group col-sm-12">
         <label for="branding_logo">Branding Logo</label>
         <input type="hidden" class="form-control" name="branding_logo">             
        <div class="upload_files_branding_logo upload_files_container">

        </div>
        <div class="uploaded_files_branding_logo">
        <ul class="uploaded_file_ids_branding_logo uploaded_files_list_container" style="list-style-type:none;">
        </ul>
        </div>
            </div>

        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_branding" value="Add Branding" form_id="rad5daab8abe3135"> 
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
<!-- Add branding Ends-->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>
        <script src="wsp_rad/assets/js/upload_core.js"></script>
<script src="wsp_rad/assets/js/upload_main.js"></script>

        <script>
        
        //Insert variables
        var insert_button_class_branding = ".insert_branding"; // .classname
                var form_id_branding = "#form_branding";  // #entry_form
                var insert_api_url_branding = "api/branding/insert_branding.php"; // /api/insert.php
                var form_id_parameter_name = "form_id";
                
                //Insert Operation
                $(document).on("click",insert_button_class_branding,function(e){
                e.preventDefault();
                var form_to_process_branding = form_id_branding + "_" + $(this).attr(form_id_parameter_name);
        
                $.post(insert_api_url_branding,$(form_to_process_branding).serializeArray(),function(data){
        
                    var response_json_branding = data;
        
                    if(response_json_branding["status"] == "failure"){
                  var get_errors_branding = response_json_branding["errors"];
                  var errors_returned_branding = "";
                  $(get_errors_branding).each(function(index,value){
                    errors_returned_branding = errors_returned_branding + " => " + value;
                        
                    });
                    swal("Error",errors_returned_branding, {
              icon: "error"
            });
        
                    }else{
                    
        
                        //Reset Form
                    // $(form_to_process_branding)[0].reset();
        
                    //Focus to first input
                    $(form_to_process_branding + " input[type=text]").first().focus();
        
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
var records_table_id = "#list_table_branding";
$(".export_to_csv_branding").click(function(){
$(records_table_id).tableToCSV();
});

$(".export_to_xls_branding").click(function(){
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

$(".print_table_branding").click(function(){
$(records_table_id).printThis({  
beforePrint:beforeprinttable(),
afterPrint:afterprinttable()
});
});

// Delete Operation

var delete_record_button_class_branding = ".delete_branding"; // .classname
var primary_record_key_attribute_name_branding = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_branding = "api/branding/delete_branding.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_branding,function(e){
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
  var record_id_branding = $(this).attr(primary_record_key_attribute_name_branding);
    
  $.post(delete_api_url_branding,{"record_id":record_id_branding});

  
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
  var api_url = "api/branding/delete_branding.php"; //Replace with correct API url
	  
swal("Deleting Selected Entries", {
      icon: "warning",
    });
	  
  $.post(api_url,{"record_id":selected_to_delete_array});
 
 swal("Deletion Success", {
      icon: "success",
    });
    setTimeout(function(){
      location.reload();
    },1000)

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
        $('#list_table_branding').DataTable({
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

//Upload Files code for branding_logo 
var hidden_file_input_name_branding_logo = "branding_logo";
     $(".upload_files_"+hidden_file_input_name_branding_logo).upload({
  action: "api/file_upload/insert_file_upload.php",
  //chunked : true,
 maxConcurrent : 1,
  multiple : true,
  //maxSize : 5000,
  maxFiles : 20,
  leave : 'Files being uploaded, please wait.',
  label : '<i class="fe-upload"></i> Upload Branding Logo',
  autoUpload : true,
  postData: {"meta_key":hidden_file_input_name_branding_logo}
}).on("filestart.upload",uploadFileStart_branding_logo).on("filecomplete.upload",uploadFileComplete_branding_logo);

function uploadFileStart_branding_logo(){
    //Progress
    swal({
            title: "Uploading...",
            text: "Please wait",
            buttons:false,    
            closeOnClickOutside: false
            });
    //Progress
}
var multiple_file_ids_branding_logo = "";
function uploadFileComplete_branding_logo(e,file,response){
    var response_json_file_upload_branding_logo = JSON.parse(response);
    if(response_json_file_upload_branding_logo["status"] == "failure"){
          var get_errors_file_upload_branding_logo = response_json_file_upload_branding_logo["errors"];
          var errors_returned_file_upload_branding_logo = "";
          $(get_errors_file_upload_branding_logo).each(function(index,value){
            errors_returned_file_upload_branding_logo = errors_returned_file_upload_branding_logo + " => " + value;
                
            });
            swal("Error",errors_returned_file_upload_branding_logo, {
      icon: "error"
    });

    		}else{
                var record_id_file_upload_branding_logo = response_json_file_upload_branding_logo["record_id"];
    var unique_identifier_branding_logo = response_json_file_upload_branding_logo["file_upload_identifier"];
    multiple_file_ids_branding_logo = multiple_file_ids_branding_logo + record_id_file_upload_branding_logo + ",";
    $("input[name="+hidden_file_input_name_branding_logo+"]").val(multiple_file_ids_branding_logo.slice(0,-1));

    var current_uploaded_ids_branding_logo = $(".uploaded_file_ids_branding_logo").html();
    $(".uploaded_file_ids_branding_logo").html(current_uploaded_ids_branding_logo + "<li class='file_"+ record_id_file_upload_branding_logo +"'><i class='fe-check-square'></i> " + unique_identifier_branding_logo + " <a href='javascript:void(0)' record_id='"+record_id_file_upload_branding_logo+"' class='delete_file_upload btn btn-sm btn-danger'><i class='fe-trash'></i></a></li>" );
    swal.close();
}
}

   // Delete File Operation

   var delete_record_button_class_file_upload = ".delete_file_upload"; // .classname
var primary_record_key_attribute_name_file_upload = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
var delete_api_url_file_upload = "api/file_upload/delete_file_upload.php"; // /api/delete.php

$(document).on("click",delete_record_button_class_file_upload,function(e){
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
    var record_id_file_upload_branding_logo = $(this).attr(primary_record_key_attribute_name_file_upload);
		  
    $.post(delete_api_url_file_upload,{"record_id":record_id_file_upload_branding_logo});

    
                swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        swal("File Deleted Successfully");
        $(".file_"+record_id_file_upload_branding_logo).remove(); 
        //Loop uploaded files
        multiple_file_ids_branding_logo = "";
        $(".uploaded_file_ids_branding_logo li").each(function(index,value){
          var this_record_id = $(this).children("a").attr("record_id");
          multiple_file_ids_branding_logo = multiple_file_ids_branding_logo + this_record_id + ",";
        });
        $("input[name="+hidden_file_input_name_branding_logo+"]").val(multiple_file_ids_branding_logo.slice(0,-1));
    });
    
  } 
});
});
//Upload Files code for branding_logo ends

        </script>
<?php include("footer.php"); ?>