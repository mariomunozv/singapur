<?php 

function getGlosarioLetra($letra){
	$sql = "SELECT * FROM `palabra` WHERE `nombrePalabra` REGEXP '^$letra'";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
			$palabrasGlosario[$i] = array(
				"idPalabra" => $row["idPalabra"],
				"nombrePalabra" => $row["nombrePalabra"],
				"definicionPalabra" => $row["definicionPalabra"]
				);	
		$i++;
		}
	if ($i == 0){
		$palabrasGlosario[$i] = array(
			"idPalabra" => 0,
			"nombrePalabra" => "No existen palabras en esta categoría.",
			"definicionPalabra" => ""
			);	
	}
	return ($palabrasGlosario);
}	


function getPalabra($idPalabra){
	$sql ="SELECT * FROM `palabra` WHERE idPalabra = '$idPalabra'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosPalabra=array(
		"idPalabra"=> $row["idPalabra"],
		"nombrePalabra" => $row["nombrePalabra"],
		"definicionPalabra" => $row["definicionPalabra"]
		);
	return($datosPalabra);
}


function getPalabraRandom(){
	$sql ="SELECT * FROM `palabra` order by rand() LIMIT 1";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosPalabra=array(
		"idPalabra"=> $row["idPalabra"],
		"nombrePalabra" => $row["nombrePalabra"],
		"definicionPalabra" => substr($row["definicionPalabra"],0,100)."..." 
		);
	return($datosPalabra);
}


function getPalabrasTodas(){
	$sql = "SELECT * FROM palabra ";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
			$palabrasGlosario[$i] = array(
				"idPalabra" => $row["idPalabra"],
				"nombrePalabra" => $row["nombrePalabra"],
				"definicionPalabra" => $row["definicionPalabra"]
				);	
		$i++;
		}
	if ($i == 0){
		$palabrasGlosario[$i] = array(
			"idPalabra" => 0,
			"nombrePalabra" => "No existen palabras en esta categoría.",
			"definicionPalabra" => ""
			);	
	}
	return ($palabrasGlosario);
}	


?>