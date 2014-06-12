<?php 

function getTareasMatematicas(){
	// WHERE estadoHerramienta = 1
	$sql = "SELECT * FROM tareaMatematica WHERE estadoTareaMatematica = 1";
	$res = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($res)) {
	
			$herramienta[$i] = array(
	
			"idTareaMatematica" => $row["idTareaMatematica"],
			"nombreTareaMatematica" => $row["nombreTareaMatematica"],
			"idCampo" => $row["idCampo"]
			);	
		$i++;
		}
	if ($i == 0){
		
		$herramienta[$i] = array();	
	
	} 
	return ($herramienta);
}

function setTareaMatematica($idCampo, $nombreTareaMatematica){
	
	$sql_insert = "INSERT INTO tareaMatematica (idCampo, nombreTareaMatematica,estadoTareaMatematica) 
	VALUES ( $idCampo, '$nombreTareaMatematica',1)";
	
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}else{
		echo "Tarea matematica insertada correctamente";	
	}
	$last_id = mysql_insert_id();
	return ($last_id);
}

function getTareaMatematicaItem($idItem){
	$sql = "SELECT nombreTareaMatematica";
	$sql .= " FROM tareaMatematica t, item i";
	$sql .= " WHERE t.idTareaMatematica = i.idTareaMatematica";
	$sql .= " AND i.idItem = ".$idItem;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}


?>