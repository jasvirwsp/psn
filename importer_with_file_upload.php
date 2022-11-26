<?php
include("header.php");
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

function getExtension ($mime_type){

    $extensions = array('image/jpeg' => 'jpeg',
    'image/jpg' => 'jpg',
                        'image/png' => 'png',
                        'image/gif'=>'gif'
                       );

    // Add as many other Mime Types / File Extensions as you like

    return $extensions[$mime_type];

}
 
// Set path to CSV file
$csvFile = 'products.csv';
 $csv = readCSV($csvFile);
//Main Code
$record_controller = new records_insert_controller();

$meta_keys_of_item = array('product_name','product_price','product_discounted_price','product_prescription_required','product_brand','product_packing','product_each_packing','product_each_packing_quantity','product_featured','product_status','product_description','product_photo');
$record_type = "product";
$author_id = 15;

foreach($csv as $single_line)
{
    
    //beautify_array($single_line) . "<br>";
   
    if($single_line[0] == ""){
        continue;
    }
    //$record_id = $single_line[0];
    
    //One line of csv
// $insert_record_array = array("district_name"=>trim(str_replace("*","",$single_line[0])),"date_created"=>generate_mysql_timestamp(),"date_updated"=>generate_mysql_timestamp(),"district_insert_author"=>$author_id);
//$insert_record = $record_controller->insert_record([$insert_record_array,$record_type]);
$insert_record_array = array();

//Photos
$single_line[11] = trim($single_line[11]);
$photos_exp = explode("||||",$single_line[11]);
$count_p = count($photos_exp);
$photos_exp = array_filter($photos_exp);
$file_ids = array();
foreach($photos_exp as $single_photo){
if($single_photo == "https://res.cloudinary.com/du8msdgbj/image/upload/l_watermark_346,w_240,h_240/a_ignore,w_240,h_240,c_fit,q_auto,f_auto/v1479378261/blank_otc_uobogo.png"){
continue;
}
$headers = get_headers($single_photo, 1);
$type = $headers["Content-Type"];
$extension = getExtension($type);
$identifier = uniqid("upload_").rand(0,9999);
$file_name ="uploads/".$identifier.'.'.$extension;
$just_file_name = $identifier.'.'.$extension;
file_put_contents($file_name,file_get_contents($single_photo));

//insert query of file_upload api #start
$record_insert_controller = new records_insert_controller();
$record_type_file_upload_api = "file_upload";
$record_type_array_file_upload_api = array(
    "file_upload_identifier"=>$identifier,
    "file_upload_file_name"=>$just_file_name,
    "file_upload_insert_author"=>"15",
    "file_upload_input_name"=>"product_photo",
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp()
      
                            );
$insert_record_file_upload_api = $record_controller->insert_record([$record_type_array_file_upload_api,$record_type_file_upload_api]);
$insert_id_file_upload_api = $insert_record_file_upload_api["record_id"];
//insert query of file_upload  api #ends    
array_push($file_ids,$insert_id_file_upload_api);
}
$single_line[11] = implode(",",$file_ids);
//Photos

//Description
$single_line[10] = str_replace('Safety Advice','~~Safety Advice~~'.PHP_EOL,$single_line[10]);
$single_line[10] = str_replace('Alcohol','~~Alcohol~~'.PHP_EOL,$single_line[10]);
$single_line[10] = str_replace('Introduction','~~Introduction~~'.PHP_EOL,$single_line[10]);
//Description

foreach($meta_keys_of_item as $key=>$value){
$insert_record_array[$value] = $single_line[$key];
}
$insert_record_array["date_created"] = generate_mysql_timestamp();
$insert_record_array["date_updated"] = generate_mysql_timestamp();
beautify_array($insert_record_array);
$insert_record = $record_controller->insert_record([$insert_record_array,$record_type]);
$insert_id = $insert_record["record_id"];
echo $insert_id;

}

echo "All Done bro";
?>