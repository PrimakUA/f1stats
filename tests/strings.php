<?php
/*
$str = myFunc(7, 8);

echo $str;

function myFunc($par1, $par2)
{
    $string  = $par1 + $par2;
    return $string;
}*/
/*
$str = 'I am  for string test';

echo $str.'<br>';
//echo strlen($str);
//echo str_replace('t', 'T', $str);

/*$need_str = 'test';
$str_pos = strpos($str, $need_str);
$str_len = strlen($need_str);
echo substr($str, $str_pos, $str_len);*/

//echo substr_count($str, 'test');
/*
echo stringCount($str, 't');

function stringCount($str, $sub_str)
{
    $counter = 0;

    $str_pos = strpos($str, $sub_str);
    while($str_pos!==false)
    {
        $counter++;

        $str = substr($str, $str_pos+1);

        $str_pos = strpos($str, $sub_str);

        echo $str.'<br>';
    }

    return $counter;


}*/

$str = 'abcde';
echo strlen($str); // 6
$str = ' ab cd ';
echo strlen($str); // 7
?>