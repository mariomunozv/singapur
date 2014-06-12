<?php 
/* mensajes recibidos */
function getMensajesUsuario($idUsuario){
	$sql = "SELECT * 
	FROM `mensaje` 
	WHERE paraMensaje = "."'$idUsuario'"." 
	AND YEAR(fechaMensaje) = YEAR(NOW())
	ORDER BY fechaMensaje DESC";
	$res = mysql_query($sql);
   	return ($res);
} 

/* mensajes enviados */
function getMensajesEnviadosUsuario($idUsuario){
	$sql = "SELECT * FROM `mensaje` WHERE deMensaje = "."'$idUsuario'"." ORDER BY fechaMensaje DESC";
	$res = mysql_query($sql);
   	return ($res);
} 

/* datos de un mensaje */
function getMensaje($idMensaje){
	$sql = "SELECT * FROM mensaje WHERE idMensaje= "."'$idMensaje'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosMensaje=array(
		"deMensaje"=> $row["deMensaje"],
		"paraMensaje"=> $row["paraMensaje"],
		"asuntoMensaje" => $row["asuntoMensaje"],
		"contenidoMensaje" => $row["contenidoMensaje"],
		"fechaMensaje" => $row["fechaMensaje"]
		);
	return($datosMensaje);	
}

/* cantidad de mensajes sin leer */
function getMensajesSinLeerUsuario($idUsuario){
	$sql = "SELECT COUNT(paraMensaje) 
	FROM mensaje 
	WHERE estadoMensaje = 0 
	AND YEAR(fechaMensaje) = YEAR(NOW())
	AND paraMensaje ="."'$idUsuario'";
	$res = mysql_query($sql);
	//echo $sql;
	$mensajes = mysql_result($res,0);
	return $mensajes;
}


/* Devuelve todos los datos de los mensajes de un usuario coordinador(idPerfil=3) además de los tutores(idPerfil=1) */
function getMensajesUsuarioCoordinador(){
	$sql = "SELECT * 
	FROM mensaje m 
	join detalleUsuarioProyectoPerfil d 
	on d.idUsuario = m.paraMensaje 
	WHERE d.idPerfil = 1 
	OR d.idPerfil = 3 
	ORDER BY m.fechaMensaje DESC";
	$res = mysql_query($sql);
   	return ($res);
} 


function guardaMensaje($idDe, $idPara, $asunto, $mensaje, $respuesta){
	$sql = "INSERT INTO mensaje VALUES ('$idDe', '$idPara', '', '$asunto', '$mensaje', NOW(), '', '$respuesta')";
	echo $sql;
	$result = mysql_query($sql);
	$last_id = mysql_insert_id();
	return ($last_id);
	
}

function actualizaEstadoMensaje($idMensaje){
	$sql = "UPDATE mensaje SET estadoMensaje = 1 WHERE idMensaje = ".$idMensaje;
	mysql_query($sql);
	
}

?>