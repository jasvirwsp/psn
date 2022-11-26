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
<?php 
  $record_type_trash = "trash";
  $record_human_trash = beautify_meta_name($record_type_trash);
  $record_id_trash = safe_get("trash_id");
  $record_meta_trash =get_rec_meta_by_rec_id($record_type_trash,$record_id_trash);

  $columns_to_list_trash = "all";
  $columns_to_exclude_trash = array("");
  
  //Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type_trash;
$meta_keys_array =  $$meta_keys_array_name;

//set columns
$selected_columns_trash = array($meta_keys_array[0],$meta_keys_array[1]); // if columns_to_list_trash is blank select first two automatically
if($columns_to_list_trash == "all"){
    $selected_columns_trash = $meta_keys_array;
}
if(is_array($columns_to_list_trash)){
    $selected_columns_trash = $columns_to_list_trash;
}

  ?>
  <!-- start page title -->
  <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title"><?php echo $record_human_trash; ?> <!-- Button trigger modal -->
</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
<h3 class="text-center"><?php echo $record_human_trash; ?> ID : <?php echo $record_id_trash; ?> <a href="edit_<?php echo $record_type_trash; ?>.php?<?php echo $record_type_trash; ?>_id=<?php echo $record_id_trash; ?>" class="btn btn-secondary btn-sm">Edit <?php echo $record_human_trash; ?></a> <a href="javascript:void(0)" class="print_table btn btn-warning btn-sm"> Print</a></h3>

                        <table class="table table-striped mb-0 trashs_table">
                                            <thead>
                                            <tr>                                               
                                                <th colspan="2" class="text-center"><?php echo $record_human_trash; ?> Details</th>
                                                         
                                            </tr>
                                            </thead>
                                            <tbody>
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
?>

                                            <?php
    foreach($selected_columns_trash as $single_column_trash){
        if(in_array($single_column_trash,$columns_to_exclude_trash)){
            continue;
        }
        if($single_column_trash == "record_id"){
         continue;
        }
?>

 <tr>
                                            
                                            <td>
                                            <?php echo pass_thru_title($single_column_trash) ?: beautify_meta_name_and_exclude_rec($single_column_trash); ?>  </td>
                                            <td>
                                            <?php echo pass_thru($single_column_trash,get_single_value($record_meta_trash,$single_column_trash),$record_id,$record_meta_trash) ?: beautify_meta_name(get_single_value($record_meta_trash,$single_column_trash));?>
                                                </td>
                                        </tr>

  <?php  } ?>
                                           
                                           
                                           
                                            </tbody>
                                        </table>




                        
                    </div> <!-- container -->

                </div> <!-- content -->


                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script>
       


function beforeprinttable(){
  $(records_table_id+" th:last-child,"+ records_table_id + " td:last-child").hide();
};

function afterprinttable(){
setInterval(function(){
  $(records_table_id + " th:last-child,"+ records_table_id + " td:last-child").show();
},1000);
};

$(".print_table").click(function(){
$(".trashs_table").printThis();
});

        </script>
<?php include("footer.php"); ?>