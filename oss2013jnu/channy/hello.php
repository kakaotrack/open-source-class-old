<?php
	echo "Hello, world!";

	// if there is parameter 'year', show year!
	if($_GET['year']) {
		$year=$_GET['year'];
	} else {
		$year="2013";
	}

	echo "This year is ".$year.".";
?>
