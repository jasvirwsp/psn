<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php //include("logging.php");
$unique_id = uniqid("rad");
?>
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
        .select_this {
            margin: 20px 0;
            width: 90%;
        }

        .enter_field {
            width: 100%;
            font-size: 30px;
            font-weight: bold;
            font-family: Helvetica
        }

        .col-sm-6 {
            display: inline-block
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <form method="post" action="">
            <label>Record Type</label>
            <input type="text" name="record_type" placeholder="Record Type" class="enter_field form-control" value="<?php if (isset($_POST["record_type"])) {
                                                                                                                        echo $_POST["record_type"];
                                                                                                                    } ?>"><br>
            <br>
            <label>1. Inputs to generate(example name>i [name is input name and i is input,<br> 2.You can use h for hidden and s for select(for options use another delimited ">" and put options with slashes option1/option1)], <br>3.Separate inputs with comma<br> 4.To get input type number put name>i>n <br> 5. For custom date give input name "custom_date".
                <br> 6. for radio test>r>Gender>M/F/O and for inline test>r>Gender>M/F/O>inline<br> 6. for radio test>r>Main Title>value1/value2 and for inline test>r>Main Title>value1/value2>inline <br> 7. for checkbox test>c>Main Title>value1/value2 and for inline test>c>Main Title>value1/value2</label>
            <textarea class="enter_field form-control" name="inputs_to_generate" rows="10" placeholder="Enter Input Names Separatedy by , comma" cols="20"><?php if (isset($_POST["inputs_to_generate"])) {
                                                                                                                                                                echo $_POST["inputs_to_generate"];
                                                                                                                                                            } ?></textarea>
            <br>
            <input type="submit" class="btn btn-info">
        </form>
        <br>
        <?php if (isset($_POST["inputs_to_generate"])) {
            $col_class = "col-md-6 d-inline-block";
            $inputs = $_POST["inputs_to_generate"];
            $inputs = preg_replace("/\r|\n/", "", $inputs);
            $explode_inputs = explode(",", $inputs);
            $record_type = $_POST["record_type"] . "_";
            $rec_type = $_POST["record_type"];
            $inputs_count = count($explode_inputs);
        ?>          
          
         
          
            <!-- Row Starts -->
            <div class="row">
               
              
                    <?php
                    $meta_keys_array = "'record_id',";
                  } ?>
               

                <!-- Col 2 -->
                <div class="col-sm-12">
                    <h3>Insert form</h3>

                    <textarea class="select_this form-control" cols="10" rows="25">
        <?php
        if (isset($_POST["inputs_to_generate"])) { ?>
        &lt;!-- <?php echo $inputs; ?> --&gt;

        &lt!-- Form Row Starts --&gt;
        &lt;form method="post" action="" id="form_<?php echo $rec_type . "_" . $unique_id; ?>"&gt;   
        &lt;div class="row"&gt;            
<?php
            $how_many_columns = 3;
            $col_size = 12 / $how_many_columns;

            foreach ($explode_inputs as $input_name) {


                $explode_type = explode(">", $input_name);
                $type = $explode_type[1];
                $raw_html_name = $explode_type[0];
                $html_name = $record_type . $explode_type[0];
                $human_readable = ucwords(str_replace("_", " ", $explode_type[0]));
?>
<?php if ($type == "i") {
                    @$sub_type = $explode_type[2];
                    $sub_type_html = "text";
                    if (isset($sub_type)) {
                        if ($sub_type == "n") {
                            $sub_type_html = "number";
                        }
                        if ($sub_type == "p") {
                            $sub_type_html = "password";
                        }
                        if ($sub_type == "e") {
                            $sub_type_html = "email";
                        }
                        if ($sub_type == "d") {
                            $sub_type_html = "date";
                        }
                    } else {
                        $sub_type_html = "text";
                    }
?>
&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
         &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
        &lt;input type="<?php echo $sub_type_html; ?>" class="form-control <?php echo $html_name; ?>" placeholder="<?php echo $human_readable; ?>"  name="<?php echo $html_name; ?>"&gt;
            &lt;/div&gt;<?php } ?>
<?php if ($type == "h") { ?>
&lt;input type="hidden" class="form-control <?php echo $html_name; ?>" name="<?php echo $html_name; ?>"&gt; <?php } ?>
<?php if ($type == "t") { ?>
&lt;div class="form-group ic_<?php echo $html_name; ?> col-sm-12"&gt;
         &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
        &lt;textarea class="form-control <?php echo $html_name; ?>" placeholder="<?php echo $human_readable; ?>" name="<?php echo $html_name; ?>"&gt;&lt;/textarea&gt;
        &lt;/div&gt;<?php } ?>
<?php if ($type == "s") {
                    $get_options = explode("/", $explode_type[2]);
?>
        &lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
            &lt;select class="form-control <?php echo $html_name; ?>" name="<?php echo $html_name; ?>"&gt;
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
                        if ($single_option == "select") {
                            $single_option = "";
                        }
            ?>
        &lt;option value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?>&lt;/option&gt;
                                      <?php } ?>             &lt;/select&gt;
                &lt;/div&gt;
                <?php } ?>
                <?php if ($type == "r") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?>&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $radio_label; ?>&lt;/label&gt;  &lt;/br&gt;    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?>&lt;div class="form-check<?php echo $inline_yes; ?>"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="radio" name="<?php echo $html_name; ?>" value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?> 
            &lt;/label&gt; 
            &lt;/div&gt;
            <?php } ?>&lt;/div&gt;<?php } ?>
