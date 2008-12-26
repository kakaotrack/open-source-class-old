
<?php
 
function city_info1($plugin)			
{
	
	$city_info = "";
	
	$city_info .= "<?xml version='1.0' encoding='utf-8'?>";
	$city_info .= "<config>";
	$city_info .= "<window width='500' height='500' />";
	$city_info .= "<fieldset legend='날씨 정보 도시 설정'>";
	$city_info .= "<field title='지역' name='city1' type='select'>";
	$city_info .= "<op value='seoul'>서울</op>";
	$city_info .= "<op value='Gyeongju'>경주</op>";
	$city_info .= "<op value='Gumi'>구미</op>";
	$city_info .= "<op value='Gunsan'>군산</op>";
	$city_info .= "<op value='Daegu'>대구</op>";
	$city_info .= "<op value='Daejeon'>대전</op>";
	$city_info .= "<op value='Busan'>부산</op>";
	$city_info .= "<op value='Anyang'>안양</op>";
	$city_info .= "<op value='Ulsan'>울산</op>";
	$city_info .= "<op value='Pohang'>포항</op>";
	$city_info .= "<op value='Jeonju'>전주</op>";
	$city_info .= "<op value='Jeju'>제주</op>";
	$city_info .= "<op value='Chinju'>진주</op>";
	$city_info .= "<op value='Cheongju'>청주</op>";
	$city_info .= "<op value='Chuncheon'>춘천</op>";
	$city_info .= "<op value='Incheon'>인천</op>";
	$city_info .= "<op value='Gwangju'>광주</op>";
	$city_info .= "<op value='Mokpo'>목포</op>";
	$city_info .= "<op value='Seogwipo'>서귀포</op>";
	$city_info .= "<op value='Ansan'>안산</op>";
	$city_info .= "<op value='Wonju'>원주</op>";
	$city_info .= "<op value='Chungju'>충주</op>";
	$city_info .= "<op value='Gimhae'>김해</op>";
	$city_info .= "<op value='Changwon'>창원</op>";
	$city_info .= "<op value='Cheonan'>천안</op>";
	$city_info .= "<op value='Osan'>오산</op>";
	$city_info .= "<op value='Yongin'>용인</op>";
	$city_info .= "<op value='Samchok'>삼척</op>";
	$city_info .= "<caption> 지역을 선택하여주세요</caption>";
	$city_info .= "</field></fieldset>";
	$city_info .= "</config>";	
	return $city_info;
}

   function cityinfo1($DATA){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $DATA );
       return true;
   }
?>
<?php
//콤보박스 부분//
     function Sidebar_Show($parameters)
     {
global $configVal;
    requireComponent('Textcube.Function.Setting');
    $datas = setting::fetchConfigVal($configVal);	
	$cityname = $datas['city1'];	


$weather = 'http://www.google.co.kr/ig/api?&weather='.$cityname.'&hl=ko&oe=utf-8';
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
$code="<br>";
$code.="<b>지역명 : </b>";
$code.=$cityname;

$code.="<br>";
$code.="<b>날짜</b> : ";
$code.=$date[data];
$code.="<br><br><center>";
$code.="<b>기상상태</b>";
$code.="<br>";
$code.="<img src=".$img.$imgdata[data].">";
$code.="<br>";
$code.=$condition[data];
$code.= "</center><br>";
$code.= "<b>최저 ~ 최고온도</b> : ";
$code.= $temp_min[data]."℃ ~ " ;
$code.= $temp_max[data]."℃";
$code.= "<br>";
$code.= $humidity[data];
$code.= "<br>";
$code.= $wind[data];

  return $code;

     }
?>