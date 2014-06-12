<?php 

function getNombrePerfil ($idPerfil){
	$sql = " SELECT * FROM `perfil` WHERE idPerfil = ".$idPerfil;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombrePerfil"];
	
}


function getPerfiles(){
	$sql = "SELECT * FROM `perfil`";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$perfiles[$i] = array(
			"idPerfil"=> $row["idPerfil"],
			"nombrePerfil" => $row["nombrePerfil"]
			
			);
		$i++;
	}
	if ($i == 0){
		$perfiles[$i] = array();	
	} 
	return($perfiles);
}
?>