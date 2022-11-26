<?php 

function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

$csvFile = 'names.csv';
$csv = readCSV($csvFile);

foreach($csv as $single_line)
{    
    $t = explode("-",$single_line[0]);
if($t[1]){
    echo $t[1] . "<br>";
}else{
    echo $t[0] . "<br>";
}

}
 ?>