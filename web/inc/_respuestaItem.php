<?php 

function getRespuestaUsuarioItem($idItem,$idUsuario,$idPauta){

	$sql = "select * from respuestaItem WHERE idItem = ".$idItem." AND idUsuario = ".$idUsuario." AND idPautaItem = ".$idPauta;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuestaUsuarioItem = array("idRespuesta" => $row["idRespuestaItem"],
									"valorSeleccionada" => $row["valorSeleccionadaItem"],
									"opcionSeleccionada" => $row["opcionSeleccionadaItem"],
									"valorCorrecta" => $row["valorCorrectaItem"],
									"puntajeRespuestaItem" => $row["puntajeRespuestaItem"],
									"opcionCorrecta" => $row["opcionCorrectaItem"]);
	return($respuestaUsuarioItem);
}	


function getRespuestaUsuarioByPauta($idUsuario,$idPauta){

	$sql = "select * from respuestaItem WHERE idUsuario = ".$idUsuario." AND idPautaItem = ".$idPauta;
	//echo $sql;
	$res = mysql_query($sql);

	while($row = mysql_fetch_array($res))
	{	
		$respuestaUsuarioItem[$row["idItem"]] = array("idRespuesta" => $row["idRespuestaItem"],
										"valorSeleccionada" => $row["valorSeleccionadaItem"],
										"opcionSeleccionada" => $row["opcionSeleccionadaItem"],
										"valorCorrecta" => $row["valorCorrectaItem"],
										"puntajeRespuestaItem" => $row["puntajeRespuestaItem"],
										"opcionCorrecta" => $row["opcionCorrectaItem"]);
	}
	return($respuestaUsuarioItem);
}

?> 