<? require "config.php"; ?>

<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=euc-kr">
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

<table id='main' style='width: 100%; height: 100%;' cellpadding='0' cellspacing='0'><tr>
<td>
<iframe id='ngmap' name="ngmap" src="http://117.17.102.230/map/NGMap.php?<?=$parameter?>" scrolling="no" frameborder=0 border=0 width="100%" height="100%" style='border:1px solid gray;'></iframe>
<div id='centerpoint'	style='position:absolute;display:none;width:20px;height:20px;'> <img src='http://sparcs.org/~airlover/9eye.net/map/images/center.gif' alt="+" style='filter: alpha(opacity=50,style=0);'/> </div>
</td>
<td style='width:200px; padding:3px;'>
	<table style='width:100%; height:100%;' cellpadding='0' cellspacing='0'><tr><td align='center' valign="top">
		<div id="ng_title"><table width="100%"><tr><td align='center' style='font-size: 13px;'><a href='http://9eye.net/' style='color: black; text-decoration: none; font-weight: bold;' target='_blank'>NGMap by airlover</a></td></table></div>
		<div id="ng_position">
			<table>
			<tr><th>좌표:
			</th><td>
				<input id='ng_coordinates' style='width: 120px; border:0px' onclick='toClipboardCoordinate()'/>
			</td></tr>
			<tr><td colspan='2'>
				* 원하는 곳을 더블클릭 하세요.
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
				1. 지도 아이콘(<img src='http://sparcs.org/~airlover/9eye.net/map/images/mapicon.gif'>)
			</td><td>
				<button id='ng_btn_icon' onclick='insertMapIcon()'>등록</button>
			</td></tr>
			<tr><td class='ng_lists'>
				2. 지도 (IFRAME)
			</td><td>
				<button id='ng_btn_map' onclick='insertMapIframe()'>등록</button>
			</td></tr>
			<tr><td class='ng_lists'>
				3. 지도 링크
			</td><td>
				<button id='ng_btn_snapshot' onclick='insertMapLink()'>등록</button>
			</td></tr>
			</table>
			<table style='margin-top: 4px'>
			<tr><td style='font-size: 11px;'>종류: 
				<input id='ng_inp_ngmap' type='radio' name='type' value='ngmap' checked="checked">NGMap <input id='ng_inp_nmap' type='radio' name='type' value='nmap'>NaverMap
			</td></tr>
			</table>
		</div>
		<div id="ng_textarea">
			<table style='width:95%; margin-top: 4px'>
			<tr><td style='font-size: 11px;'>
				<textarea id='ng_out_text' onclick="this.focus();this.select();" wrap="virtual"> </textarea>
			</td></tr>
			<tr><td align='center'> 블로그에 지도를 저장하고<br/> 트랙백을 날려주세요~ </td></tr>
			</table>
			
		</div>
	</td></tr><tr><td valign='bottom'>
		<div id="ng_copyright">
			<table style='width=90%'>
			<tr><td>문의: </td><td align='center'><a href='http://9eye.net/tt/entry/NGMap-06' target='_new'>http://9eye.net/</a> </td></tr>
			<tr><td>트랙백: </td><td align='center' onclick="copyTextToClipboard('http://9eye.net/map/tr/')">http://9eye.net/map/tr/ </td></tr>
			</table>
		</div>
		</div>
		<div id="ng_poweredby">
			<table style='background: #000' width='100%'>
			<tr><td style='font-size: 11px;color: #fff;' align='center'>Powered by Naver, Google
			</td></tr>
			</table>
		</div>
	</td></tr></table>
</td>
</tr></table>
<span id='forclip' class='ng_hidden'></span>

<script type="text/javascript" language="javascript">
roundTableNew("ng_title", "round2");
</script>
</body>
</html>
