<?php 


require("inc/config.php");
include "../inc/_funciones.php";

function estaFija($variable){
	if(isset($_SESSION["$variable"])){
		$idRetorno = $_SESSION["$variable"];
	}
	
	else
		$idRetorno = "";
		
	return $idRetorno;
}

$idCapitulo = $_REQUEST["idCapitulo"];


$condicion = "idPadreSeccionBitacora = ".$idCapitulo;

$arreglo = getIdNombreTablaCondicionado("SeccionBitacora", $condicion); // 220 = idSeccionBitacora de Capitulo 12, "Números hasta 40"
//getIdNombreTabla("SeccionBitacora");
$idVariableFija = estaFija("fijar_idSeccionBitacora");
armaSelectActual($arreglo,"SeccionBitacora",$idVariableFija);
//armaSelect($arreglo,"TareaMatematica"); 
?>