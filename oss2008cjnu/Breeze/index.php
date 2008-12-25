
<?php
//콤보박스 부분//
     function Sidebar_Show($parameters)
     {

$code="<br>
<select id='city' Name='city_info'>
<option> 서울
<option> 경주
<option> 구미
<option> 군산
<option> 대구
<option> 대전
<option> 부산
<option> 안양
<option> 울산
<option> 포항
<option> 전주
<option> 제주
<option> 진주
<option> 청주
<option> 춘천
<option> 인천
<option> 광주
<option> 파주
<option> 목포
<option> 서귀포
<option> 안산
<option> 원주
<option> 익산
<option> 충주
<option> 김해
<option> 창원
<option> 천안
<option> 오산
<option> 용인
<option> 삼척
</select>
<input type='button' value='검색' click='selectCity'>
</select> <br>";


$city_info = array();
$city_info[none]	= "Null";
$city_info[서울]	= "Seoul";
$city_info[경주]	= "Gyeongju";
$city_info[구미]	= "Gumi";
$city_info[군산]	= "Gunsan";
$city_info[대구]	= "Daegu";
$city_info[대전]	= "Daejeon";
$city_info[부산]	= "Busan";
$city_info[안양]	= "Anyang";
$city_info[울산]	= "Ulsan";
$city_info[포항]	= "Pohang";
$city_info[전주]	= "Jeonju";
$city_info[제주]	= "Jeju";
$city_info[진주]	= "Chinju";
$city_info[청주]	= "Cheongju";
$city_info[춘천]	= "Chuncheon";
$city_info[인천]	= "Incheon";
$city_info[광주]	= "Gwangju";
$city_info[파주]	= "Paju";
$city_info[목포]	= "Mokpo";
$city_info[서귀포]	= "Seogwipo";
$city_info[안산]	= "Ansan";
$city_info[원주]	= "Wonju";
$city_info[익산]	= "Iksan";
$city_info[충주]	= "Chungju";
$city_info[김해]	= "Gimhae";
$city_info[창원]	= "Changwon";
$city_info[천안]	= "Cheonan";
$city_info[오산]	= "Osan";
$city_info[용인]	= "Yongin"; 
$city_info[삼척]	= "Samchok";


// 파싱부분//
$temp = $_POST["city_info"];
$cityinfo = $city_info[$temp];

//.$cityinfo.
$weather = 'http://www.google.co.kr/ig/api?&weather=jeju&hl=ko&oe=utf-8';
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


//인터페이스 부분//

$code.="<br>";
$code.="<b>지역명</b> : 제주";
$code.=$temp;

$code.="<br>";
$code.="<b>날짜</b> : ";
$code.=$date[data];

$code.="<br><br><center>";
$code.="<b>기상개황</b>";
$code.="<br>";
$code.="<img src=".$img.$imgdata[data].">";
$code.="<br>";
$code.=$condition[data];
$code.= "</center><br>";
$code.= "<b>최저 ~ 최고온도</b> : ";
$code.= $temp_min[data]." ~ " ;
$code.= $temp_max[data]."도";
$code.= "<br>";
$code.= $humidity[data];
$code.= "<br>";
$code.= $wind[data];

  return $code;

     }
?>

