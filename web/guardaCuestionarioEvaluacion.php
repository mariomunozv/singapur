<?php
ini_set("Display_Errors","On");
require("inc/incluidos.php");
require("hd.php");

function getSeleccionada($respuesta){
	$sql = "select * from etiqueta WHERE idEtiqueta = ".$respuesta;
	//echo $sql;
	$res = mysql_query($sql);
	@$row = mysql_fetch_array($res);
	$valorSeleccionada = $row["nombreEtiqueta"];
	return($valorSeleccionada);
}

function setRespuesta($idEnunciado,$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idEnunciado` , `idFormulario` , `idUsuario` , `idPauta` , `idRespuesta` ,  `opcionSeleccionada` ,`valorSeleccionada`   )";
	$sql_insert .= " VALUES ( '$idEnunciado', '$idFormulario', '$idUsuario', '$idPauta','','$opcionSeleccionada', '$valorSeleccionada')";
	$res = mysql_query($sql_insert);
	//echo $sql_insert; 
	$cuenta = mysql_affected_rows();
	if($cuenta != 0)
	{	
		return true;
	}
	else
	{
		return false;
	}
}

function getEnunciadosTodos($idFormulario)
{
	$sql = "SELECT * FROM enunciado WHERE idEnunciado IN (";
	$sql .="SELECT idEnunciado FROM detalleSeccionEnunciado  WHERE idSeccionFormulario in (";
	$sql .="SELECT idSeccionFormulario FROM seccionFormulario WHERE idFormulario = $idFormulario AND idSeccionFormulario <> 25))";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado" => $row["textoEnunciado"],
			"esAbiertaEnunciado" => $row["esAbiertaEnunciado"],
			"tipoInputEnunciado" => $row["tipoInputEnunciado"]
		);
		$i++;
	}
	return($arreglo);
}

$idFormulario = $_SESSION["idFormulario"];
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPauta = $_SESSION["idPauta"];
$enunciados = getEnunciadosTodos($idFormulario);
$cuenta=0;


foreach($enunciados as $enun)
{
	if($enun["tipoInputEnunciado"] == "Check" )
	{	
		$elemento = "resp_".$enun["idEnunciado"];
		$seleccinoadas = $_POST[$elemento];
		$respuesta = implode(",",$seleccinoadas);
	}
	else
	{
		$elemento = "resp_".$enun["idEnunciado"];
		$respuesta = $_POST[$elemento];
	}
	setRespuesta($enun["idEnunciado"],$idFormulario,$idUsuario,$idPauta,$respuesta,$respuesta);
	$cuenta++;
}

if($cuenta != 0)
{
	dirigirse_a("fin.html");
}
else
{
	echo "Formulario: ".$idFormulario."<br>";
	echo "Usuario: ".$idUsuario."<br>";
	echo "Pauta: ".$idPauta."<br>";
	echo "Respuesta: ".$respuesta."<br>";
	echo "Hubo un error";
}