<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--  BEGIN Browser History required section -->
<link rel="stylesheet" type="text/css" href="history/history.css" />
<!--  END Browser History required section -->

<title></title>
<script src="AC_OETags.js" language="javascript"></script>

<!--  BEGIN Browser History required section -->
<script src="history/history.js" language="javascript"></script>
<!--  END Browser History required section -->

<style>
body { margin: 0px; overflow:hidden }
</style>
<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 28;
// -----------------------------------------------------------------------------
// -->
</script>
</head>
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
<script type="text/javascript">
 function getKEY()
 {
  mySWF = document.getElementById("${application}");
        mySWF.getKEY("<? echo $apikey; ?>");
 }
 function getQuery()
 {
  mySWF = document.getElementById("${application}");
        mySWF.getKEY("<? echo $target; ?>");
 }
</script>
<?

       $target=$target."<div id='listbox' class='listbox'><h3>Extracted Keywords</h3>";
	/*
	   $target=$target."<script language='JavaScript' type='text/javascript'>";
       $target=$target."function getKEY(){";
	   $target=$target."mySWF = document.getElementByID('${application}');";
	   $target=$target."mySWF.getKEY('$apikey');}";
	   $target=$target."function getQuery(){";
	   $target=$target."mySWF = document.getElementByID('${application}');";
	   $target=$target."mySWF.getQuery('$target');}</script>";
	*/
	   $target=$target."<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' id='KeywordExtractor' width='400' height='250' codebase='http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab' onload='getKEY();getQuery();'> <param name='movie' value='http://handkstory.net/~handk/plugins/DKKey/bin/KeywordExtractor.swf' />	<param name='quality' value='high' /><param name='bgcolor' value='#ffffff'/><param name='allowScriptAccess' value='sameDomain'/><embed src='http://handkstory.net/~handk/plugins/DKKey/bin/KeywordExtractor.swf' quality='high' bgcolor='#ffffff' width='400' height='250' name='KeywordExtractor' align='middle'	play='true' loop='false' quality='high' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.adobe.com/go/getflashplayer'></embed></object></div>";
	   return $target;
	}
	/* Flex Component start*/
    function keywordDataSet($DATA){
       requireComponent('Textcube.Function.Setting');
       $cfg = setting::fetchConfigVal( $DATA );
       return true;
   }
   ?>
