<?php
require("inc/config.php");

$titulo = $_REQUEST["titulo"];
$bienvenida = $_REQUEST["bienvenida"];
$link = $_REQUEST["link"];
$limite = $_REQUEST["limite"];
$estado = 1;
$idActividad = @$_REQUEST["idActividad"];
$orden = $_REQUEST["orden"];

function guardaActividad($titulo, $estado, $bienvenida, $link, $limite)
{
	$sql = "INSERT INTO actividad(tituloActividad,estadoActividad,bienvenidaActividad,linkActividad,limiteVecesActividad)";
	$sql .= " VALUES('$titulo', $estado, '$bienvenida', '$link', $limite)";
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

function actualizaActividad($idActividad, $titulo, $estado, $bienvenida, $link, $limite)
{
	$sql = "UPDATE actividad";
	$sql .= " SET tituloActividad = '".$titulo."',"; 
	$sql .= " estadoActividad = '".$estado."',";
	$sql .= " bienvenidaActividad = '".$bienvenida."',";
	$sql .= " linkActividad = '".$link."',";
	$sql .= " limiteVecesActividad = '".$limite."'";
	$sql .= " WHERE idActividad = ".$idActividad;
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
	if(actualizaActividad($idActividad, $titulo, $estado, $bienvenida, $link, $limite))
	{
		echo "se actualizó la actividad";
		?>
		<script language="javascript">list_actividades()</script>
		<?php
	}
	else
	{
		echo "no se pudo actualizar la actividad";
	}
}
else if($orden == "guardar")
{
	if(guardaActividad($titulo, $estado, $bienvenida, $link, $limite))
	{
		echo "se inserto la actividad $titulo";
		?>
		<script language="javascript">list_actividades()</script>
		<?php
	}
	else
	{
		echo "no se pudo insertar la actividad";
	}
}
?>