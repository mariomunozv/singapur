<?php 
function desinscribirUsuarioCursoCapacitacion( $idUsuario, $idCursoCapacitacion ){
	$sql="DELETE FROM `inscripcionCursoCapacitacion` WHERE  `idUsuario` = '$idUsuario' AND `idCursoCapacitacion` = '$idCursoCapacitacion'";
	$res = mysql_query($sql);
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha desinscrito a ".getNombreUsuario($idUsuario)." en el curso :".$idCursoCapacitacion;
	}
}


function inscribirUsuarioCursoCapacitacion( $idPerfil, $idProyectoKlein, $idUsuario, $idCursoCapacitacion ){
	$sql_ = "INSERT INTO `inscripcionCursoCapacitacion` ( `idPerfil` , `idProyectoKlein` , `idUsuario` , `idCursoCapacitacion` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idPerfil','$idProyectoKlein', '$idUsuario' , '$idCursoCapacitacion' ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	//echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha inscrito a ".getNombreUsuario($idUsuario)." en el curso :".$idCursoCapacitacion;
	}
}

function getAlumnosCurso($idCursoCapacitacion){
$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a join usuario b on a.idUsuario = b.idUsuario left join profesor c on b.rutProfesor = c.rutProfesor  WHERE a.idCursoCapacitacion= ".$idCursoCapacitacion;
$sql .= " AND a.idUsuario <> 1";
//echo $sql;
$res = mysql_query($sql);
$i=0;
	while($row = mysql_fetch_array($res)){
			
			if ($row["idPerfil"] == 1){
				$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosProfe["apellidoPaterno"];
				$rbdColegio = $row["rbdColegio"];
				$rut = $row["rutProfesor"];
				
				
			}
			if ($row["idPerfil"] >= 3){ //3: UTP; 4: UTP y Profesor
				$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosProfe["apellidoPaterno"];
				$rbdColegio = $row["rbdColegio"];
				$rut = $row["rutProfesor"];
			}
			
			if ($row["idPerfil"] >= 5 ){ // 5: Tutor , 7: Coordinador de nivel 	, 9: Coordinador general , 20: Administrador Sitio 
				$datosEmpleadoKlein = getNombreFotoUsuarioEmpleadoKlein($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosEmpleadoKlein["apellidoPaterno"];
				$rbdColegio ="";
				$rut = "";
			}
			
			$alumnosCurso[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idPerfil"=> $row["idPerfil"],
			"apellidoPaterno"=> $apellidoPaterno,
			"rbdColegio"=> $rbdColegio,
			"nombreCompleto" => $nombreCompleto	,
			"rutProfesor" => $rut	,
			);
			
			
			
			$i++;	
	}
	if ($i == 0){
		$alumnosCurso[$i] = array();	
	} 
	return($alumnosCurso);
}

function getAlumnosCursoParaBitacora($idCursoCapacitacion){
$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a join usuario b on a.idUsuario = b.idUsuario left join profesor c on b.rutProfesor = c.rutProfesor  WHERE a.idCursoCapacitacion= ".$idCursoCapacitacion;
$sql .= " AND a.idUsuario <> 1";
$sql .= " AND a.idPerfil < 5";
//echo $sql;
$res = mysql_query($sql);
$i=0;
	while($row = mysql_fetch_array($res)){
			
			if ($row["idPerfil"] == 1){
				$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosProfe["apellidoPaterno"];
				$rbdColegio = $row["rbdColegio"];
				$rut = $row["rutProfesor"];
				
				
			}
			if ($row["idPerfil"] >= 3){ //3: UTP; 4: UTP y Profesor
				$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosProfe["apellidoPaterno"];
				$rbdColegio = $row["rbdColegio"];
				$rut = $row["rutProfesor"];
			}
			/*
			if ($row["idPerfil"] >= 5 ){ // 5: Tutor , 7: Coordinador de nivel 	, 9: Coordinador general , 20: Administrador Sitio 
				$datosEmpleadoKlein = getNombreFotoUsuarioEmpleadoKlein($row["idUsuario"]);
				$nombreCompleto = getApellidosNombre($row["idUsuario"]);
				$apellidoPaterno = $datosEmpleadoKlein["apellidoPaterno"];
				$rbdColegio ="";
				$rut = "";
			}
			*/
			
			$alumnosCurso[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idPerfil"=> $row["idPerfil"],
			"apellidoPaterno"=> $apellidoPaterno,
			"rbdColegio"=> $rbdColegio,
			"nombreCompleto" => $nombreCompleto	,
			"rutProfesor" => $rut	,
			);
			
			
			
			$i++;	
	}
	if ($i == 0){
		$alumnosCurso[$i] = array();	
	} 
	return($alumnosCurso);
	
}


/*
function getAlumnosCurso($idCursoCapacitacion){
$sql = "SELECT * FROM `inscripcionCursoCapacitacion` WHERE idCursoCapacitacion= ".$idCursoCapacitacion ;
//echo $sql;
$res = mysql_query($sql);
$i=0;
	while($row = mysql_fetch_array($res)){
			$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
			$alumnosCurso[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idPerfil"=> $row["idPerfil"],
			"apellidoPaterno"=> $datosProfe["apellidoPaternoProfesor"],
			"nombreCompleto" => getApellidosNombre($row["idUsuario"])
			);
			$i++;	
	}
	if ($i == 0){
		$alumnosCurso[$i] = array();	
	} 
		
	return($alumnosCurso);
	
}*/

function getUsuariosCurso($idCurso){
	$sql =" SELECT * FROM inscripcionCursoCapacitacion where idCursoCapacitacion = ".$idCurso;
	//echo $sql;
	$res = mysql_query($sql);
	return($res);
}


function getCursoUs($idUsuario){
	$sql ="SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where b.estadoCursoCapacitacion > 0 AND idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$cursoUsuario = $row["idCursoCapacitacion"];
	return($cursoUsuario);
}


/*function getCursosUsuario($idUsuario){
	$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	return($res);
} */


function getCursosUsuario($idUsuario){
	$sql = "SELECT * 
		FROM `inscripcionCursoCapacitacion` a 
		join cursoCapacitacion b 
		on a.idCursoCapacitacion = b.idCursoCapacitacion 
		where idUsuario = ".$idUsuario." 
		AND estadoCursoCapacitacion = 1 
		ORDER BY(nombreCortoCursoCapacitacion)";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$datosCursosUsuario[$i] = array(
			"idCursoCapacitacion"=> $row["idCursoCapacitacion"],
			"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
			"nombreCursoCapacitacion" => $row["nombreCursoCapacitacion"]
			);
		$i++;
	}
	if ($i == 0){
		$datosCursosUsuario[$i] = array();	
	} 
	return($datosCursosUsuario);
}

function getCurso($idUsuario){
	$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	if (mysql_num_rows($res)>0){
		$row = mysql_fetch_array($res);
		return ($row["idCursoCapacitacion"]);
	}
	else{
		return 0;
	}
}

function getNivelUsuario($idUsuario){
	$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b 
	on a.idCursoCapacitacion = b.idCursoCapacitacion 
	where idUsuario = ".$idUsuario."
	AND a.idCursoCapacitacion > 34";
	//echo $sql;
	$res = mysql_query($sql);
	if (mysql_num_rows($res)>0){
		$row = mysql_fetch_array($res);
		return ($row["nombreCortoCursoCapacitacion"]);
	}
	else{
		return 0;
	}
}


?>