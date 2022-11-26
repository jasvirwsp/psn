<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Query Gen</title>
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
                                    
                                    <h4 class="page-title">Generate Query</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                                        <!-- type>s>fetch/insert/update/delete,rec_type>i -->

        <!-- Form Row Starts -->
        <div class="row">
        <form method="post" action="" id="form_query_rad5dfd258c038aa" class="w-100">        
        <div class="form-group ic_query_type col-md-5 d-inline-block">
             <label class="query_type" for="query_type">Type</label>
            <select class="form-control query_type" name="query_type">
                    <option value="fetch">Fetch</option>
                                              <option value="insert">Insert</option>
                                              <option value="update">Update</option>
                                              <option value="delete">Delete</option>
                                                   </select>
                </div>            
<div class="form-group ic_query_rec_type col-md-5 d-inline-block">
         <label class="query_rec_type" for="query_rec_type">Rec Type</label>
        <input type="text" class="form-control query_rec_type" placeholder="Rec Type"  name="query_rec_type" value="<?php echo safe_post("query_rec_type") ?: ""; ?>">
            </div>            
            <div class="form-group ic_query_purpose col-md-5 d-inline-block">
         <label class="query_purpose" for="query_purpose">Purpose(Optional)</label>
        <input type="text" class="form-control query_purpose" placeholder="Purpose"  name="query_purpose" value="<?php echo safe_post("query_purpose") ?: ""; ?>">
            </div>   
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-success btn-sm insert_query" value="Get Query" form_id="rad5dfd258c038aa"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
        
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php 
                                if(safe_post("query_type") != ""){
                                    $query_type =safe_post("query_type");
                                    $record_type = safe_post("query_rec_type");
                                    $purpose = safe_post("query_purpose");
?>
<h3><?php echo safe_post("query_type"); ?> query for <?php echo safe_post("query_rec_type"); ?> <?php echo safe_post("query_purpose"); ?></h3>


<!-- Case  -->
<?php
if($query_type == "fetch"){
?>
<h3>Fetch with where</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
    $where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(""=>"");
    $options_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array();
    $results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $records_fetch_controller->fetch_record_with_where(["<?php echo  $record_type ; ?>",$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$options_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
    $count_results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = count($results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>);
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>

<hr>

<h3>Fetch with where and loop</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
    $where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(""=>"");
    $options_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array();
    $results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $records_fetch_controller->fetch_record_with_where(["<?php echo  $record_type ; ?>",$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$options_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
    $count_results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = count($results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>);
    //Lets loop through 
                            foreach($results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> as $single_result_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>){
                                $rec_id_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $single_result_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>["record_id"];                               
 ?&gt;

       &lt?php } 
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>

<hr>

<h3>Fetch Just count with where</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
    $where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(""=>"");
    $results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>_count = $records_fetch_controller->fetch_count_by_record_type_and_where_array(["<?php echo  $record_type ; ?>",$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>

<hr>

<h3>Fetch For select options</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(""=>"");
$results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $records_fetch_controller->fetch_record_with_where(["<?php echo  $record_type ; ?>",$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
$count_results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = count($results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>);

//Lets loop through washing machine
                        foreach($results_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> as $single_result_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>){
?&gt;
<option value="&lt;?php echo $single_result_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>["record_id"];?>">&lt;?php echo beautify_meta_name($single_result_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>[""]);?></option>
                           &lt;?php
                        } 
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>
<?php
}
?>
<!-- Case  -->

<!-- Case  -->
<?php
if($query_type == "insert"){
    //Get meta keys of record type
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
?>
<h3>Insert directly</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
$record_insert_controller = new records_insert_controller();
$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = "<?php echo $record_type;?>";
<?php $insert_array_string_ = "";
    $count_s = 1;
    $count_z = 1;
foreach($meta_keys_array as $input_name){    

if($count_s == 1){    
}else{
    $insert_array_string .= '
    "'.$input_name.'"=>safe_post('.$input_name.'),';
}
if($count_s != 1){
    $count_z++;
}
    $count_s++;
    
}
$insert_array_string .= '
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
    "'.$record_type.'_insert_author"=>""';
$insert_array_string = rtrim($insert_array_string,",");
?>
$record_type_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(<?php echo $insert_array_string; ?>
    
                            );
$insert_record_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $record_insert_controller->insert_record([$record_type_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
$insert_id_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $insert_record_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>["record_id"];
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>
<hr>

<?php
}
?>
<!-- Case  -->


<!-- Case  -->
<?php
if($query_type == "update"){ 
    //Get meta keys of record type
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;  
?>
<h3>Update with where</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
$record_update_controller = new records_update_controller();
$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = "<?php echo $record_type;?>";
<?php $insert_array_string_ = "";
    $count_s = 1;
    $count_z = 1;
foreach($meta_keys_array as $input_name){    

if($count_s == 1){    
}else{
    $insert_array_string .= '
    "'.$input_name.'"=>safe_post('.$input_name.'),';
}
if($count_s != 1){
    $count_z++;
}
    $count_s++;
    
}
$insert_array_string .= '
   "date_updated"=>generate_mysql_timestamp()';
$insert_array_string = rtrim($insert_array_string,",");
?>
$update_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array(<?php echo $insert_array_string; ?>

                            );
$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array();
$update_record_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $record_update_controller->update_record_with_new_values_and_where([$update_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>
<hr>
<?php
}
?>
<!-- Case  -->


<!-- Case  -->
<?php
if($query_type == "delete"){ 
   
?>
<h3>Delete with record_id</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
$record_delete_controller = new records_delete_controller();
$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = "<?php echo $record_type;?>";
$record_delete_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>  = $record_delete_controller->delete_record_with_record_id([$rec_id,$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>
<hr>

<h3>Delete with where</h3>
<textarea class="select_this form-control" cols="10" rows="10">
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?> <?php echo  $purpose ; ?> #start
$record_delete_controller = new records_delete_controller();
$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = "<?php echo $record_type;?>";
$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = array();
$record_delete_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?> = $record_delete_controller->delete_record_with_where([$where_array_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>,$record_type_<?php echo  $record_type ; ?>_<?php echo  $purpose ; ?>]);
//<?php echo  $query_type ; ?> query of <?php echo  $record_type ; ?>  <?php echo  $purpose ; ?> #ends    
</textarea>
<hr>
<?php
}
?>
<!-- Case  -->
<?php
                                }
                                ?>
                            </div>
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});
</script>
<?php include("footer.php"); ?>