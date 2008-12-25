q = document.getElementById("idq");
b = document.getElementById('idb');
r = document.getElementById('idr');
b.onclick = pingSearch;
pingSearch();

var map = new DMap("daumMap", {point:new DLatLng(33.502565751413755, 126.51874471108488), level:3}); //제주도 한라산을 중심으로 맵을 초기화
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
//지역 표시
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
	map.setCenter(new DLatLng(x, y), 3);
	var pt = map.getCenter();
	document.getElementById("pt").innerHTML = "위도 : "+ pt.Lat +"<br />경도 : "+ pt.Lon;
	
}

//iframe생성 버튼 클릭시
function insertMapIframe(){	
URLtext = "http://117.17.102.230/map/DMap_service.php?&x=" + center.getLat() + "&y=" + center.getLng() + "&zoom=" + map.getLevel(); 
Iframe = '<iframe src="' + URLtext  + '" width="400" height="300" border="0" frameborder="0" scrolling="no" style="border:1px solid gray">' + " </iframe>";
document.getElementById("dmap_iframe_text").innerText = Iframe;
}
		
