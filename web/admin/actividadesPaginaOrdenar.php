<?php 
require("inc/config.php");

function ordenaPaginas($idActividadPagina, $ordenActividadPagina)
{
	$sql = "UPDATE actividadPagina";
	$sql .= " SET ordenActividadPagina = ".$ordenActividadPagina;
	$sql .= " WHERE idActividadPagina = ".$idActividadPagina;
	//echo $sql."<br>";
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

$listaId = $_REQUEST["tblAcPag"];
$i = 0;
foreach($listaId as $id)
{
	if($i > 0)
	{
		ordenaPaginas($id, $i);
	}
	$i++;
}
?>