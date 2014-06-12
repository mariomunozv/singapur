<?php

function getSeccionesFormulario($idFormulario){
	$sql = "SELECT * FROM seccionFormulario WHERE idFormulario = ".$idFormulario;
	$res = mysql_query($sql);
	//echo $sql;
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$formulario[$i] = array(
				"idSeccionFormulario" => $row["idSeccionFormulario"],
				"idFormulario" => $row["idFormulario"],
				"idPadreSeccionFormulario" => $row["idPadreSeccionFormulario"],
				"tituloSeccionFormulario" => $row["tituloSeccionFormulario"],
				"descripcionSeccionFormulario" => $row["descripcionSeccionFormulario"]);
				$i++;
	}
	return ($formulario);
}	

function getSeccionesTodas(){
	$sql = "SELECT * FROM seccionFormulario";
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$formulario[$i] = array(
				"idSeccionFormulario" => $row["idSeccionFormulario"],
				"idFormulario" => $row["idFormulario"],
				"idPadreSeccionFormulario" => $row["idPadreSeccionFormulario"],
				"tituloSeccionFormulario" => $row["tituloSeccionFormulario"],
				"descripcionSeccionFormulario" => $row["descripcionSeccionFormulario"]);
				$i++;
	}
	return ($formulario);
}	

function crearSeccion($idFormulario,$idPadreSeccionFormulario,$tituloSeccionFormulario,$descripcionSeccionFormulario)
{
	$sql = "INSERT INTO `seccionFormulario` (`idFormulario` ,`idPadreSeccionFormulario` ,`tituloSeccionFormulario` ,`descripcionSeccionFormulario`)";
	$sql .=	"VALUES ( '$idFormulario', $idPadreSeccionFormulario, '$tituloSeccionFormulario', '$descripcionSeccionFormulario');";
	//echo $sql;
	$res = mysql_query($sql);
	return $res;
}
?>