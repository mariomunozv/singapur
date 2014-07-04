<?php 

$anoActual = '2014';

function getNotificaciones($idUsario){
	global $anoActual;	
	$sql="SELECT * FROM notificacion WHERE idUsuario = '$idUsario' AND fechaNotificacion > '".$anoActual."-01-01' ORDER BY fechaNotificacion DESC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($res)) {
	
			$notificaciones[$i] = array(
				"idNotificacion" => $row["idNotificacion"],
				"idUsuario" => $row["idUsuario"],
				"idTipoNotificacion" => $row["idTipoNotificacion"],
				"textoNotificacion" => $row["textoNotificacion"],
				"linkNotificacion" => $row["linkNotificacion"],
				"fechaNotificacion" => $row["fechaNotificacion"],
				"idImagenNotificacion" => $row["idImagenNotificacion"],
				"estadoNotificacion" => $row["estadoNotificacion"]
				);	
		$i++;
		}
	if ($i == 0){
		$notificaciones[$i] = array();	
	} 
	return ($notificaciones);
}


function setNotificacion($idUsuario, $idTipoNotificacion, $textoNotificacion, $linkNotificacion, $idImagenNotificacion){
	/* Tipo */
	// 1: Mensaje enviado
	// 2: Comentario foro
	$sql = "INSERT INTO notificacion 
				(idUsuario, idTipoNotificacion, textoNotificacion, 
			 	linkNotificacion, fechaNotificacion, idImagenNotificacion)
			
			VALUES ($idUsuario, $idTipoNotificacion, '$textoNotificacion', 
					'$linkNotificacion', NOW() , $idImagenNotificacion)";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}	
	
}

function actualizaEstadoNotificacion($idNotificacion){
	$sql = "UPDATE notificacion SET estadoNotificacion = 1 WHERE idNotificacion = $idNotificacion";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}	
}

function getNotificacionesSinLeer($idUsuario){
	$sql = "SELECT COUNT(idNotificacion) 
			FROM notificacion 
			WHERE estadoNotificacion = 0 
			AND idUsuario =".$idUsuario;
	$res = mysql_query($sql);
	//echo $sql;
	$notificaciones = mysql_result($res,0);
	return $notificaciones;
}
?>