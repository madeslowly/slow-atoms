<?php
$arr = [1=>""];
$arr = array_diff($arr,[""]);
var_dump( $arr);
var_dump( count($arr));
?>