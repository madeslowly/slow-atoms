<?php
$arr = Array(
    3, 20, 'hello',
) ;

$want = Array
(
2,
4,
8,
11,
12,
13,
14,
15,
16,
18,
'hello',
) ;

$res = empty(array_intersect($arr, $want));

if ( !$res ) {
    echo 'Date already booked';
var_dump(array_intersect($arr, $want) );
echo $res ;
};

?>