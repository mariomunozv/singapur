<?php
require("inc/config.php");

$idTipoContenidoPagina = $_REQUEST["tipoContenido"];
$idActividadPagina = $_REQUEST["idActividadPagina"];
$textoContenidoPagina = $_REQUEST["contenido"];
$ordenContenidoPagina  = $_REQUEST["ordenContenido"];
$idContenidoPagina = @$_REQUEST["idContenidoPagina"];


function guardaContenidoPagina($idActividadPagina,$textoContenidoPagina, $idTipoContenidoPagina, $ordenContenidoPagina)
{
	$sql = "INSERT INTO contenidoPagina(idActividadPagina,textoContenidoPagina,idTipoContenidoPagina,ordenContenidoPagina)";
	$sql .= " VALUES('$idActividadPagina', '$textoContenidoPagina', '$idTipoContenidoPagina', '$ordenContenidoPagina')";
	//echo $sql;
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

function actualizaContenidoPagina($idContenidoPagina,$idActividadPagina,$textoContenidoPagina, $idTipoContenidoPagina, $ordenContenidoPagina)
{
	$sql = "UPDATE contenidoPagina";
	$sql .= " SET textoContenidoPagina = '".$textoContenidoPagina."',"; 
	$sql .= " idTipoContenidoPagina = '".$idTipoContenidoPagina."',";
	$sql .= " ordenContenidoPagina = '".$ordenContenidoPagina."'";
	$sql .= " WHERE idContenidoPagina = ".$idContenidoPagina;
	$sql .= " AND idActividadPagina = ".$idActividadPagina;	
	//echo $sql;
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

if($orden == "actualizar")
{
	if(actualizaContenidoPagina($idContenidoPagina,$idActividadPagina,$textoContenidoPagina, $idTipoContenidoPagina, $ordenContenidoPagina))
	{
		echo "se actualizó la actividad";
		?>
		<script language="javascript">listaPaginas(<?php echo $idActividadPagina ?>)</script>
		<?php
	}
	else
	{
		echo "no se pudo actualizar la actividad";
	}
}
else if($orden == "guardar")
{
	if(guardaContenidoPagina($idActividadPagina,$textoContenidoPagina, $idTipoContenidoPagina, $ordenContenidoPagina))
	{
		echo "se inserto la actividad $textoContenidoPagina";
		?>
		<script language="javascript">listaPaginas(<?php echo $idActividadPagina ?>)</script>
		<?php
	}
	else
	{
		echo "no se pudo insertar la actividad";
	}
}
?>