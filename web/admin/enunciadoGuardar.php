<?php
ini_set("display_errors","on");
include("../inc/_enunciado.php");
require("inc/config.php");

$enunciado = $_POST['enunciados'];
$cantidad = $_POST['cantidad'];




//print_r($enunciado);
$i = 0;
foreach ($enunciado as $cadaEnunciado){

	// Abierto o cerrado
	if (!isset($_POST["abiertos_".$i])){
		$abierto = 0;
	}else{
		$abierto = $_POST["abiertos_".$i];
	}
	
	// Tipo input
	if (!isset($_POST["tipoInputEnunciado_".$i])){
		$tipo = "NULL";
	}else{
		$tipo = $_POST["tipoInputEnunciado_".$i];
	}
	
	
	if (!isset($_POST["respuestaCorrectaEnunciado_".$i])){
		$respuesta = "NULL";
	}else{
		$respuesta = $_POST["respuestaCorrectaEnunciado_".$i];
	}
	
	
	
	
	$i++; 
	
	
	
	
	if(crearEnunciado($cadaEnunciado,$respuesta,$abierto, $tipo)>0)
	{
		echo "insertó";
	}
	else
	{
		echo "no insertó";
	}
}
?>