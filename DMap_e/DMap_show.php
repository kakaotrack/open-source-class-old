<? require "config.php"; ?>

<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<title>DMap</title></head>
<body style="margin:0 0px 0px 0px; font-size: 12px;" id='mapShow' onload="loaded()" onresize="resized()">
<div id='mapPrint' style='display:none'></div>
<script language='javascript'>
function windowResizeAndMove(w,h) {
	var lf = (screen.availWidth - w)/2;
	var tp = (screen.availHeight - h)/2;
	window.moveTo(lf,tp);
	window.resizeTo(w,h);
}
<? if (!$noresize) echo "windowResizeAndMove(900,600);\n" ?>
</script>
<script type="text/javascript" src="http://sparcs.org/~airlover/9eye.net/map/style/roundbox.js"></script>
<script type="text/javascript" src="http://sparcs.org/~airlover/9eye.net/map/support_tt.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps.js?apikey=<?=$daumkey?>"></script>
<script type="text/javascript" src="http://sparcs.org/~airlover/9eye.net/map/optNGMapv06.js"></script>

<table id='main' style='width: 100%; height: 100%;' cellpadding='0' cellspacing='0'>
<tr>
<td width="80%">
<div id='daumMap'	style='position:absolute;top:0px;left:0px;width:100%;height:100%;' ></div> 

</td>
<td style='width:200px; padding:3px;'>
	<table style='width:100%; height:100%;' cellpadding='0' cellspacing='0'><tr><td align='center' valign="top">		
		<div id="ng_position">
			<table>
			<tr><th>좌표:
			</th><td>
				<input id='ng_coordinates' style='width: 120px; border:0px' onclick='toClipboardCoordinate()'/>
			</td></tr>
			<tr><td colspan='2'>
				* 원하는 곳을 더블클릭하세요
			</td></tr>
			</table>
		</div>
		<div id="ng_insert_map">
			<table>
			<tr><td>
				<input id='ng_inp_blog' type='radio' name='mode' value='blog' checked="checked">블로그 삽입 <input id='ng_inp_clipboard' type='radio' name='mode' value='clipboard'>복사하기
			</td></tr>
			<tr><td align='center'>위치명:
				<input id='ng_inp_location' type='text' name='location'>
			</td></tr>
			</table>
			<table width="90%" style='margin-top: 4px'>			
			<tr><td class='ng_lists'>
				지도 (IFRAME)
			</td><td>
				<button id='ng_btn_map' onclick='insertMapIframe()'>등록</button>
			</td></tr>			
			</table>			
		</div>
		<div id="ng_textarea">
			<table style='width:95%; margin-top: 4px'>
			<tr><td style='font-size: 11px;'>
				<textarea id='ng_out_text' onclick="this.focus();this.select();" wrap="virtual"> </textarea>
			</td></tr>
			<tr><td style='font-size: 11px;'>
				<textarea id='ng_out_text1' onclick="this.focus();this.select();" wrap="virtual"> </textarea>
			</td></tr>

			<tr><td align='center'> 블로그에 지도를 저장하고<br/> 트랙백을 날려주세요~ </td></tr>
			</table>
			
		</div>	
	</table>
</td>
</tr></table>
<span id='forclip' class='ng_hidden'></span>

<script type="text/javascript" language="javascript">
	var map = new DMap("daumMap", {point:new DLatLng(33.376296389091, 126.52580432535), level:7}); 
	var zc = new DZoomControl();
	map.addControl(zc);
	zc.setAlign("right");

	DEvent.addListener(map, "move", function() { 
		   center = map.getCenter(); 
		   URLtext = "http://117.17.102.230/DMap_e/DMap.php?&x=" + center.getLat() + "&y=" + center.getLng(); 
		   Iframe = '<iframe src="' + URLtext  + '" width="400" height="300" border="0" frameborder="0" scrolling="no" style="border:1px solid gray">' + " </iframe>";
		   document.getElementById("ng_out_text1").innerText = Iframe//"latitude : " + center.getLat() + "  longitude: " + center.getLng();
	});


	function insertMapIframe(){	
	//URLtext = "http://117.17.102.230/DMap.php?&x=" + center.getLat() + "&y=" + center.getLng(); 
	//Iframe = "<iframe src='"+URLText+"' width='400' height='300' border='0' frameborder='0' scrolling='no' style='border:1px solid gray'> </iframe>";
	document.getElementById("ng_out_text").innerHTML = URLtext;
	}
</script>
</body>
</html>
