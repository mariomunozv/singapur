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