<?php
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
//$apikey = "6484ff3113728f5c49e7d921205d61a1";

function KeywordLink_bindKeyword($target,$mother) { //팝업 띄우면서 넘겨주는 부분
	global $blogURL;

//	$target = "<a href=\"#\" class=\"key1\" onclick=\"openKeyword('$blogURL/keylog/" . rawurlencode($target) . "'); return false\">{$target}</a>";
	$target = "<a href=\"http://openapi.naver.com/search?key=".$config['apikey']."&target=krdic&start=1&display=10&query=". rawurlencode($target) ."\" class= \" key1 \"  return false\">{$target}</a>";

	return $target;
}


function KeywordLink_setSkin($target,$mother) { // 스킨html 읽어들이는 부분
	global $pluginPath;
	return $pluginPath."/keylogSkin.html";
}

function KeywordLink_bindTag($target,$mother) {
	global $blogURL, $pluginURL, $configVal;
	requireModel('blog.keyword');
	$blogid = getBlogId();
	if(isset($mother) && isset($target)){
		$tagsWithKeywords = array(); //태깅된 키워드 가져오기
		$keywordNames = getKeywordNames($blogid);
		foreach($target as $tag => $tagLink) {
			if(in_array($tag,$keywordNames) == true)
				$tagsWithKeywords[$tag] = $tagLink."<a href=\"#\" class=\"key1\" onclick=\"openKeyword('$blogURL/keylog/".encodeURL($tag)."'); return false\"><img src=\"".$pluginURL."/images/flag_green.gif\" alt=\"Keyword ".$tag."\"/></a>";
			else $tagsWithKeywords[$tag] = $tagLink;
		}
		$target = $tagsWithKeywords;
	}
	return $target;
}


function KeywordLink_handleConfig($data){
	requireComponent('Textcube.Function.misc');
	$config = setting::fetchConfigVal($data);
	if(!$config['apikey']) return "::입력 오류::\n\nAPI KEY를 입력하세요.   ";
	return true;
}
?>
