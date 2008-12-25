<?php


$weather = "http://www.google.co.kr/ig/api?&hl=en&weather=Jeju";
$img = "http://www.google.co.kr";

$xml = simplexml_load_file($weather)->weather->forecast_information;
$xml1 = simplexml_load_file($weather)->weather->current_conditions;
$city = $xml->city;
$date = $xml->forecast_date;
$condition = $xml1->condition;
$temp_c = $xml1->temp_c;
$humidity = $xml1->humidity;
$imgdata = $xml1->icon;
$wind = $xml1->wind_condition;



echo "<xmp>"; 
print_r($xml1); 
echo "</xmp>"; 


?>