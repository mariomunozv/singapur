<?php 

function getNombreCortoCurso($idCurso){
	$sql = "SELECT nombreCortoCursoCapacitacion FROM `cursoCapacitacion` WHERE idCursoCapacitacion =".$idCurso;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreCortoCursoCapacitacion"]);
}	

function getCursosCapacitacion(){
	$sql = "SELECT *  FROM cursoCapacitacion WHERE estadoCursoCapacitacion = 1"; 
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$cursos[$i] = array( "idCursoCapacitacion" => $row["idCursoCapacitacion"],"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"]
							);	
		$i++;
	}
	return($cursos);
}


function getDatosCurso($idCurso){
	$sql = "SELECT * FROM `cursoCapacitacion` WHERE idCursoCapacitacion =".$idCurso;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosCurso = array(
		"idCursoCapacitacion"=> $row["idCursoCapacitacion"],
		"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
		"nombreCursoCapacitacion" => $row["nombreCursoCapacitacion"],
		"descripcionCursoCapacitacion" => $row["descripcionCursoCapacitacion"]
		);
	return($datosCurso);
}	

function actualizaBienvenidaCurso($idCursoCapacitacion, $descripcionCursoCapacitacion){
	$sql = "UPDATE cursoCapacitacion SET descripcionCursoCapacitacion = '$descripcionCursoCapacitacion' WHERE idCursoCapacitacion = $idCursoCapacitacion";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
	return $res;
}
?>