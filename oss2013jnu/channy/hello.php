<?php
	echo "Hello, world!";
	if($_GET['year']) $year=$_GET['year']
	else $year="2013";
	
	echo "This year is ".$year.".";
?>
