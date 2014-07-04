<?php

$anoActual = '2013';

function getNombreSeccionBitacora($idSeccion){
	$sql ="SELECT * FROM seccionBitacora where idSeccionBitacora = ".$idSeccion;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreSeccionBitacora"]);
}

function getNombreCapituloBitacora($idSeccion){
	$sql ="SELECT *	FROM `seccionBitacora` WHERE `idSeccionBitacora` IN (
		SELECT `idPadreSeccionBitacora`
		FROM `seccionBitacora`
		WHERE `idSeccionBitacora` = ".$idSeccion.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreSeccionBitacora"]);
}

function getNombreCapituloCompletoBitacora($capCompletos){
	$sql = "SELECT * FROM `seccionBitacora` WHERE `idSeccionBitacora` = ".$capCompletos;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreSeccionBitacora"]);
}

function getIdUltimaBitacora($idUsuario){
	$sql ="SELECT * FROM bitacora where idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idBitacora"]);
}


function insertaBitacoraProfe($idUsuarioIngresa,$profesor,$idCursoColegio,$idSeccionBitacora,$nombreSeccionBitacora,$fechaInicioBitacora,$fechaFinBitacora,$tiempoBitacora){
	if($tiempoBitacora==0){
		$fechaInicioBitacora = NULL;
		$fechaFinBitacora = NULL;		
	}
	$sql = "INSERT INTO `bitacora` ";
	$sql.= "( `idBitacora` , `idUsuario` , `idCursoColegio` ,`idJornada` , `idSeccionBitacora` , `nombreBitacora` , `fechaInicio`, `fechaTermino` , `tiempoBitacora` , `fechaCreacionBitacora` , `estadoBitacora`, `usuarioIngresa` )";
	$sql.= "VALUES ( ";
	$sql.= "'','$profesor','$idCursoColegio',NULL,'$idSeccionBitacora','$nombreSeccionBitacora','$fechaInicioBitacora','$fechaFinBitacora','$tiempoBitacora',NOW(),'1','$idUsuarioIngresa'";
	$sql.= ");";
	//echo $sql;
	$result = mysql_query($sql);
	if (!$result) {
		// No se ejecuto correctamente el sql
		return $ultimo_id;
	}else{
		$ultimo_id = mysql_insert_id();
		//echo $ultimo_id."<------------------";
		return $ultimo_id;
	}
}

function insertarDetalleBitacoraNivel($idBitacora,$idNivel){
	$sql = "INSERT INTO detalleBitacoraNivel";
	$sql.= "(idBitacora,idNivel)";
	$sql.= "VALUES(";
	$sql.= "$idBitacora,$idNivel";
	$sql.= ");";
	$result = mysql_query($sql);
	//echo "<br>SSSS".$sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
		return false;
	}else{
		return true;
	}
}

