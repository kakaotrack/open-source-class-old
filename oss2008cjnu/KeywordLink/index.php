<?php
	include("config.php");
	require_once('JSON.php');
	
/*
   KeywordLink for Textcube 1.76
   ----------------------------------
   Version 1.5
   제주대학교 컴퓨터공학과.

   Creator          : 정효원 & 김성규
   Maintainer       : 정효원 & 김성규

   Created at       : 2006.10.3
   Last modified at : 2007.8.15
*/



function doPost($uri,$postdata,$host){ 
        $da = fsockopen($host, 80, $errno, $errstr); 
        if (!$da) { 
            echo "$errstr ($errno)<br/>\n"; 
            echo $da; 
        } 
        else { 
            $salida = "POST $uri  HTTP/1.1\r\n"; 
            $salida.= "Host: $host\r\n"; 
            $salida.= "User-Agent: PHP Script\r\n"; 
            $salida.= "Content-Type: application/x-www-form-urlencoded\r\n"; 
            $salida.= "Content-Length: ".strlen($postdata)."\r\n"; 
            $salida.= "Connection: close\r\n\r\n"; 
            $salida.= $postdata; 
            fwrite($da, $salida); 
                     while (!feof($da)) 
                $response.=fgets($da, 128); 
            $response=split("\r\n\r\n",$response); 
            $header=$response[0]; 
            $responsecontent=$response[1]; 
            if(!(strpos($header,"Transfer-Encoding: chunked")===false)){ 
                $aux=split("\r\n",$responsecontent); 
                for($i=0;$i<count($aux);$i++) 
                    if($i==0 || ($i%2==0)) 
                        $aux[$i]=""; 
                $responsecontent=implode("",$aux); 
            }//if 
            return chop($responsecontent); 
        }//else 
}//function-doPost 

function KeywordLink_insTB($target,$mother) {
	global $configVal;

	requireComponent('Textcube.Function.misc');
	$data = setting::fetchConfigVal( $configVal);

	if(!$data['apikey']){
		return $target."<p><font color=red>※API 키가 입력되어있지 않습니다 by KeywordLink Plugin※</font></p>";
	}
	else{
		$apikey=$data['apikey'];
	}

	$obj = getJSON($target,$apikey); //JSON결과 OBJ변수에 담기
		
	$itemCount = $obj->itemCount; //키워드 문맥 추출 결과 총 갯수
	
	// 본문 키워드 추출후 카운트 갯수에 따라 테이블 줄수를 증가시켜 출력
	
 	if( $itemCount > 0) 
	 {
		$target = $target."
			<p>
			<table border=0 cellpadding=0 cellspacing=0> 
 

			<table border=0 cellpadding=5 cellspacing=1> 
			<tr>
				<td bgcolor=black align=center width=110><font color=white>키워드</font></td>
				<td bgcolor=black align=center width=110><font color=white>중요도</font></td>
				<td bgcolor=black align=center width=110><font color=white>반복 횟수</font></td>
				<td bgcolor=black align=center width=110><font color=white>키워드 위치</font></td>
			</tr>";

		
			for($i = 0; $i < $itemCount; $i++)
			{
				$target .= "<td bgcolor=white width=110>".($obj->items[$i]->keyword)."</td>";
				$target .= "<td bgcolor=white width=110><center>".($obj->items[$i]->score)."</td>";
				$target .= "<td bgcolor=white width=110><center>".($obj->items[$i]->count)."</center></td>";
				$locationCount = ($obj->items[$i]->count);
				
				
				if( $locationCount > 1){
					for($j = 0; $j < $locationCount ; $j++)
						$target .= "<td><center>".($obj->items[$i]->locations[$j])."</center></td>";
				}
				else
					$target .= "<td><center>".($obj->items[$i]->locations[0])."</center></td>";
				
				$target .= "</tr>";
			}
		//}
		
		$target = $target."</table>";
	}

	else
		return $target.'<p><font color=red>※키워드 추출 결과 : 결과값이 없습니다※</font></p>';


	return $target;
}

function getJSON($target,$apikey)
{
	$json = new Services_JSON(); //JSON 객체 생성
	
	$content = strip_tags($target); //본문 내용에 걸려있는 모든 태그들 제거
	//옵션으로 간주 될수 있는 부분을 제거 &, ', " 등등 삭제
	$content = str_replace("&"," ",$content); 
	$content = htmlspecialchars($content, ENT_QUOTES);
	$content = str_replace("\"", " ",$content); 
	$content = "q='".$content."'";

	$post = doPost("/keyword?apikey=5dc435a4c228ad63347fdadb4634935bbab3962e&output=JSON", $content, "apis.daum.net/suggest");
	print_r( $post );

	$request = "http://apis.daum.net/suggest/keyword?apikey=".$apikey."&output=JSON&q='".urlencode($content)."'";
	$obj = json_decode(file_get_contents($request));
	
	return $obj;
}

/* 아직 쓰이지 않고 후에 쓰일 함수들
	XML문서에 넣을 이벤트
	<listener event="BindKeyword">KeywordLink_bindKeyword</listener>
	<listener event="setKeylogSkin">KeywordLink_setSkin</listener>


function KeywordLink_bindKeyword($target,$mother) { //팝업 띄우면서 넘겨주는 부분
	global $blogURL;
	global $pluginPath;
	global $configVal;

	requireComponent('Textcube.Function.misc');
	$data = setting::fetchConfigVal( $configVal);

//	$apikey=$data['apikey'];

	if(is_null($data)){
		return $target." API 키를 입력하세요 ";
	}
	else{
		$apikey=$data['apikey'];
	}

	$target = "<a href=\"#\" class=\"key1\" onclick=\"openKeyword('$blogURL/keylog/" . rawurlencode($target) . "'); return false\">{$target}</a>";

	return $target;
}

function KeywordLink_setSkin($target,$mother) {
	global $pluginPath;
	return $pluginPath."/keylogSkin.html";
}
*/

function KeywordLink_setConfig($data){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $data );
       return true;
}

?>