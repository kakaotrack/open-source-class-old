<? require "config.php"; 
	extract($HTTP_GET_VARS); //파라미터 받는부분
?>

<html lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>DMap</title>
	<script type="text/javascript" src="http://apis.daum.net/maps/maps.js?apikey=<?=$daumkey?>"></script>
</head>
<body style="margin:0 0px 0px 0px">	
	<table width="100%" height="100%" cellspacing="0" cellpadding="0">
		<tr><td>
			<div id='daumMap' style='position:absolute;top:0px;left:0px;width:100%;height:100%;' ></div> 
		</td></tr>
	</table>

	<script type="text/javascript" language="javascript">
		var map = new DMap("daumMap", {point:new DLatLng(<?=$x?>, <?=$y?>), level:<?=$zoom?>}); //파라미터로 받은 위도, 경도, 줌레벨로 맵 초기화
		var zc = new DZoomControl();
		map.addControl(zc);
		zc.setAlign("right");
		map.disableScrollWheelZoom(); //마우스휠을 이용한 확대,축소 불가
	</script>
</body>
</html>

