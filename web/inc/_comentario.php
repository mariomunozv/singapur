<?php 

function getComentariosMensaje($idMensaje){
	$sql = "SELECT * FROM comentario WHERE tablaComentario = 'mensajeTema' AND idReferenciaComentario = ".$idMensaje;
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$comentarios[$i] = array(
			"idComentario"=> $row["idComentario"],
			"idUsuario"=> $row["idUsuario"],
			"textoComentario" => $row["textoComentario"],
			"fechaComentario" => $row["fechaComentario"],
			"estadoComentario" => $row["estadoComentario"]
		);
	$i++;	
	}
	if ($i == 0){
		$comentarios[$i] = array();	
	} 
	return($comentarios);
}

function getComentariosTabla($tablaComentario, $idReferenciaComentario){
	$sql = "SELECT * FROM comentario WHERE tablaComentario = '$tablaComentario' AND idReferenciaComentario = ".$idReferenciaComentario;
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$comentarios[$i] = array(
			"idComentario"=> $row["idComentario"],
			"idUsuario"=> $row["idUsuario"],
			"textoComentario" => $row["textoComentario"],
			"fechaComentario" => $row["fechaComentario"],
			"estadoComentario" => $row["estadoComentario"]
		);
	$i++;	
	}
	if ($i == 0){
		$comentarios[$i] = array();	
	} 
	
	return($comentarios);
}


function guardaComentario($idUsuario, $tablaComentario, $idReferenciaComentario, $textoComentario){
	$sql = "INSERT INTO comentario ( idUsuario , tablaComentario , idReferenciaComentario , textoComentario  , estadoComentario)";
	$sql.= "VALUES (";
	$sql.= "'$idUsuario', '$tablaComentario', '$idReferenciaComentario', '$textoComentario', 0);";
	$result = mysql_query($sql);
	//echo $sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
		return false;
	}
	else
		return true;
	
}

?>