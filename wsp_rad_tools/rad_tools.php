<?php include("../wsp_rad/wsp_rad.inc.php");

enable_errors(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Tools</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!-- Bootstrap core CSS     -->
    <link href="../wsp_rad/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <style>
.select_this{margin:20px 0;width:100%;}
.enter_field{width:100%;font-size:30px;font-weight:bold;font-family:Helvetica}
.col-sm-6{display:inline-block}
</style>
</head>

<body>
<div class="container-fluid">
<h2>WSP RAD Tools</h2><br><br>

<h2>Mega Generator</h2>
<br>
<a href="rad_tool_mega_generator.php" target="_blank" class="btn btn-sm btn-info">Mega Generator</a><br><br>
<h2>Steps Generators</h2>
<br>
Tool: <a href="rad_tool_inputs_generator.php" target="_blank" class="btn btn-sm btn-info">Inputs Generator</a> <a href="rad_tools_inputs_generator_f7.php" target="_blank" class="btn btn-sm btn-danger">Inputs Generator F7</a><br><br>
<!-- Step 2: <a href="rad_tool_generate_modal.php" target="_blank" class="btn btn-sm btn-info">Modal Generator</a> <br><br> -->
Tool: <a href="create_table_from_meta_array.php" target="_blank" class="btn btn-sm btn-info">Create Table</a> <br><br>
Tool: <a href="alter_table_with_new_meta.php" target="_blank" class="btn btn-sm btn-info">Alter Table With New Column</a> <br><br>
<!-- Tool: <a href="rad_tool_gen_table.php" target="_blank" class="btn btn-sm btn-info">Featured Table Generator</a> <br><br> -->
Tool: <a href="rad_tool_multi_item_table_generator_new.php" target="_blank" class="btn btn-sm btn-info">Multi Item Table Generator New</a> <br><br>
Tool: <a href="rad_tool_multi_item_table_generator_existing.php" target="_blank" class="btn btn-sm btn-info">Multi Item Table Generator Existing</a> <br><br>
Tool:<a href="rad_tool_auto_suggestion_gen.php" target="_blank" class="btn btn-sm btn-info">Auto Suggest Generator</a>
<br><br>
Tool:<a href="rad_tool_query_gen.php" target="_blank" class="btn btn-sm btn-info">Query Gen</a>
<br><br>
Tool:<a href="rad_tool_rename_rectype.php" target="_blank" class="btn btn-sm btn-info">Rename RecType</a>
<br><br>
Tool:<a href="rad_tool_customize_fields.php" target="_blank" class="btn btn-sm btn-info">Customize Fields</a>
<br><br>
Tool:<a href="../wsp_rad/config/mysql.php" target="_blank" class="btn btn-sm btn-info">DB Manager</a>
<br><br>
<!-- Step 6 (Only If need file upload):<a href="rad_tool_gen_file_upload_tables.php" target="_blank" class="btn btn-sm btn-info">Generate File Upload Tables</a> -->
<br><br>
<h2>File Uploading</h2>
<a href="rad_tool_multi_file_gen_new.php" target="_blank" class="btn btn-sm btn-info">Multi File Upload on New Record</a> <a href="rad_tool_multi_file_gen_existing.php" target="_blank" class="btn btn-sm btn-info">Multi File Upload on Existing Record</a> <br><br>
<a href="rad_tool_single_file_gen_new.php" target="_blank" class="btn btn-sm btn-warning">Single File Upload on New Record</a> <a href="rad_tool_single_file_gen_existing.php" target="_blank" class="btn btn-sm btn-warning">Single File Upload on Existing Record</a> 
<br><br>
<h2>Other RAD Tools</h2>
<a href="rad_tool_meta_keys_gen.php" target="_blank" class="btn btn-sm btn-info">Meta Keys Generator</a> <a href="rad_tool_wsp_rad/rad_options" target="_blank" class="btn btn-sm btn-info">RAD Options</a> <a href="rad_tool_led_generator.php" target="_blank" class="btn btn-sm btn-info">LED to Tubelight Generator</a> 
<h2>Migration Tools</h2>
<a href="rad_tool_meta_table_gen.php" target="_blank" class="btn btn-sm btn-info">Custom Record and Meta Table Generator</a> <a href="rad_tool_export_record_table.php" target="_blank" class="btn btn-sm btn-info">Export Record / Meta Table</a> <a href="rad_tool_csv_to_sql.php" target="_blank" class="btn btn-sm btn-info">CSV To SQL</a>  <a href="rad_tool_import_sql.php" target="_blank" class="btn btn-sm btn-info">SQL Import</a>
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