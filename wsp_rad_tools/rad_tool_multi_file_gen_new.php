<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>File Upload New</title>
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
<form method="post" action="" id="form_api">
        <div class="form-group">
         <label for="api_name">Input Meta Name</label>
        <input type="text" class="form-control" placeholder="Name"  name="api_name">
            </div>            

        <input type="submit" class="btn btn-success btn-lg insert_api" value="Generate"> 
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
<h2>Multi File upload on new record for meta <?php echo $api_name; ?></h2>
<h2>CSS</h2>
<textarea class="select_this" rows="5">
&lt;link href="wsp_rad/assets/css/upload.css" rel="stylesheet" type="text/css" /&gt;
</textarea>

<h2>Custom CSS</h2>
<textarea class="select_this" rows="5">
.upload_files_container{
    border:2px dotted grey;
    border-radius:10px;
    padding:10px;
}
.uploaded_files_list_container li{
    border:2px dotted grey;
    border-radius:10px;
    padding:5px;
    margin-top:5px;
}
</textarea>



<h2>HTML</h2>
<textarea class="select_this" rows="5">
&lt;div class="form-group col-sm-12"&gt;
         &lt;label for="<?php echo $api_name; ?>"&gt;<?php echo beautify_meta_name_and_exclude_rec($api_name); ?>&lt;/label&gt;
         &lt;input type="hidden" class="form-control" name="<?php echo $api_name; ?>"&gt;             
        &lt;div class="upload_files_<?php echo $api_name; ?> upload_files_container"&gt;

        &lt;/div&gt;
        &lt;div class="uploaded_files_<?php echo $api_name; ?>"&gt;
        &lt;ul class="uploaded_file_ids_<?php echo $api_name; ?> uploaded_files_list_container" style="list-style-type:none;"&gt;
        &lt;/ul&gt;
        &lt;/div&gt;
            &lt;/div&gt;
</textarea>
<h2>Scripts</h2>
<textarea class="select_this" rows="5">
&lt;script src="wsp_rad/assets/js/upload_core.js"&gt;&lt;/script&gt;
&lt;script src="wsp_rad/assets/js/upload_main.js"&gt;&lt;/script&gt;
</textarea>
<h2>Javascript</h2>
<textarea class="select_this" rows="5">
//Upload Files code for <?php echo $api_name; ?> 
var hidden_file_input_name_<?php echo $api_name; ?> = "<?php echo $api_name; ?>";
     $(".upload_files_"+hidden_file_input_name_<?php echo $api_name; ?>).upload({
  action: "api/file_upload/insert_file_upload.php",
  //chunked : true,
 maxConcurrent : 1,
  multiple : true,
  maxSize : 500000000000000000,
  maxFiles : 20,
  leave : 'Files being uploaded, please wait.',
  label : '<i class="fe-upload"></i> Click here to Upload',
  autoUpload : true,
  postData: {"meta_key":hidden_file_input_name_<?php echo $api_name; ?>}
}).on("filestart.upload",uploadFileStart_<?php echo $api_name; ?>).on("filecomplete.upload",uploadFileComplete_<?php echo $api_name; ?>);

