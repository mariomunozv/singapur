<?php 
function buscaPauta($idUsuario,$idLista){
	$sql = "SELECT * from pautaItem WHERE idUsuario = ".$idUsuario." AND idLista = ".$idLista;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if ($row){
		return ($row);
		}else{
		return (false);	
	}
}

function getPautaAlumno($idUsuario,$idLista){
	$sql = "SELECT * from pautaItem WHERE idUsuario = ".$idUsuario." AND idLista = ".$idLista." AND porcentajeLogroPautaItem IS NOT NULL";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$pauta = array("idLista" =>$row["idLista"],
					"idUsuario" => $row["idUsuario"],
					"idPautaItem" => $row["idPautaItem"],
					"fechaRespuestaPautaItem" => $row["fechaRespuestaPautaItem"],
					"tiempoPautaItem" => $row["tiempoPautaItem"],
					"resultadoListaPautaItem" => $row["resultadoListaPautaItem"],
					"porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"]
	);
	return($pauta["idPautaItem"]);
}

function getPautas($idLista)
{
	$sql = "SELECT * FROM pautaItem WHERE idLista = ".$idLista;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$pautas = array("idLista" =>$row["idLista"],
					"idUsuario" => $row["idUsuario"],
					"idPautaItem" => $row["idPautaItem"],
					"fechaRespuestaPautaItem" => $row["fechaRespuestaPautaItem"],
					"tiempoPautaItem" => $row["tiempoPautaItem"],
					"resultadoListaPautaItem" => $row["resultadoListaPautaItem"],
					"porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"]
	);
	return($pautas);
}

?>  