function getBitacorasUsuario($idUsuario){
	global $anoActual;
	$sql = "SELECT * FROM bitacora WHERE idUsuario = ".$idUsuario." AND YEAR(fechaCreacionBitacora) = ".$anoActual;  //YEAR(NOW())
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("idBitacora" => $row["idBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idCursoColegio" => $row["idCursoColegio"],
					"nombreBitacora"=> $row["nombreBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"usuarioIngresa" => $row["usuarioIngresa"],
					"estadoBitacora" => $row["estadoBitacora"]
					);
	}
	return($bitacora);
}


function getBitacorasUsuarioCurso($idUsuario,$idCurso){
	global $anoActual;
	$sql = "SELECT * FROM bitacora WHERE idUsuario = ".$idUsuario." AND YEAR(fechaCreacionBitacora) = ".$anoActual." AND idCursoColegio =".$idCurso; //YEAR(NOW())
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("idBitacora" => $row["idBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idCursoColegio" => $row["idCursoColegio"],
					"nombreBitacora"=> $row["nombreBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"usuarioIngresa" => $row["usuarioIngresa"],
					"estadoBitacora" => $row["estadoBitacora"]
					);
	}
	return($bitacora);
}


function getBitacorasCompletadasUsuarioCapitulo($idUsuario,$idCapitulo,$idCurso){
	$sql = "SELECT b.*";
	$sql .= " FROM bitacora b, seccionBitacora s";
	$sql .= " WHERE b.idUsuario =".$idUsuario;
	$sql .= " AND s.idPadreSeccionBitacora = ".$idCapitulo;
	$sql .= " AND s.idSeccionBitacora = b.idSeccionBitacora";
	$sql .= " AND b.idCursoColegio = '".$idCurso."'";
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("idBitacora" => $row["idBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idCursoColegio" => $row["idCursoColegio"],
					"nombreBitacora"=> $row["nombreBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"usuarioIngresa" => $row["usuarioIngresa"],
					"estadoBitacora" => $row["estadoBitacora"]
					);
	}
	return($bitacora);
}

/*Funcón que trae todas las bitácoras completadas por un usuario*/
function getBitacorasCompletadasUsuario($idUsuario,$curso){
	$sql = "SELECT *";
	$sql .= " FROM bitacora b, seccionBitacora s";
	$sql .= " WHERE b.idUsuario =".$idUsuario;
	$sql .= " AND s.idSeccionBitacora = b.idSeccionBitacora";
	$sql .= " AND b.idCursoColegio = '".$curso."'";
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("idBitacora" => $row["idBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idCursoColegio" => $row["idCursoColegio"],
					"nombreBitacora"=> $row["nombreBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"usuarioIngresa" => $row["usuarioIngresa"],
					"estadoBitacora" => $row["estadoBitacora"]
					);
	}
	return($bitacora);
}

/*Función que trae los usuario que rellenaron un capítulo en la bitacora de un profesor*/
function getUsuariosIngresanCapitulo($idCapitulo,$idCurso,$idUsuario){
	$sql = "SELECT Distinct CONCAT(p.nombreProfesor,' ',p.apellidoPaternoProfesor,' ', p.apellidoMaternoProfesor) as nombreProfesor
			FROM bitacora b, usuario u, profesor p
			WHERE b.idSeccionBitacora in 
				(SELECT s.idSeccionBitacora 
				FROM seccionBitacora s
				WHERE s.idPadreSeccionBitacora = ".$idCapitulo.")
			AND b.usuarioIngresa = u.idUsuario
			AND b.idUsuario =".$idUsuario."
			AND u.rutProfesor = p.rutProfesor
			AND b.idCursoColegio = '".$idCurso."'";
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("nombreProfesor" => $row["nombreProfesor"],
					);
	}
	return($bitacora);
}


/* Función que trae la suma de las horas implementadas en las secciones de un capítulo
con el fin de saber cuantas horas se destinaron a dicho capítulo de acuerdo a lo declaró
el profesor cuando llenó la bitacora*/
function getHorasImplementadas($capCompletos, $idUsuario,$idCurso){
	$sql = "SELECT SUM(tiempoBitacora) as tiempoCapitulo
			FROM bitacora b
			WHERE b.idSeccionBitacora in 
			(SELECT s.idSeccionBitacora 
			FROM seccionBitacora s
			WHERE s.idPadreSeccionBitacora = ".$capCompletos.")
			AND b.idUsuario = ".$idUsuario."
			AND b.idCursoColegio = '".$idCurso."'";;
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora=array("tiempoCapitulo" => $row["tiempoCapitulo"],
					);
	}
	return($bitacora["tiempoCapitulo"]);
}

/*Función que trae todas las bitácoras de un cápitulo declarado por el profesor */
function getBitacorasCapitulo($capCompletos,$idUsuario,$idCurso){
	$sql = "SELECT b . *
		FROM bitacora b
		WHERE b.idSeccionBitacora
		IN (
		SELECT s.idSeccionBitacora
		FROM seccionBitacora s
		WHERE idPadreSeccionBitacora =".$capCompletos.")
			AND b.idUsuario = ".$idUsuario."
			AND b.idCursoColegio = '".$idCurso."'";;
	//echo $sql;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$bitacora[]=array("idBitacora" => $row["idBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idCursoColegio" => $row["idCursoColegio"],
					"nombreBitacora"=> $row["nombreBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"usuarioIngresa" => $row["usuarioIngresa"],
					"estadoBitacora" => $row["estadoBitacora"]
					);
	}
	return($bitacora);
}

function getFechasCapitulo($capCompletos,$idUsuario,$idCurso){
	$sql = "SELECT MIN(b.fechaInicio) as fechaInicio, MAX(b.fechaTermino) as fechaTermino
			FROM bitacora b 
			WHERE b.idSeccionBitacora IN ( 
				SELECT s.idSeccionBitacora 
				FROM seccionBitacora s 
				WHERE idPadreSeccionBitacora =".$capCompletos.") 
			AND b.idUsuario =".$idUsuario."
			AND b.idCursoColegio = '".$idCurso."'";;
	//echo $sql;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$fechas=array("fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"]
					);
	}
	return($fechas);
}

function cuentaBitacoras( $idUsuario){
	global $anoActual;
	$sql= "SELECT COUNT(*) AS cont
			FROM bitacora
			WHERE idUsuario = $idUsuario
			AND YEAR(fechaCreacionBitacora) = ".$anoActual; //YEAR(NOW())
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}


function getBitacoraUsuarioCurso($idUsuario,$idCursoColegio){
	$sql = "SELECT * FROM bitacora a join seccionBitacora c on a.idSeccionBitacora = c.idSeccionBitacora WHERE idUsuario = ".$idUsuario;
	$sql .= " AND idCursoColegio = '".$idCursoColegio."'";
	//echo $sql."<BR>";
	$res = mysql_query($sql);
   	$i = 0;
	while($row = mysql_fetch_array($res)){		
	$bitacora[$i]=array("nombreSeccionBitacora"=> $row["nombreSeccionBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"idPadreSeccionBitacora" => $row["idPadreSeccionBitacora"],
					"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"],
					"idUsuario" => $row["idUsuario"]
				);
		$i++;
	}
	if($i==0){
		$bitacora = array();
	}
	return($bitacora);
}

function getBitacorasParaExportar(){
	global $anoActual;
	$sql = "SELECT * FROM bitacora b, seccionBitacora s WHERE b.idSeccionBitacora = s.idSeccionBitacora AND YEAR(fechaCreacionBitacora) = ".$anoActual; //YEAR(NOW())
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){		
	$bitacora[$i]=array("nombreSeccionBitacora"=> $row["nombreSeccionBitacora"],
					"fechaInicio" => $row["fechaInicio"],
					"fechaTermino" => $row["fechaTermino"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"idCursoColegio" => $row["idCursoColegio"],
					"idPadreSeccionBitacora" => $row["idPadreSeccionBitacora"],
					"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"],
					"idUsuario" => $row["idUsuario"],
					"idBitacora" => $row["idBitacora"]
				);
		$i++;
	}
	if($i==0){
		$bitacora = array();
	}
	return($bitacora);
}

?>