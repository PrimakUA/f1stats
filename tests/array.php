<?php
//$var = array('hello', 5, 15, 'hi');
/*$var = [
    'key1'=>'hello',
    'key2'=>['k1'=>1, 5, 6, 7],
    'key3'=>15,
    'hi_key'=>'hi'
];*/

//echo $var['key2'][1];
//print_r($var);

/*$var = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];

for($i=0; $i<count($var); $i++)
{
    for($j=0; $j<count($var); $j++)
    {
        echo $var[$i][$j].' ';
    }

    echo '<br>';

}*/

/*$var = [
    'key1'=>'hello',
    'key2'=>5,
    'key3'=>15,
    'hi_key'=>'hi'
];

foreach($var as $key=>$value)
{

    echo $var[$key].'<br>';
    //echo $key.'='.$value.'<br>';

}*/

/*$var = 'one,two,three,four';

$var_arr = explode(',', $var);

print_r($var_arr);*/



$var = [
    'key1'=>'hello',
    'key2'=>5,
    'key3'=>15,
    'hi_key'=>'hi'
];

$var_str = implode('', $var);

echo $var_str;