<?php
require("inc/config.php");

$nombreActividadPagina = $_REQUEST["titulo"];
$tipoActividadPagina = $_REQUEST["tipoActividad"];
$ordenActividadPagina = $_REQUEST["ordenPagina"];
$idActividad = @$_REQUEST["idActividad"];
$idActividadPagina = $_REQUEST["idActividadPagina"];
$orden = $_REQUEST["orden"];

function guardaActividadPagina($idActividad,$nombreActividadPagina, $tipoActividadPagina, $ordenActividadPagina)
{
	$sql = "INSERT INTO actividadPagina(idActividad,nombreActividadPagina,tipoActividadPagina,ordenActividadPagina)";
	$sql .= " VALUES('$idActividad', '$nombreActividadPagina', '$tipoActividadPagina', '$ordenActividadPagina')";
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

function actualizaActividadPagina($idActividadPagina,$idActividad,$nombreActividadPagina, $tipoActividadPagina, $ordenActividadPagina)
{
	$sql = "UPDATE actividadPagina";
	$sql .= " SET nombreActividadPagina = '".$nombreActividadPagina."',"; 
	$sql .= " tipoActividadPagina = '".$tipoActividadPagina."',";
	$sql .= " ordenActividadPagina = '".$ordenActividadPagina."'";
	$sql .= " WHERE idActividadPagina = ".$idActividadPagina;
	$sql .= " AND idActividad = ".$idActividad;	
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
	if(actualizaActividadPagina($idActividadPagina,$idActividad,$nombreActividadPagina, $tipoActividadPagina, $ordenActividadPagina))
	{
		echo "se actualizó la actividad";
		?>
		<script language="javascript">detalle_actividad(<?php echo $idActividad ?>)</script>
		<?php
	}
	else
	{
		echo "no se pudo actualizar la actividad";
	}
}
else if($orden == "guardar")
{
	if(guardaActividadPagina($idActividad,$nombreActividadPagina, $tipoActividadPagina, $ordenActividadPagina))
	{
		echo "se inserto la actividad $titulo";
		?>
		<script language="javascript">detalle_actividad(<?php echo $idActividad ?>)</script>
		<?php
	}
	else
	{
		echo "no se pudo insertar la actividad";
	}
}
?>