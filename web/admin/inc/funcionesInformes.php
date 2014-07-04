<?php function getLaboratorios(){
	$sql = "SELECT * FROM laboratorio";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$laboratorios[$i] = array( "idLaboratorio" =>$row["idLaboratorio"],
					  "nombreLaboratorio" => $row["nombreLaboratorio"]);	
	$i++;
	
	}
	//print_r($idListas);
	return($laboratorios);
	
}



?>