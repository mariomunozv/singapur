<?php

$ipJotape = "158.170.118.22";
$ipPelon = "158.170.118.5";
$ipJorge = "158.170.119.2";


if(
   		$_SERVER['REMOTE_ADDR']== $ipJotape
   ||	$_SERVER['REMOTE_ADDR']== $ipPelon 
   ||	$_SERVER['REMOTE_ADDR']== $ipJorge 
   )
{
  ini_set('display_errors','On');
}
else
{
  ini_set('display_errors','Off');
}
?> 