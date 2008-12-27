<?php
	include("config.php");
	require_once('JSON.php');
	
/* KeywordUI for Textcube 1.76
   ----------------------------------
   Version 1.5
   제주대학교 컴퓨터공학과.

   Creator          : 정효원 & 김성규
   Maintainer       : 정효원 & 김성규

   Created at       : 2006.10.3
   Last modified at : 2007.8.15
 
 This plugin enables keyword / keylog feature in Textcube.
 For the detail, visit http://forum.tattersite.com/ko


 General Public License
 http://www.gnu.org/licenses/gpl.html

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

*/
//http://openapi.naver.com/search?key=6484ff3113728f5c49e7d921205d61a1&target=krdic&query=%EC%98%81%EC%96%B4&start=1&display=10

//$apiurl = "http://openapi.naver.com/search";


function KeywordLink_insTB($target,$mother) {

	requireComponent('Textcube.Function.misc');

//	echo "target : ".$target."<br />";
//	echo "mother : ".$mother."<br />";

	$data = setting::fetchConfigVal( $configVal);
	
	
	getJSON($target);

	// 본문 키워드 추출후 카운트 갯수에 따라 테이블 줄수를 증가시켜 출력
//	$target = "<table><tr><td>".$target."</td></tr></table>";

	return $target;
}

function getJSON($target)
{
	$json = new Services_JSON(); //JSON 객체 생성
	
	$content = strip_tags($target); //본문 내용에 걸려있는 모든 태그들 제거
	//옵션으로 간주 될수 있는 부분을 제거 &, ', " 등등 삭제
	$content = str_replace("&"," ",$content); 
	$content = htmlspecialchars($content, ENT_QUOTES);
	$content = str_replace("'", " ",$content); 
	
	$request = "http://apis.daum.net/suggest/keyword?apikey=b8be32d336991e57612924b4512882c8a1bdd883&output=JSON&q='".urlencode($content)."'";
	
	$response = file_get_contents($request);
	
	// convert a complex value to JSON notation
	
	//$value = array(1, 2, 'foo');
	
	//$json_data = $json->encode($response); //JSON 방식으로 인코딩
	//echo $json_data;
	//echo $json->decode($response)."<br />";
	
	// accept incoming POST data
	//$input = $GLOBALS['HTTP_RAW_POST_DATA'];
	
//	echo $response;

/*
stdClass Object
( [requestor] => [title] => [docID] =>
[date] => 2008-12-27 21:17:10
[group] => 1
[itemCount] => 8
[items] => Array
( [0] => stdClass Object
( [keyword] => 국채수익률
  [score] => 7.8945
  [count] => 1 
  [locations] => Array ( [0] => 370 ) )
  
  [1] => stdClass Object
  ( [keyword] => 서부텍사스산중질유 
[score] => 3.1576 
[count] => 1 
[locations] => Array ( [0] => 529 ) ) 
[2] => stdClass Object 
( [keyword] => 뉴욕상품거래소 
[score] => 2.9684 
[count] => 1 
[locations] => Array 
( [0] => 504 ) ) 
[3] => stdClass Object 
( [keyword] => 알코아 
[score] => 2.9078 
[count] => 1 
[locations] => Array 
( [0] => 81 ) ) 
[4] => stdClass Object 
( [keyword] => 하니웰 
[score] => 2.3831 
[count] => 1 
[locations] => Array ( [0] => 112 ) ) 
[5] => stdClass Object 
( [keyword] => 다우지수 
[score] => 2.3641 
[count] => 1 
[locations] => Array 
( [0] => 1 ) ) 
[6] => stdClass Object 
( [keyword] => wti 
[score] => 2.069 
[count] => 1 
[locations] => Array 
( [0] => 541 ) ) 
[7] => stdClass Object 
( [keyword] => 나스닥 
[score] => 1.8174 
[count] => 1 
[locations] => Array 
( [0] => 238 ) ) ) )
*/

	$obj = json_decode(file_get_contents($request));
	
//	print_r($obj);
/*
[items] => Array
( [0] => stdClass Object
( [keyword] => 국채수익률
  [score] => 7.8945
  [count] => 1 
  [locations] => Array ( [0] => 370 ) )
 */

	
	print $obj->items;
//	print $obj->{'foo-bar'}; // 12345
//	print $obj->{'item'}->keyword;
	
 	//echo $value;
	//echo "value[''] : ".$value->date;
	
}


function KeywordLink_bindKeyword($target,$mother) { //팝업 띄우면서 넘겨주는 부분
	global $blogURL;
	global $pluginPath;
	global $configVal;

	requireComponent('Textcube.Function.misc');
	$data = setting::fetchConfigVal( $configVal);

//	$apikey=$data['apikey'];
/*
	if(is_null($data)){
		return $target." API 키를 입력하세요 ";
	}
	else{
		$apikey=$data['apikey'];
	}
*/

	$target = "<a href=\"#\" class=\"key1\" onclick=\"openKeyword('$blogURL/keylog/" . rawurlencode($target) . "'); return false\">{$target}</a>";


	$apikey = "6484ff3113728f5c49e7d921205d61a1";

	$target = "<a href=\"http://openapi.naver.com/search?key=".$apikey."&target=krdic&start=1&display=10&query=". rawurlencode($target) ."\" class= \" key1 \"  return false\">{$target}</a>";

	return $target;
}

function KeywordLink_setSkin($target,$mother) {
	global $pluginPath;
	return $pluginPath."/keylogSkin.html";
}


function KeywordLink_setConfig($data){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $data );
       return true;
}

?>