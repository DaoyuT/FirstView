#!/usr/local/bin/php

<?php

$array = array();
$i = 0;
$n = 5;
while($i < $n){
    $array[$i] = $i + 10;
    echo $array[$i];
    $i++;
}
echo "<br>";


$name='zhang|wen|chao|Du|Xin|Dao|Yu|';
$data='23|56|4900|234|24|556|53';

echo("<form action='http://www.wenchaozhang.com/php/sta.php' method='get'>
<input name='name' type='hidden' value=$name>
<input name='data' type='hidden' value=$data>
<input type='submit' value='Go' /></form>");
//echo "<form action='Get_Array.php' method='get'><input type='hidden' name='array[]' value=$array /><input type='submit' value='Delete' /></form>";
?>