<?php if ($type == "c") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?>&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $radio_label; ?>&lt;/label&gt;  &lt;/br&gt;    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?>&lt;div class="form-check<?php echo $inline_yes; ?>"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="checkbox" name="<?php echo $html_name; ?>[]" value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?> 
            &lt;/label&gt; 
            &lt;/div&gt;
            <?php } ?>&lt;/div&gt;<?php } ?>      

<?php }
?>
        &lt;div class="form-group col-md-12"&gt;
        &lt;input type="submit" class="btn btn-success btn-sm insert_<?php echo $rec_type; ?>" value="Add <?php echo beautify_meta_name($rec_type); ?>" form_id="<?php echo $unique_id; ?>"&gt; 
        &lt;/div&gt;
        &lt;/div&gt;
        &lt;/form&gt;        
        &lt!-- Form Row Ends --&gt;
        <?php } ?></textarea>
                    <h3>Insert Javascript</h3>
                    <textarea class="select_this form-control" cols="10" rows="25">

        //Insert variables
var insert_button_class_<?php echo $rec_type; ?> = ".insert_<?php echo $rec_type; ?>"; // .classname
    	var form_id_<?php echo $rec_type; ?> = "#form_<?php echo $rec_type; ?>";  // #entry_form
    	var insert_api_url_<?php echo $rec_type; ?> = "api/<?php echo $rec_type; ?>/insert_<?php echo $rec_type; ?>.php"; // /api/insert.php
        var form_id_parameter_name = "form_id";
    	
    	//Insert Operation
    	$(document).on("click",insert_button_class_<?php echo $rec_type; ?>,function(e){
    	e.preventDefault();
    	var form_to_process_<?php echo $rec_type; ?> = form_id_<?php echo $rec_type; ?> + "_" + $(this).attr(form_id_parameter_name);

    	$.post(insert_api_url_<?php echo $rec_type; ?>,$(form_to_process_<?php echo $rec_type; ?>).serializeArray(),function(data){

    		var response_json_<?php echo $rec_type; ?> = data;

    		if(response_json_<?php echo $rec_type; ?>["status"] == "failure"){
          var get_errors_<?php echo $rec_type; ?> = response_json_<?php echo $rec_type; ?>["errors"];
          var errors_returned_<?php echo $rec_type; ?> = "";
          $(get_errors_<?php echo $rec_type; ?>).each(function(index,value){
            errors_returned_<?php echo $rec_type; ?> = errors_returned_<?php echo $rec_type; ?> + " => " + value;
                
            });
            swal("Error",errors_returned_<?php echo $rec_type; ?>, {
      icon: "error"
    });

    		}else{
    		

    			//Reset Form
    		// $(form_to_process_<?php echo $rec_type; ?>)[0].reset();

    		//Focus to first input
    		$(form_to_process_<?php echo $rec_type; ?> + " input[type=text]").first().focus();

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
  
        </textarea>
                    <h3>Update form</h3>

                    <textarea class="select_this form-control" cols="10" rows="25">
        <?php
        if (isset($_POST["inputs_to_generate"])) { ?>
        &lt!-- Form Row Starts --&gt;
        &lt;form method="post" action="" id="form_update_<?php echo $rec_type . "_" . $unique_id; ?>"&gt;
        &lt;div class="row"&gt;       
        &lt;?php $rec_id = $_GET["<?php echo $rec_type ?>_id"];
        $record_type = "<?php echo $rec_type ?>";
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo '&lt;script&gt;
            alert("No Details Found for Record ID: '.$rec_id.'");
            &lt;/script&gt;';
            exit();
            
        }
        ?&gt;
        &lt;input type="hidden" name="record_id" value="&lt;?php echo $rec_id; ?&gt;">
<?php
            $how_many_columns = 3;
            $col_size = 12 / $how_many_columns;

            foreach ($explode_inputs as $input_name) {
                $col_class = "col-md-6 d-inline-block";

                $explode_type = explode(">", $input_name);
                $type = $explode_type[1];
                $raw_html_name = $explode_type[0];
                $html_name = $record_type . $explode_type[0];
                $human_readable = ucwords(str_replace("_", " ", $explode_type[0]));
?>
<?php if ($type == "i") {
                    @$sub_type = $explode_type[2];
                    $sub_type_html = "text";
                    if (isset($sub_type)) {
                        if ($sub_type == "n") {
                            $sub_type_html = "number";
                        }
                        if ($sub_type == "p") {
                            $sub_type_html = "password";
                        }
                        if ($sub_type == "e") {
                            $sub_type_html = "email";
                        }
                        if ($sub_type == "d") {
                            $sub_type_html = "date";
                        }
                    } else {
                        $sub_type_html = "text";
                    }
?>

&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
         &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
        &lt;input type="<?php echo $sub_type_html; ?>" class="form-control <?php echo $html_name; ?>" placeholder="<?php echo $human_readable; ?>" name="<?php echo $html_name; ?>" value="&lt;?php echo get_single_value($rec_meta,"<?php echo $html_name; ?>"); ?&gt;"&gt;
            &lt;/div&gt;<?php } ?>
<?php if ($type == "h") { ?>
&lt;input type="hidden" class="form-control <?php echo $html_name; ?>" name="<?php echo $html_name; ?>"&gt; <?php } ?>
<?php if ($type == "t") { ?>
&lt;div class="form-group ic_<?php echo $html_name; ?> col-sm-12"&gt;
         &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
        &lt;textarea class="form-control <?php echo $html_name; ?>" placeholder="<?php echo $human_readable; ?>" name="<?php echo $html_name; ?>"&gt;&lt;?php echo get_single_value($rec_meta,"<?php echo $html_name; ?>"); ?&gt;&lt;/textarea&gt;
        &lt;/div&gt;<?php } ?>
<?php if ($type == "s") {
                    $get_options = explode("/", $explode_type[2]);
?>
        &lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?>" for="<?php echo $html_name; ?>"&gt;<?php echo $human_readable; ?>&lt;/label&gt;
            &lt;select class="form-control db_auto_chose" name="<?php echo $html_name; ?>" db_auto_chose_value="&lt;?php echo get_single_value($rec_meta,"<?php echo $html_name; ?>"); ?&gt;"&gt;
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
                        if ($single_option == "select") {
                            $single_option = "";
                        }
            ?>
        &lt;option value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?>&lt;/option&gt;
                                      <?php } ?>             &lt;/select&gt;
                &lt;/div&gt;<?php } ?>        
                <?php if ($type == "r") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?>&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?> db_radio_check" db_radio_check_value="&lt;?php echo get_single_value($rec_meta,"<?php echo $html_name; ?>"); ?&gt;" for="<?php echo $html_name; ?>"&gt;<?php echo $radio_label; ?>&lt;/label&gt;  &lt;/br&gt;    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?>&lt;div class="form-check<?php echo $inline_yes; ?>"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="radio" name="<?php echo $html_name; ?>" value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?> 
            &lt;/label&gt; 
            &lt;/div&gt;
            <?php } ?>           
                &lt;/div&gt;<?php } ?>        
                <?php if ($type == "c") {
                    $get_options = explode("/", $explode_type[3]);
                    $radio_label = $explode_type[2];
                    $inline_yes = "";
                    if ($explode_type[4] == "inline") {
                        $inline_yes = "-inline";
                    } ?>&lt;div class="form-group ic_<?php echo $html_name; ?> <?php echo $col_class ?>"&gt;
             &lt;label class="<?php echo $html_name; ?> db_checkbox_check" db_checkbox_check_value="&lt;?php echo get_single_value($rec_meta,"<?php echo $html_name; ?>"); ?&gt;" for="<?php echo $html_name; ?>"&gt;<?php echo $radio_label; ?>&lt;/label&gt;  &lt;/br&gt;    
            <?php foreach ($get_options as $single_option) {
                        $human_readable = ucwords(str_replace("_", " ", $single_option));
            ?>&lt;div class="form-check<?php echo $inline_yes; ?>"&gt;
             &lt;label class="form-check-label"&gt;   
            &lt;input class="form-check-input" type="checkbox" name="<?php echo $html_name; ?>[]" value="<?php echo $single_option; ?>"&gt;<?php echo $human_readable; ?> 
            &lt;/label&gt; 
            &lt;/div&gt;
            <?php } ?>           
                &lt;/div&gt;<?php } ?>         
<?php }
?>
        &lt;div class="form-group col-md-12"&gt;
        &lt;input type="submit" class="btn btn-success btn-sm update_<?php echo $rec_type; ?>" value="Update <?php echo strtoupper($rec_type); ?>" form_id="<?php echo $unique_id; ?>"&gt; 
        &lt;/div&gt;
        &lt;/div&gt;
        &lt;/form&gt;        
        &lt!-- Form Row Ends --&gt;
        <?php } ?></textarea>
                    <h3> Update Javascript </h3>
                    <textarea class="select_this form-control" cols="10" rows="25">

        //Auto chose select values
        $(".db_auto_chose").each(function(){  
        var db_auto_chose_name = $(this).attr("name");
        var db_auto_chose_value = $(this).attr("db_auto_chose_value");
        $(this).val(db_auto_chose_value);
        });

        //Update Variables
var update_button_class_<?php echo $rec_type; ?>= ".update_<?php echo $rec_type; ?>"; // .classname
var form_id_<?php echo $rec_type; ?> = "#form_update_<?php echo $rec_type; ?>";
var update_api_url_<?php echo $rec_type; ?> = "api/<?php echo $rec_type; ?>/update_<?php echo $rec_type; ?>.php"; // /api/update.php
 var form_id_parameter_name_<?php echo $rec_type; ?> = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_<?php echo $rec_type; ?>,function(e){
e.preventDefault();
    		  var form_to_process_<?php echo $rec_type; ?> = form_id_<?php echo $rec_type; ?> + "_" + $(this).attr(form_id_parameter_name_<?php echo $rec_type; ?>);

    	 $.post(update_api_url_<?php echo $rec_type; ?>,$(form_to_process_<?php echo $rec_type; ?>).serializeArray(),function(data){
        var response_json_<?php echo $rec_type; ?> = data;

if(response_json_<?php echo $rec_type; ?>["status"] == "failure"){
  var get_errors_<?php echo $rec_type; ?> = response_json_<?php echo $rec_type; ?>["errors"];
 
    var errors_returned_<?php echo $rec_type; ?> = "";
  $(get_errors_<?php echo $rec_type; ?>).each(function(index,value){
            errors_returned_<?php echo $rec_type; ?> = errors_returned_<?php echo $rec_type; ?> + " => " + value;
    });

    swal("Error",errors_returned_<?php echo $rec_type; ?>, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_<?php echo $rec_type; ?>)[0].reset();

        

    		 // Other functions to execute on success
    		  swal("Processing", {
      icon: "success",
      timer: 1000
    }).then(function(){
        location.reload();
    });
}
           });

    	   });
           
        </textarea>
                </div>

                <!-- Col 2 ends -->


            </div>
            <!-- Row Ends -->
            <!-- Row Starts -->
            <div class="row">
                <!-- Col 1 -->
                <div class="col-sm-6">

                    <h3>Meta Keys Array</h3>
                    <textarea class="select_this form-control" cols="10" rows="5">
$meta_keys_of_<?php echo $rec_type; ?> = array(<?php echo trim($meta_keys_array, ","); ?>);
</textarea>
                </div>
                <!-- Col 1 ends-->

                <!-- Col 2 -->
                <div class="col-sm-6">

                </div>
                <!-- Col 2 ends -->

            </div>
            <!-- Row Ends -->

    </div>
    <!-- Container ends -->
    <script src="../wsp_rad/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../wsp_rad/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(".select_this").click(function() {
            console.log("test");
            $(this).select();
        });
    </script>
</body>

</html>