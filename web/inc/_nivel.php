<?php 

function getNiveles(){
	$sql = "SELECT * FROM nivel";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$niveles[$i] = array(
			"idNivel"=> $row["idNivel"],
			"nombreNivel" => $row["nombreNivel"]
			);
		$i++;
	}
	if ($i == 0){
		$niveles[$i] = array();	
	} 
	return($niveles);
}
function getNombreNivel($idNivel){
	$sql = "SELECT nombreNivel
			FROM nivel
			WHERE idNivel = ".$idNivel;
	$row = mysql_fetch_array(mysql_query($sql));
	return $row["nombreNivel"];
}