#!/usr/local/bin/php

<?php
$strA = "Fast And Furious 7";

function search_string($str){
	$resstr = str_replace(" ", "+", $str);
	$resstr = $resstr . "+trailer";
	return $resstr;
}

$strB = search_string($strA);
echo $strB;

?>
