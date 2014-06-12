<?php 

function getNombreJornada($idJornada){
	$sql ="SELECT * FROM jornada WHERE idJornada = ".$idJornada;
	// echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreJornada"]);
}


function getNombreCurso($idCurso){
	$sql ="SELECT * FROM cursoCapacitacion WHERE idCursoCapacitacion = ".$idCurso;
	// echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreCursoCapacitacion"]);
}
			  
			  
   
function getJornadasCurso($idCurso){
	$sql ="SELECT * FROM jornada 
	WHERE idCursoCapacitacion = ".$idCurso." 
	AND visibleJornada = 1 
	AND muralJornada = 0 ORDER BY idJornada DESC";
	// echo "<br>".$sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$jornadasCurso[$i] = array(
		"idJornada"=> $row["idJornada"],
		"nombreJornada" => $row["nombreJornada"],
		"descripcionJornada"=> $row["descripcionJornada"],
		);
	$i++;	
	}
	if ($i == 0){
		$jornadasCurso[$i] = array();				
	} 
	return($jornadasCurso);
}


function getJornadasMural($idCurso){
	$sql ="SELECT * FROM jornada 
	WHERE idCursoCapacitacion = ".$idCurso." 
	AND visibleJornada = 1 
	AND muralJornada = 1 ORDER BY idJornada DESC";
	// echo "<br>".$sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$jornadasCurso[$i] = array(
		"idJornada"=> $row["idJornada"],
		"nombreJornada" => $row["nombreJornada"],
		"descripcionJornada"=> $row["descripcionJornada"],
		);
	$i++;	
	}
	if ($i == 0){
		$jornadasCurso[$i] = array();				
	} 
	return($jornadasCurso);
}

function getJornadasRecurso($idCurso){
	$sql ="SELECT * FROM jornada 
	WHERE idCursoCapacitacion = ".$idCurso." 
	AND visibleJornada = 1 
	AND muralJornada = 2 ORDER BY idJornada DESC";
	// echo "<br>".$sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$jornadasCurso[$i] = array(
		"idJornada"=> $row["idJornada"],
		"nombreJornada" => $row["nombreJornada"],
		"descripcionJornada"=> $row["descripcionJornada"],
		);
	$i++;	
	}
	if ($i == 0){
		$jornadasCurso[$i] = array();				
	} 
	return($jornadasCurso);
}

function setJornada($nombreJornada, $idTipoJornada,$idCursoCapacitacion, $descripcionJornada, $moduloJornada, $visibleJornada){
	
	$sql_insert = "INSERT INTO jornada (nombreJornada, idCursoCapacitacion, descripcionJornada, moduloJornada, visibleJornada,muralJornada) 
	VALUES ('$nombreJornada', $idCursoCapacitacion, '$descripcionJornada', '$moduloJornada', '$visibleJornada','$idTipoJornada')";
	
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
	$last_id = mysql_insert_id();
	return ($last_id);
}



function getJornadaByID($idJornada)
{
$sql = "SELECT j.*m, c.nombreCortoCursoCapacitacion";
$sql .= " FROM jornada j, cursoCapacitacion c";
$sql .= " WHERE j.idCursoCapacitacion = c.idCursoCapacitacion";
$sql .= " AND j.idJornada = $idJornada";
$sql .= " AND c.estadoCursoCapacitacion = 1";
$sql .= " ORDER BY(j.nombreJornada) DESC";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($res))
{
	$jornadas[$i] = array(
	"idJornada" => $row["idJornada"],
	"idCursoCapacitacion" => $row["idCursoCapacitacion"],
	"nombreJornada" => $row["nombreJornada"],
	"descripcionJornada" => $row["descripcionJornada"],
	"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
	"visibleJornada" => $row["visibleJornada"],
	"moduloJornada" => $row["moduloJornada"],
	"tipoJornada" => $row["muralJornada"]
	);
	$i++;
}
return ($jornadas[0]);
}
?>