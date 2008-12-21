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
?>
<!--
<script type="text/javascript">
 function start(x,y){
	alert(x+","+y);
	getKey();
	getQuery();
}
 function getKey() {
	 mySWF = document.getElementById("${application}");
     mySWF.getKey("<? echo $apikey; ?>");
 }
 function getQuery() {
	 mySWF = document.getElementById("${application}");
     mySWF.getQuery("<? echo $target; ?>");
 }
</script>-->
<?
	   $target=$target."<div id='listbox' class='listbox'><h3>Extracted Keywords</h3>";
/*
	   $target=$target."<script language='JavaScript' type='text/javascript'>";
	   $target=$target."function start(x,y){";
	   $target=$target."alert(x+','+y);";
	   $target=$target."getKey();";
	   $target=$target."getQuery();}";
       $target=$target."function getKey(){";
	   $target=$target."mySWF = document.getElementByID('KeywordExtractor');";
	   $target=$target."mySWF.getKey('$apikey');}";
	   $target=$target."function getQuery(){";
	   $target=$target."mySWF = document.getElementByID('${application}');";
	   $target=$target."mySWF.getQuery('".$target."');}</script>";
*/
		$query=preg_replace("/<>\#*","",$target);
	   $target=$target."<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' id='KeywordExtractor' width='400' height='250' codebase='http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab'> <param name='movie' value='http://handkstory.net/~handk/plugins/DKKey/KeywordExtractor.swf' />	<param name='quality' value='high' /><param name='bgcolor' value='#ffffff'/><param name='allowScriptAccess' value='sameDomain'/><embed src='http://handkstory.net/~handk/plugins/DKKey/KeywordExtractor.swf?apikey=$apikey&query=$query' quality='high' bgcolor='#ffffff' width='400' height='250' name='KeywordExtractor' align='middle'	play='true' loop='false' quality='high' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.adobe.com/go/getflashplayer'></embed></object></div>";
	   return $target;
	}
	/* Flex Component start*/
    function keywordDataSet($DATA){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $DATA );
       return true;
   }
   ?>