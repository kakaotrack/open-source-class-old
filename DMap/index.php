<?
function DMap_AddPostEditorToolBox($target, $mother) {

	global $pluginURL, $service;

	$urlprefix = "http://".$service['domain'].$pluginURL;

	$content= "
	<script language='javascript'>        
	function openDMap() {
		window.open('http://117.17.102.230/map/DMap_show.php','DMap','width=900,height=600,scrollbars=no,resizable=yes');
	}
	</script>
	<img onclick='openDMap()' style='padding: 2px;' class='pointerCursor' src='http://117.17.102.230/map/get_map.gif' /><br/>
	";
	return $content.$target;
}
?>
