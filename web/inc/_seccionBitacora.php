<?php 
function getPadre($idSeccionBitacora){
	$sql ="SELECT idPadreSeccionBitacora FROM seccionBitacora WHERE idSeccionBitacora = $idSeccionBitacora";
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idPadreSeccionBitacora"]);
}


function getSeccionBitacoraJornada($idJornada){
	$sql ="SELECT * FROM seccionBitacora a left join tipoRecurso b on a.idTipoRecurso = b.idTipoRecurso where a.idRecurso = ".$idRecurso;
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosRecurso=array(
		"idRecurso"=> $row["idRecurso"],
		"nombreRecurso" => $row["nombreRecurso"],
		"urlRecurso" => $row["urlRecurso"],
		"nombreTipoRecurso" => $row["nombreTipoRecurso"],
		"paginaTipoRecurso" => $row["paginaTipoRecurso"],
		"tablaTipoRecurso" => $row["tablaTipoRecurso"],
		
		);
	return($datosRecurso);
}

function getSeccionBitacoraCapitulo($idCapitulo){
	$sql = "SELECT * 
			FROM seccionBitacora
			WHERE idPadreSeccionBitacora = ".$idCapitulo;
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){	
		$datosRecurso[$i]=array(
			"idSeccionBitacora"=> $row["idSeccionBitacora"],
			"parteLibro" => $row["parteLibro"],
			"idPadreSeccionBitacora" => $row["idPadreSeccionBitacora"],
			"idNivelCursoSeccionBitacora" => $row["idNivelCursoSeccionBitacora"],
			"nombreSeccionBitacora" => $row["nombreSeccionBitacora"],
			"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"],
			"estadoSeccionBitacora" => $row["estadoSeccionBitacora"]
			);
			$i++;
	}
	return($datosRecurso);
}


function getSeccionPadreBitacora($parte){
	//$sql = "SELECT * FROM seccionBitacora a join detalleJornadaSeccionBitacora b join jornada c on a.idSeccionBitacora = b.idSeccionBitacora and b.idJornada = c.idJornada where c.idCursoCapacitacion = ".$idCurso." AND idPadreSeccionBitacora is NULL";
	//$sql = "SELECT * FROM seccionBitacora WHERE idPadreSeccionBitacora IS NULL";
	$sql = "SELECT * FROM seccionBitacora WHERE parteLibro = '".$parte."'";
	$sql .= " AND idPadreSeccionBitacora is NULL"; 
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$seccionesPadre[$i]=array(
		"idSeccionBitacora"=> $row["idSeccionBitacora"],
		"nombreSeccionBitacora" => $row["nombreSeccionBitacora"]);
		$i++;
	}
	if ($i == 0){
		$seccionesPadre = NULL;				
	} 
	return($seccionesPadre);
}


function getCapitulosConNivel($parteLibro){
	$sql = "SELECT * FROM seccionBitacora WHERE idPadreSeccionBitacora is NULL AND estadoSeccionBitacora > 0 order by idNivelCursoSeccionBitacora ASC, nombreSeccionBitacora ASC";
	//echo $sql;
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
			$arreglo[$i] = array(
			"idSeccionBitacora" => $row["idSeccionBitacora"],
			"nombreSeccionBitacora".$tabla => $row["idNivelCursoSeccionBitacora"]."º - ".$row["nombreSeccionBitacora"]
			);	
		$i++;
		}

	return ($arreglo);
}

function getPartesLibro($idNivel){
	$curso = $idNivel{0};
	$sql = "SELECT DISTINCT(parteLibro) FROM seccionBitacora WHERE idNivelCursoSeccionBitacora=".$curso." AND estadoSeccionBitacora = 1";
	//echo $sql;
	$ident = mysql_query($sql);
	while ($row = mysql_fetch_array($ident)) {
		$arreglo[]= array(
			"parteLibro" => $row["parteLibro"]
		);	
	}
	return ($arreglo);
}

function getParteByCapitulo($idSeccionBitacora){
	$sql = "SELECT parteLibro
	FROM seccionBitacora
	WHERE idSeccionBitacora IN (
	SELECT idPadreSeccionBitacora 
	FROM seccionBitacora
	WHERE idSeccionBitacora = ".$idSeccionBitacora.")";
	$res = mysql_query($sql);
	return mysql_result($res,0);
}

function getCapituloBySeccion($idSeccionBitacora){
	$sql = "SELECT idPadreSeccionBitacora 
		FROM seccionBitacora
		WHERE idSeccionBitacora = ".$idSeccionBitacora;
		$res = mysql_query($sql);
		return mysql_result($res,0);
}

/*Trae todos los capítulos, segun el nivel*/
function getCapituloByNivel($idNivel){
	$sql = "SELECT * 
		FROM seccionBitacora
		WHERE idNivelCursoSeccionBitacora = ".$idNivel." AND estadoSeccionBitacora = 1";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[] = array(
			"idSeccionBitacora" => $row["idSeccionBitacora"],
			"nombreSeccionBitacora" => $row["nombreSeccionBitacora"]
		);	
	}
	return $arreglo;
}

function getNombreCapitulo($idSeccionBitacora){
	$sql ="SELECT nombreSeccionBitacora FROM seccionBitacora WHERE idSeccionBitacora =".$idSeccionBitacora;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}
?>