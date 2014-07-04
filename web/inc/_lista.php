<?php

function getTextoTransicion($idLista){
	$sql = "SELECT textoTransicionLista FROM lista WHERE idLista = ".$idLista;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["textoTransicionLista"]);
}
	
	
function getDatosLista($idLista){
	$sql = "SELECT * FROM lista WHERE idLista = ".$idLista;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosLista = array ("idLista" => $row["idLista"],
						"idActividad" => $row["idActividad"],
						"anteriorLista" => $row["anteriorLista"],
						"nombreLista" => $row["nombreLista"],
						"dificultadLista" => $row["dificultadLista"],
						"tipoLista" => $row["tipoLista"],
						"porcentajeLogroLista" => $row["porcentajeLogroLista"],
						"puntajeTotalLista" => $row["puntajeTotalLista"],
						"itemsMinimosLista" => $row["itemsMinimosLista"],
						"itemsMaximosLista" => $row["itemsMaximosLista"]);
	return($datosLista);
}


function getListaDeActividad($idActividad){
	$sql = "SELECT * FROM lista WHERE idActividad = ".$idActividad;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosLista = array ("idLista" => $row["idLista"],
						"idActividad" => $row["idActividad"],
						"anteriorLista" => $row["anteriorLista"],
						"nombreLista" => $row["nombreLista"],
						"dificultadLista" => $row["dificultadLista"],
						"tipoLista" => $row["tipoLista"],
						"porcentajeLogroLista" => $row["porcentajeLogroLista"],
						"itemsMinimosLista" => $row["itemsMinimosLista"],
						"itemsMaximosLista" => $row["itemsMaximosLista"]);
	return($datosLista);		
}


/*function getListasSesion($idSesionLaboratorio){
	$sql = "SELECT * FROM lista WHERE idSesionLaboratorio = '$idSesionLaboratorio'";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$arreglo[$i] = array( 
				"idLista" =>$row["idLista"],
				"nombreLista" => $row["nombreLista"],
				"dificultadLista" => $row["dificultadLista"],
				"tipoLista" => $row["tipoLista"],
				"porcentajeLogroLista" => $row["porcentajeLogroLista"],
				"itemsMinimosLista" => $row["itemsMinimosLista"],
				"itemsMaximosLista" => $row["itemsMaximosLista"],
				"textoTransicionLista" => $row["textoTransicionLista"]
				);	
		$i++;
	}
	return($arreglo);
}	*/
	

	
	
function setLista($idSesionLaboratorio, $nombreLista, $dificultadLista, $tipoLista, $porcentajeLogroLista, $itemsMinimosLista, $itemsMaximosLista,$textoTransicionLista){
	
	$sql_insert = "INSERT INTO lista VALUES ('', $idSesionLaboratorio, '$nombreLista', $dificultadLista, '$tipoLista', $porcentajeLogroLista, $itemsMinimosLista, $itemsMaximosLista, '$textoTransicionLista')";
	
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
	$last_id = mysql_insert_id();
	return ($last_id);
}


function agregaItemLista($idLista, $idItem){
	
	$sql_insert = "INSERT INTO lista_Item VALUES ($idLista, $idItem)";
	
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
	$last_id = mysql_insert_id();
	return ($last_id);
}
	

	
?>