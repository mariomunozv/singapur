<?php
require("inc/config.php");

$titulo = $_REQUEST["titulo"];
$bienvenida = $_REQUEST["bienvenida"];
$link = $_REQUEST["link"];
$limite = $_REQUEST["limite"];

function guardaActividad($titulo, $estado, $bienvenida, $link, $limite)
{
	$sql = "INSERT INTO actividad values($titulo, $estado, $bienvenida, $link, $limite)";
	echo $sql;
	$res = mysql_query($sql);
	$row = mysql_affected_rows();
	if($row > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(guardaActividad($titulo, 1, $bienvenida, $link, $limite))
{
	echo "se inserto la actividad $titulo";
}
else
{
	echo "no se pudo insertar la actividad";
}
?>