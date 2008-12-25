<?php

include "cityinfo.php";

$temp = $_POST["city_info"];
$cityinfo = "city_info[temp]";


$weather = "http://www.google.co.kr/ig/api?&hl=en&weather=".$cityinfo;
$img = "http://www.google.co.kr";

$xml = simplexml_load_file($weather)->weather->forecast_information;
$xml1 = simplexml_load_file($weather)->weather->current_conditions;
$xml2 = simplexml_load_file($weather)->weather->forecast_conditions;

$city = $xml->city;
$date = $xml->forecast_date;
$condition = $xml1->condition;
$temp_min = $xml2->low;
$temp_max = $xml2->high;
$humidity = $xml1->humidity;
$imgdata = $xml1->icon;
$wind = $xml1->wind_condition;


/*
echo "<xmp>"; 
print_r($date); 
echo "</xmp>"; 
*/

?>