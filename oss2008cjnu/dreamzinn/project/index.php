<?php
/* PicLens Enabler
   ----------------------------------
   Version 0.1
   inureyes

   Created at       : 2008.4.24
   Last modified at : 2008.4.25
 
 This plugin enables PicLens (http://piclens.com) Autodiscovery.
 For the detail, visit http://forest.nubimaru.com


 General Public License
 http://www.gnu.org/licenses/gpl.html

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 TODO:
     Use thumbnail.
     Paging
*/

	function weatherinfo_show($parameters)
	{
		if(isset($parameters['message'])) return $parameters['message'];
		else return 'Hello world!';
	}
?>
