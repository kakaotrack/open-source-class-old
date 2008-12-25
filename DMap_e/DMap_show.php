<? require "config.php"; ?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<title>DMap</title></head>
<body style="margin:0 0px 0px 0px; font-size: 12px;" id='mapShow' onload="loaded()" onresize="resized()">
	<!--DAUMmapAPI-->
	<script type="text/javascript" src="http://apis.daum.net/maps/maps.js?apikey=<?=$daumkey?>"></script>
	<script type="text/javascript">
		q = document.getElementById("idq");
		b = document.getElementById('idb');
		r = document.getElementById('idr');
		b.onclick = pingSearch;
		pingSearch();
	</script>
	<table id='main' style='width: 100%; height: 100%;' cellpadding='0' cellspacing='0'>
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
								<input id="idq" value="연동" />
								<button id="idb" />검색</button>
							</td></tr>
							<tr><td>
								<ul id="idr" /></ul>
							</td></tr>
						</table>
					</div>
				</table>
			</td>
		</tr>
	</table>

	<script type="text/javascript" language="javascript">
		q = document.getElementById("idq");
		b = document.getElementById('idb');
		r = document.getElementById('idr');
		b.onclick = pingSearch;
		pingSearch();

		var map = new DMap("daumMap", {point:new DLatLng(33.376296389091, 126.52580432535), level:7}); //제주도 한라산을 중심으로 맵을 초기화
		var zc = new DZoomControl(); //줌컨트롤러 객체 생성
		map.addControl(zc); //줌컨트롤러 추가
		zc.setAlign("right"); //줌컨롤러 위치 조정
		map.addControl(new DIndexMapControl());
		map.disabledDoubleClickZoom() //마우스를 더블클릭시 줌기능 제거
		
		//맵을 더블클릭할때
		DEvent.addListener(map, "dblclick", function() {
			//map.disableScrollWheelZoom();
		});
		//맵을 이동할때의 이벤트 핸들러
		DEvent.addListener(map, "move", function() { 
		   center = map.getCenter(); //중심좌표 가져오기
		   Zlevel = map.getLevel(); //줌레벨 가져오기
		   document.getElementById("lat").innerText = center.getLat();
		   document.getElementById("lng").innerText = center.getLng();
		});
		//맵의 이동을 완료했을때
		DEvent.addListener(map, "moveend", function() {
			ca = document.createElement('script');
			ca.type ='text/javascript';
			ca.charset ='utf-8';
			ca.src = "http://kr.open.gugi.yahoo.com/service/rgc.php?appid=M8dEkPHIkY3eY8jO7Wj7rmmK0ja3Wq5Q&latitude=" + center.getLat() + "&longitude=" + center.getLng() + "&output=json&callback=catrans";
			document.getElementsByTagName('head')[0].appendChild(ca);
		});
		
		function catrans(catdata) {
			document.getElementById("addr").innerText =  catdata.ResultSet.location.state + " " + catdata.ResultSet.location.county + " " + catdata.ResultSet.location.town;
        }

		function pingSearch() {
			if (q.value) {
				s = document.createElement('script');
				s.type ='text/javascript';
				s.charset ='utf-8';
				s.src = 'http://kr.open.gugi.yahoo.com/service/poi.php?appid=M8dEkPHIkY3eY8jO7Wj7rmmK0ja3Wq5Q&results=100&output=json&callback=pongSearch&q=' + encodeURI(q.value);
				document.getElementsByTagName('head')[0].appendChild(s);
			}  
		}

		function pongSearch(z) {
			r.innerHTML = "";
			for (var i = 0; i < z.ResultSet.locations.item.length; i++)
			{
			  var li = document.createElement('li');
			  var p = document.createElement('p');
			  onclick = 'callmap(' + z.ResultSet.locations.item[i].latitude + ',' + z.ResultSet.locations.item[i].longitude + ');';
			  p.innerHTML =  z.ResultSet.locations.item[i].state;
			  li.appendChild(p);
			  r.innerHTML = "<li><a href='#' onclick=" + onclick + " >" + z.ResultSet.locations.item[i].name + " (" + z.ResultSet.locations.item[i].state + " " + z.ResultSet.locations.item[i].county + " " + z.ResultSet.locations.item[i].city + ")</a></li>" + r.innerHTML;
			}
			callmap(z.ResultSet.locations.item[z.ResultSet.locations.item.length-1].latitude,z.ResultSet.locations.item[z.ResultSet.locations.item.length-1].longitude);
		}

		function callmap(x, y){
			var des = new YGeoPoint(x,y);
			map.drawZoomAndCenter(des, 5);
			var pt = map.getCenterLatLon();
			document.getElementById("pt").innerHTML = "위도 : "+ pt.Lat +"<br />경도 : "+ pt.Lon;
			//YEvent.Capture(map, EventsList.endPan,event_endPan);
		}

		//iframe생성 버튼 클릭시
		function insertMapIframe(){	
		URLtext = "http://117.17.102.230/map/DMap_service.php?&x=" + center.getLat() + "&y=" + center.getLng() + "&zoom=" + Zlevel; 
		Iframe = '<iframe src="' + URLtext  + '" width="400" height="300" border="0" frameborder="0" scrolling="no" style="border:1px solid gray">' + " </iframe>";
		document.getElementById("dmap_iframe_text").innerText = Iframe;
		}
		
	</script>
</body>
</html>