function uploadFileStart_<?php echo $api_name; ?>(){
    //Progress
    swal({
            title: "Uploading...",
            text: "Please wait",
            buttons:false,    
            closeOnClickOutside: false
            });
    //Progress
}
var multiple_file_ids_<?php echo $api_name; ?> = "";
function uploadFileComplete_<?php echo $api_name; ?>(e,file,response){
    var response_json_file_upload_<?php echo $api_name; ?> = JSON.parse(response);
    if(response_json_file_upload_<?php echo $api_name; ?>["status"] == "failure"){
          var get_errors_file_upload_<?php echo $api_name; ?> = response_json_file_upload_<?php echo $api_name; ?>["errors"];
          var errors_returned_file_upload_<?php echo $api_name; ?> = "";
          $(get_errors_file_upload_<?php echo $api_name; ?>).each(function(index,value){
            errors_returned_file_upload_<?php echo $api_name; ?> = errors_returned_file_upload_<?php echo $api_name; ?> + " =&gt; " + value;
                
            });
            swal("Error",errors_returned_file_upload_<?php echo $api_name; ?>, {
      icon: "error"
    });

    		}else{
                var record_id_file_upload_<?php echo $api_name; ?> = response_json_file_upload_<?php echo $api_name; ?>["record_id"];
                var file_name_<?php echo $api_name; ?> = response_json_file_upload_<?php echo $api_name; ?>["file_name"];
    var unique_identifier_<?php echo $api_name; ?> = response_json_file_upload_<?php echo $api_name; ?>["file_upload_identifier"];
    multiple_file_ids_<?php echo $api_name; ?> = multiple_file_ids_<?php echo $api_name; ?> + record_id_file_upload_<?php echo $api_name; ?> + ",";
    $("input[name="+hidden_file_input_name_<?php echo $api_name; ?>+"]").val(multiple_file_ids_<?php echo $api_name; ?>.slice(0,-1));

    var current_uploaded_ids_<?php echo $api_name; ?> = $(".uploaded_file_ids_<?php echo $api_name; ?>").html();
    $(".uploaded_file_ids_<?php echo $api_name; ?>").html(current_uploaded_ids_<?php echo $api_name; ?> + "&lt;li class='file_"+ record_id_file_upload_<?php echo $api_name; ?> +"'&gt;&lt;i class='fe-check-square'&gt;&lt;/i&gt; " + file_name_<?php echo $api_name; ?> + "  &lt;a target='_blank' href='uploads/" + unique_identifier_<?php echo $api_name; ?> + "' class='btn btn-sm btn-success'&gt;&lt;i class='fe-eye'&gt;&lt;/i&gt; View&lt;/a&gt; &lt;a href='javascript:void(0)' record_id='"+record_id_file_upload_<?php echo $api_name; ?>+"' class='delete_file_upload btn btn-sm btn-danger'&gt;&lt;i class='fe-trash'&gt;&lt;/i&gt;&lt;/a&gt;&lt;/li&gt;" );
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
.then((willDelete) =&gt; {
  if (willDelete) {
    var record_id_file_upload_<?php echo $api_name; ?> = $(this).attr(primary_record_key_attribute_name_file_upload);
		  
    $.post(delete_api_url_file_upload,{"record_id":record_id_file_upload_<?php echo $api_name; ?>});

    
                swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        swal("File Deleted Successfully");
        $(".file_"+record_id_file_upload_<?php echo $api_name; ?>).remove(); 
        //Loop uploaded files
        multiple_file_ids_<?php echo $api_name; ?> = "";
        $(".uploaded_file_ids_<?php echo $api_name; ?> li").each(function(index,value){
          var this_record_id = $(this).children("a").attr("record_id");
          multiple_file_ids_<?php echo $api_name; ?> = multiple_file_ids_<?php echo $api_name; ?> + this_record_id + ",";
        });
        $("input[name="+hidden_file_input_name_<?php echo $api_name; ?>+"]").val(multiple_file_ids_<?php echo $api_name; ?>.slice(0,-1));
    });
    
  } 
});
});
//Upload Files code for <?php echo $api_name; ?> ends
</textarea>

<h2>Set file validations(Edit api > file_upload > insert_file_upload.php) Append in allowed extensions with below or desired</h2>
<textarea class="select_this" rows="5">
		"<?php echo $api_name; ?>" => array("jpg","jpeg","JPG","JPEG","png","PNG","gif","docx","xlsx","pdf","txt")
</textarea>

<?php 
} ?>

</div>
<!-- Container ends -->

 <!--   Core JS Files   -->
 <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>

$(".select_this").click(function(){
    console.log("test");
    $(this).select();
});

</script>
</body>