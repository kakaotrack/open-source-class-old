<?
require "config.php";

function DMap_AddPostEditorToolBox($target, $mother) {

	global $pluginURL, $service;

	$urlprefix = "http://".$service['domain'].$pluginURL;

	$content.= "
	<script language='javascript'>        
	function openDMap() {
		window.open('http://117.17.102.230/blog/plugins/DMap/DMap_show.html','DMap','width=900,height=600,scrollbars=no,resizable=yes');
	}
	</script>
	<img onclick='openDMap()' style='padding: 2px;' class='pointerCursor' src='http://117.17.102.230/blog/plugins/DMap/get_map.gif' /><br/>
	";
	return $content.$target;
}
?>
