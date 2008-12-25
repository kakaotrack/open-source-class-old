<?php
     function Sidebar_Show($parameters)
     {
        if(isset($parameters['message'])) return $parameters['message'];
        else return 'Now testing...';
     }
?>
