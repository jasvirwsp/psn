<?php
$file_name = "myzip.zip";
$zip = new ZipArchive;
if ($zip->open($file_name, ZipArchive::CREATE) === TRUE)
{
    // Add random.txt file to zip and rename it to newfile.txt
    $zip->addFile('test.txt', 'newfile.txt');
 
    // Add a file new.txt file to zip using the text specified
    //$zip->addFromString('new.txt', 'text to be added to the new.txt file');
 
    // All files are added, so close the zip file.
    $zip->close();
}
header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename=".$file_name);
header("Content-Transfer-Encoding: Binary");
readfile($file_name);
unlink($file_name);
?>