<?php
session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";
//include "sesion/sesion.php";
Conectarse_seg(); 
$idUsuario = 1;
$idLista =1;

function getItemsLista($idLista){
		
	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' ORDER BY li.idItem ASC";
//	echo $sql;
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
echo "ids Lista";
print_r($idsListas);
echo "<----<br>";
$idUsuario = 1;
$_SESSION["idUsuario"] = $idUsuario;
$idLista = array_shift($idsListas);
$_SESSION["idLista"] = $idLista["idLista"];
echo $idLista["idLista"]."<----ID lista";


$listaItem = getItemsLista($idLista["idLista"]);
//shuffle($listaItem);

$listaItem = array_reverse( $listaItem );  
print_r($listaItem);
$datosLista = getDatosLista($idLista["idLista"]);
$tiempo=0;
$resultadoListaPauta= 0;
$porcentajeLogroPauta=0;
$_SESSION["idsListas"] = $idsListas;
$idPauta = creaPauta($idUsuario,$idLista["idLista"],$tiempo,$resultadoListaPauta,$porcentajeLogroPauta);
$_SESSION["idPauta"] = $idPauta;
echo $idPauta."IDPAUTA";
//print_r($listaItem);
$_SESSION["listaResolucion"] = $listaItem;

$_SESSION["puntajeTotal"] = 0;
$_SESSION["indice"] = 0;
$_SESSION["maximoLista"] = $datosLista["itemsMaximosLista"];
$_SESSION["minimoLista"] = $datosLista["itemsMinimosLista"];
$_SESSION["porcentajeLogro"] = $datosLista["porcentajeLogroLista"];
$_SESSION["respuesta"] = 0;



//print_r($_SESSION);

//print_r($listaItem);
echo "<br>";


$j = 0;
?>

<p><a href="item.php">item</a>  
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


