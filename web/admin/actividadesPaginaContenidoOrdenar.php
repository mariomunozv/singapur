<?php 
require("inc/config.php");

function ordenaContenidoPaginas($idContenidoPagina, $ordenActividadPagina)
{
	$sql = "UPDATE contenidoPagina";
	$sql .= " SET ordenContenidoPagina = ".$ordenActividadPagina;
	$sql .= " WHERE idContenidoPagina = ".$idContenidoPagina;
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

$listaId = $_REQUEST["tblAcPagCon"];
$i = 0;
foreach($listaId as $id)
{
	if($i > 0)
	{
		ordenaContenidoPaginas($id, $i);
	}
	$i++;
}
?>