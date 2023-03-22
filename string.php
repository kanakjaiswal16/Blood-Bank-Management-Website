<?php
$str="kanak";
$len=strlen($str);
echo "The length of string is ".$len." KANAK <br>";
// '.' is connecting two or more stirgs in php.

$str2="one two three";
echo "The number of words in string is ".str_word_count($str2);
echo "<br> The reverse of string is ".strrev($str2);
echo "<br> The position of 'two' in string is ".strpos($str2,"two");
echo "<br> The replace string is ".str_replace("two","2",$str2);

?>