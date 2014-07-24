<?php 

function getRecurso($idRecurso){
	$sql ="SELECT * FROM `recurso` a left join tipoRecurso b on a.idTipoRecurso = b.idTipoRecurso where a.idRecurso = ".$idRecurso." ORDER BY idRecurso";
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosRecurso=array(
		"idRecurso"=> $row["idRecurso"],
		"nombreRecurso" => $row["nombreRecurso"],
		"idTipoRecurso" => $row["idTipoRecurso"],
		"urlRecurso" => $row["urlRecurso"],
		"nombreTipoRecurso" => $row["nombreTipoRecurso"],
		"paginaTipoRecurso" => $row["paginaTipoRecurso"],
		"tablaTipoRecurso" => $row["tablaTipoRecurso"],
		
		);
	return($datosRecurso);
}


function setRecurso($idTipoRecurso, $nombreRecurso, $urlRecurso, $decripcionRecurso){
	$sql = "INSERT INTO recurso (
			idTipoRecurso,	
			nombreRecurso,
			urlRecurso,
			decripcionRecurso,
			estadoRecurso
			) VALUES (
			$idTipoRecurso, 
			'$nombreRecurso', 
			'$urlRecurso', 
			'$decripcionRecurso',
			1
			)";
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}else{
		info('Recurso insertado satisfactoriamente.');
		$idRecurso = mysql_insert_id();
		return ($idRecurso);
	}
	
}

function getLinkRecurso($idRecurso){
	$rec = getRecurso($idRecurso);
	
	switch ($rec["idTipoRecurso"]){
	
		case 1: // Archivos
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$idRecurso;
		break;
		case 5: // Archivos Adicionales
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$idRecurso;
		break;
		
		case 2: // Bitacoras
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		
		case 3: // Foros
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		
		case 4: // Bitacoras UTP
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		
		case 6: // Actividad 
			echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		

	
	}
	
	//echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$idRecurso;
}


function getLinkRecursoDownload($idRecurso){
	$rec = getRecurso($idRecurso);
	
	switch ($rec["idTipoRecurso"]){
	
		case 1: // Archivos
			echo '<a href="recursoDownload.php?'.$rec["tablaTipoRecurso"]."=".$idRecurso.'"> [ Descargar ]</a>';
		break;
		
		case 2: // Bitacoras
			echo "";//echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		
		case 4: // Foros
			echo "";//echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
		
		case 5: // Actividades
			echo "";//echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$rec["urlRecurso"];
		break;
	
	}
	
	//echo $rec["paginaTipoRecurso"]."?".$rec["tablaTipoRecurso"]."=".$idRecurso;
	
}

?>