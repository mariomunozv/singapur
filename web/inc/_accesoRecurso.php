<?php 

/* Registra la lectura o envio de datos de un usuario */
function registraAcceso($idUsuario, $idTipoRecursoObservado, $idLinkAccesoRecurso){
	$sql = "INSERT INTO accesoRecurso VALUES ('$idUsuario', '', '$idTipoRecursoObservado', NOW() , $idLinkAccesoRecurso)";
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
}

function buscaAcceso($idUsuario, $idTipoRecursoObservado, $idLinkAccesoRecurso){
	$sql = "SELECT *
			FROM `accesoRecurso`
			WHERE `idUsuario` = $idUsuario
			AND `idTipoRecursoObservado` = $idTipoRecursoObservado
			AND `idLinkAccesoRecurso` = $idLinkAccesoRecurso";
	//echo $sql;
	$res = mysql_query($sql);

	if (mysql_num_rows($res) > 0 ) {
		return true;
	}else{
		return false;
	}
}


?>