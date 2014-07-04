<?php 

function getUltimoMensajeTema($idTema){
	$sql =" SELECT * FROM mensajeTema where idTema = ".$idTema." order by idMensajeTema DESC";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idMensajeTema"]);
}
	
	
function getDatosMensajeTema($idMensajeTema){
	$sql = "SELECT * FROM mensajeTema WHERE idMensajeTema= "."'$idMensajeTema'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosMensajeTema=array(
		"idUsuario"=> $row["idUsuario"],
		"contenidoMensajeTema"=> $row["contenidoMensajeTema"],
		"estadoMensajeTema"=> $row["estadoMensajeTema"],
		"fechaMensajeTema" => $row["fechaMensajeTema"]
	);
	return($datosMensajeTema);	
}


function getRespuestaTema($idTema){
	$sql = "SELECT COUNT(idUsuario) FROM mensajeTema WHERE idTema = "."'$idTema'";
	$res = mysql_query($sql);
	$mensajes = mysql_result($res,0);
	echo $mensajes;
	return;
}
	

function getRespuestasTema($idTema){
	$sql = "SELECT * FROM `mensajeTema` WHERE idTema = ".$idTema." ORDER BY fechaMensajeTema ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$respuestasTema[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"contenidoMensajeTema" => $row["contenidoMensajeTema"],
			"fechaMensajeTema" => $row["fechaMensajeTema"]
		);
	$i++;	
	}
	if ($i == 0){
		$respuestasTema[$i] = array(
			"idTema" => 0,
			"contenidoMensajeTema" => "No existen respuestas en este Foro."
		);	
	} 
	return($respuestasTema);
}


function getRespuestasTemaOrden($idTema,$orden){
	$sql = "SELECT * FROM `mensajeTema` WHERE idTema = ".$idTema." ORDER BY fechaMensajeTema ".$orden;
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$respuestasTema[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idTema"=> $row["idTema"],
			"idMensajeTema"=> $row["idMensajeTema"],
			"tituloMensajeTema"=> $row["tituloMensajeTema"],
			"estadoMensajeTema"=> $row["estadoMensajeTema"],
			"contenidoMensajeTema" => $row["contenidoMensajeTema"],
			"fechaMensajeTema" => $row["fechaMensajeTema"]
			);
		$i++;	
	}
	
	if ($i == 0){
		$respuestasTema[$i] = array(
			"idTema" => 0,
			"contenidoMensajeTema" => "No existen respuestas en este Foro."
			);	
	} 
	return($respuestasTema);
}


function guardaMensajeForo($idTema, $idUsuario, $contenidoMensajeTema){
	$sql = "INSERT INTO `mensajeTema` ( `idTema` , `idUsuario` , `idMensajeTema` , `tituloMensajeTema` , `contenidoMensajeTema` , `fechaMensajeTema` )";
	$sql.= "VALUES (";
	$sql.= "'$idTema', '$idUsuario', '', '', '$contenidoMensajeTema', NOW( ));";
	//$sql = "INSERT INTO mensajeTema VALUES ('$idTema', '$idUsuario', '', '', '$contenidoMensajeTema', NOW())";
	$result = mysql_query($sql);
//	echo $sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
		return false;
	}
	else
		return true;
	
}



?>