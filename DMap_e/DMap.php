<? require "config.php"; 
	//$_GET["x"];
	//$_GET["y"];
	//$_GET["level"];
	//extract($_GET);
	extract($HTTP_GET_VARS);
?>

<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DMap</title>
<script type="text/javascript" src="http://apis.daum.net/maps/maps.js?apikey=<?=$daumkey?>"></script>
<script type="text/javascript" src="http://sparcs.org/~airlover/9eye.net/map/optNGMapv06.js"></script>
</head>
<body style="margin:0 0px 0px 0px">
<div id='mapPrint' style='display:none'></div>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td>
<div id='daumMap'	style='position:absolute;top:0px;left:0px;width:100%;height:100%;' ></div> 
</td></tr>
</table>



<script type="text/javascript" language="javascript">


var map = new DMap("daumMap", {point:new DLatLng(<?=$x?>, <?=$y?>), level:10}); 
var zc = new DZoomControl();
map.addControl(zc);
zc.setAlign("right");	


</script>
</body>
</html>

