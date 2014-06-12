<?php
session_start();
ini_set("display_errors","on");
include "../inc/conecta.php";
include "../inc/_funciones.php";
include "../sesion/sesion.php";

include "../inc/_accesoRecurso.php";
include "../inc/_lista.php";

Conectarse_seg();

@$idActividad = $_SESSION["sesionIdActividad"];
$datosLista = getListaDeActividad($idActividad);


$idUsuario = $_SESSION["sesionIdUsuario"];
$idLista = $datosLista["idLista"];
$_SESSION["porcentajeLogroLista"] = $datosLista["porcentajeLogroLista"];

/* En caso de que exista una lista anterior de la que dependa */
if ($datosLista["anteriorLista"] != NULL){

	$datosListaAnterior = getDatosLista($datosLista["anteriorLista"]);

	$idListaAnterior = $datosListaAnterior["idLista"];
	$porcentajeLogroPaso = $datosListaAnterior["porcentajeLogroLista"];
	$_SESSION["porcentajeLogroLista"] = $porcentajeLogroPaso;
	// Consultar por las pautas que tienen el idListaAnterior y saber si hay con el porcentajeLogroPaso
	$numeroPautasExito = cuentaPautasItemSobrePorcentaje($idListaAnterior, $porcentajeLogroPaso, $idUsuario);

	/* No puede continuar
	if ($numeroPautasExito < 1){
		alerta("Debes responder la actividad anterior con un éxito igual o superior al ".$porcentajeLogroPaso."% de logro para avanzar a la siguiente actividad.");
		dirigirse_a("../actividades.php?idActividad=".$datosListaAnterior["idActividad"]);
	}
	*/


}


/* Registro de acceso a una actividad */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 13, @$idActividad);





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
			"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"],
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]

			);
		$i++;
	}
	return($arreglo);


}

//En $itemsParaOmitir se almacena la lista de item seleccionados
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

function cuentaPautasItemSobrePorcentaje($idLista, $porcentajelogro, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pautaItem
			WHERE idLista = $idLista
			AND idUsuario = $idUsuario
			AND porcentajeLogroPautaItem >= $porcentajelogro";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}


function eliminaItemLista($idItem,$lista){
	$borrar = array($idItem);
	$vector_nuevo = array_diff($lista, $borrar);
	return($vector_nuevo);
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
$_SESSION["tiempo"] = 0;
$i = 0;


//print_r($_SESSION);
$_SESSION["puntajes"] = array();
//print_r($listaItem);
echo "<br>";


$j = 0;
dirigirse_a("itemNew.php");
?>

</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


