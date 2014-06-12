<?php
session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
include "../sesion/sesion.php";
Conectarse_seg(); 
$idUsuario = $_SESSION["sesionIdUsuario"];;
$idLista =1;

function getIdTareasMatLista($idLista){
		
	$sql = "SELECT it.idTareaMatematica FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' GROUP BY it.idTareaMatematica";
	//echo $sql."<br /><br />";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = $row["idTareaMatematica"];
		
		$i++;
	}
	return($arreglo);

	
}

function getItemsLista($idLista){
		
	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' ORDER BY it.idTareaMatematica ASC";
	//echo $sql."<br /><br />";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"],
			"idLista"=> $row["idLista"],
			"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"]	,
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]	
			
			);
		$i++;
	}
	return($arreglo);

	
}

function getItemsListaSinItemsEscogidos($idLista,$itemsParaOmitir){
		
	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' ";
	for ($i = 0 ; $i < count($itemsParaOmitir); $i++){
		$sql = $sql." AND it.idItem != $itemsParaOmitir[$i]";
	}
	
	$sql = $sql." ORDER BY it.idTareaMatematica ASC";
	//echo $sql."<br /><br />";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"],
			"idLista"=> $row["idLista"],
			"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"]	,
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]	
			
			);
		$i++;
	}
	return($arreglo);

	
}


function getItemPorTareaLista($idLista, $idTarea){
		
	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' AND it.idTareaMatematica = $idTarea ORDER BY RAND() LIMIT 1";
	//echo $sql."<br /><br />";
	$res = mysql_query($sql);
while ($row = mysql_fetch_array($res)) {
		$arreglo = array(
			"idItem"=> $row["idItem"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"],
			"idLista"=> $row["idLista"],
			"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"]	,
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]	
			
			);
		
	}
	return($arreglo);

	
}

function getIdListas($idLista){
	$sql = "SELECT * FROM lista WHERE idLista = '".$idLista."' ";
//	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$idListas[$i]= array( "idLista" =>$row["idLista"],
					  "dificultadLista" => $row["dificultadLista"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	//print_r($idListas);
	return($idListas);
	
	}

function creaPauta($idUsuario,$idLista,$tiempo,$resultadoListaPauta,$porcentajeLogroPauta){
	$sql_insert = "INSERT INTO `pautaItem` (  `idLista`, `idUsuario` ,  `idPautaItem` , `fechaRespuestaPautaItem` , `tiempoPautaItem` , `resultadoListaPautaItem` , `porcentajeLogroPautaItem` )";
	$sql_insert .=" VALUES (";
   	$sql_insert .="  '$idLista', '$idUsuario', '' , NOW( ) , '$tiempo', '$resultadoListaPauta', '$porcentajeLogroPauta'";
	$sql_insert .=" )";					   
	
	$res_insert = mysql_query($sql_insert);
	$idPauta = mysql_insert_id();
	return ($idPauta);
}

function eliminaItemLista($idItem,$lista){
	$borrar = array($idItem);
	$vector_nuevo = array_diff($lista, $borrar);
	return($vector_nuevo);
	}	
	
function getDatosLista($idLista){
	$sql = "SELECT * FROM lista WHERE idLista = ".$idLista;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosLista = array ("idLista" => $row["idLista"], 
						"porcentajeLogroLista" => $row["porcentajeLogroLista"],
						"itemsMinimosLista" => $row["itemsMinimosLista"],
						"itemsMaximosLista" => $row["itemsMaximosLista"]);
	return($datosLista);
	}




$idsListas = getIdListas($idLista);	
//echo "ids Lista";
//print_r($idsListas);
//echo "<----<br>";

$idLista = array_shift($idsListas);
$_SESSION["idLista"] = $idLista["idLista"];
//echo $idLista["idLista"]."<----ID lista";


$tareasMatematicas = getIdTareasMatLista($idLista["idLista"]);
//echo "Tareas: <br />";
//print_r($tareasMatematicas);
//echo "<br /><br />";


for ($i = 0 ; $i < count($tareasMatematicas); $i++){
	$primerosItems[$i] = getItemPorTareaLista($idLista["idLista"],$tareasMatematicas[$i]);
	$itemsEscogidos[$i] =  $primerosItems[$i]["idItem"];
	
}

//echo "Primeros Items: <br />";
//print_r($primerosItems);
//echo "<br /><br />";
//print_r($itemsEscogidos);
//echo "<br /><br />";

$listaItem = getItemsListaSinItemsEscogidos($idLista["idLista"],$itemsEscogidos);
shuffle($listaItem);
//echo "Items: <br />";
//print_r($listaItem);
//echo "<br /><br />";


//$nuevo = eliminaItemLista(9,$listaItem)

$datosLista = getDatosLista($idLista["idLista"]);

$i = count($primerosItems);
foreach ($listaItem as $item){
	if($i < $datosLista["itemsMaximosLista"]){
	$primerosItems[$i] = $item;
	$i++;
	}
}
//echo "Items finales: <br />";
$listaItem = $primerosItems;
shuffle($listaItem);
//print_r($listaItem);
echo "<br /><br />";

$tiempo=0;
$resultadoListaPauta= 0;
$porcentajeLogroPauta=0;
$_SESSION["idsListas"] = $idsListas;
$idPauta = creaPauta($idUsuario,$idLista["idLista"],$tiempo,$resultadoListaPauta,$porcentajeLogroPauta);
$_SESSION["idPauta"] = $idPauta;
//echo $idPauta."IDPAUTA";
//print_r($listaItem);
$_SESSION["listaResolucion"] = $listaItem;

$_SESSION["puntajeTotal"] = 0;
$_SESSION["indice"] = 0;
$_SESSION["maximoLista"] = $datosLista["itemsMaximosLista"];
$_SESSION["minimoLista"] = $datosLista["itemsMinimosLista"];
$_SESSION["porcentajeLogro"] = $datosLista["porcentajeLogroLista"];
$_SESSION["respuesta"] = 0;

$i = 0;
$respuestas = array();
foreach($listaItem as $lista){
	$respuesta[$i] = 0;
	$i++;
	}
//print_r($_SESSION);
$_SESSION["puntajes"] = $respuesta;
//print_r($listaItem);
echo "<br>";


$j = 0;
dirigirse_a("item.php");
?>

<p><a href="item.php">item</a>  
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


