<?php

require("inc/config.php");

$idJornada = $_REQUEST["idJornada"];
$nombreJornada = $_REQUEST["nombreJornada"];
$moduloJornada = $_REQUEST["moduloJornada"];
$descripcionJornada = $_REQUEST["descripcionJornada"];
$visibleJornada = $_REQUEST["visibleJornada"];

if($visibleJornada == "on")
{
	$visibleJornada = 1;
}
else
{
	$visibleJornada = 0;
}


function setJornada($idJornada,$nombreJornada,$moduloJornada,$descripcionJornada,$visibleJornada)
{
	$sql = "UPDATE jornada SET";
	$sql .= " nombreJornada = '".$nombreJornada."',";
	$sql .= " moduloJornada = '".$moduloJornada."',";
	$sql .= " descripcionJornada = '".$descripcionJornada."',";
	$sql .= " visibleJornada = ".$visibleJornada;	
	$sql .= " WHERE idJornada = ".$idJornada;
	//echo $sql;
	$res = mysql_query($sql);
	$rows = mysql_affected_rows();
	if($rows > 0)
	{
		return true;
	}
	else
	{
		return false;	
	}
	
}

if(setJornada($idJornada,$nombreJornada,$moduloJornada,$descripcionJornada,$visibleJornada))
{
	echo "<br>jornada actualizada";
}
else
{
	echo "<br>no se actualizó la jornada";
}
?>