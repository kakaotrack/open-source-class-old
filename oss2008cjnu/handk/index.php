<?php
   function extractKeyword($target, $mother) {
       global $configVal;
       requireComponent('Textcube.Function.Setting');
       $data = setting::fetchConfigVal( $configVal);
	   
	   if(is_null($data)){
		   return $target."API 키를 입력해주세요";
	   }else{
		   $apikey=$data['apikey'];
	   }

	   $query=str_replace("&"," ",$target);
	   $query=str_replace("'", "",$query);
	   
	   $target=$target."<div id='listbox' class='listbox'><h3>Extracted Keywords</h3>";

	   $target=$target."<center><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' id='KeywordExtractor' width='400' height='150' codebase='http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab'> <param name='movie' value='http://handkstory.net/~handk/plugins/DKKey/KeywordExtractor.swf' /><param name='quality' value='high' /><param name='bgcolor' value='#ffffff'/><param name='allowScriptAccess' value='sameDomain'/><embed src='http://handkstory.net/~handk/plugins/DKKey/KeywordExtractor.swf?apikey=$apikey&query=$query' quality='high' bgcolor='#ffffff' width='400' height='150' name='KeywordExtractor' align='middle'	play='true' loop='false' quality='high' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.adobe.com/go/getflashplayer'></embed></object></center>";
	   $target=$target."<br>powered by<img src='http://deco.daum-img.net/service_title/logo.gif' height='20'/ valign='middle'></div>";
	   return $target;
	}
	/* Flex Component start*/
    function keywordDataSet($DATA){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $DATA );
       return true;
   }
   ?>