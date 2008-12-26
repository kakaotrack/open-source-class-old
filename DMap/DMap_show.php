<? require "config.php"; ?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<title>DMap</title></head>
<body style="margin:0 0px 0px 0px; font-size: 12px;" id='mapShow' onload="loaded()" onresize="resized()">
	<!--DAUMmapAPI-->
	<script type="text/javascript" src="http://apis.daum.net/maps/maps.js?apikey=<?=$daumkey?>"></script>
	
	<table id='main' style='width: 100%; height: 100%;' cellpadding='0' cellspacing='0' >
		<tr>
			<td width="80%">
				<div id='daumMap'	style='position:absolute;top:0px;left:0px;width:100%;height:100%;' ></div> 
			</td>
			<td style='width:"18%; padding:3px;'>
				<table style='width:100%; height:100%;' cellpadding='0' cellspacing='0'><tr><td align='center' valign="top">					
					<div>
						<table>
							<tr><td>
								위도 : <input type="text" name="lat" />
							</td></tr>
							<tr><td>
								경도 : <input type="text" name="lng" />
							</td></tr>
							<tr><td>
								현위치 : <input type="text" name="addr" />
							</td></tr>
						</table>
					</div>					
					<hr color="blue" />
					<div id="ng_insert_map">						
						<table width="90%" style='margin-top: 4px'>			
							<tr><td>
								지도 (IFRAME)
							</td><td>
								<button id='DMap_iframe_btn' onclick='insertMapIframe()'>생성</button>
							</td></tr>			
						</table>			
					</div>
					<div>
						<table style='width:95%; margin-top: 4px'>
							<tr><td style='font-size: 11px;'>
								<textarea id='dmap_iframe_text' onclick="this.focus();this.select();"> </textarea>
							</td></tr>	
							<tr><td>
								위의 text를 클릭 후 복사하여 사용하세요..
							</td></tr>
						</table>
					</div>
					<hr color="blue" />
					<div>
						<table>
							<tr><td>
								<input id="idq" />
								<button id="idb" />검색</button>
							</td></tr>
							<tr><td style='font-size:11px'>
								<ul id="idr" /></ul>
							</td></tr>
						</table>
					</div>
				</table>
			</td>
		</tr>
	</table>
	<script type="text/javascript" src="http://117.17.102.230/map/DMap_support.js"></script>
</body>
</html>
