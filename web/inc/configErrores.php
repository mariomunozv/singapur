<?php

$debug_on = false;

$ip1 = "158.170.118.11";
$ip2 = "158.170.119.78"; //juanjo


if(
   		$_SERVER['REMOTE_ADDR']== $ip1
   ||	$_SERVER['REMOTE_ADDR']== $ip2 
   
   && $debug_on
   )
{
  ini_set('display_errors','On');
}
else
{
  ini_set('display_errors','Off');
}
?> 