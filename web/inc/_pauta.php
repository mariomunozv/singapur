<?php 
function getPautasFormulario($idUsuario,$idFormulario){
	$sql = "SELECT * FROM pauta where idUsuario = ".$idUsuario." AND idFormulario = ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$pautasUsuario[$i] = array(
			"idFormulario"=> $row["idFormulario"],
			"idUsuario" => $row["idUsuario"],
			"idPauta" => $row["idPauta"],
			"fechaRespuestaPauta" => $row["fechaRespuestaPauta"]
			);
		$i++;
	}
	if ($i == 0){
		$pautasUsuario[$i] = array();	
	} 
	return($pautasUsuario);
}	

function getIdFormulario($idPauta){
	$sql = "SELECT idFormulario FROM pauta WHERE idPauta = $idPauta";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return ($row["idFormulario"]);
}

function existePauta($idUsuario, $idFormulario){
	$sql = "SELECT * FROM pauta WHERE idUsuario = ".$idUsuario;
	$sql .= " AND idFormulario = ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if(mysql_affected_rows()>0)
	{
		return true;
	} else {
		return false;
	}
}
	

?>