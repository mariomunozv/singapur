<?php 

function getNombreComuna($idComuna){
	$sql = "SELECT nombreComuna 
		FROM comuna 
		WHERE idComuna = ".$idComuna;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return $row[0];
}