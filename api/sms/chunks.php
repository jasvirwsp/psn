<?php

function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}
// Create an example array - ignore this line
$example = array(1,2,3,4,5,6,7,8,9,7,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1,5,4,1,4,1,4,1);
$count = count($example);
echo "Total :" . $count;

$sms_gateyway_limit = 95;

if($count > $sms_gateyway_limit){
    
$sms_gateyway_limit = 95;

$offset = $count/$limit;

$partitions = partition($example, $offset);
$chunks_array = array_filter($partitions);

foreach($chunks_array as $single_chunk){
    echo "Sending SMS to the following <pre>";

print_r($single_chunk);
echo "</pre>";
}


}else{
echo "<pre>";
print_r(array_filter($example));
}

?>