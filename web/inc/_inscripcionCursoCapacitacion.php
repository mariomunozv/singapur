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

function getNomPerfil($idPerfil){
	$sql = " SELECT * FROM `perfil` WHERE idPerfil = ".$idPerfil;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombrePerfil"];
}


function getAlumnosCurso($idCursoCapacitacion){
$sql = "SELECT b.rutProfesor, b.idUsuario, c.rbdColegio ,b.rutEmpleadoKlein, a.idPerfil, b.tipoUsuario, c.implementaProfesor, b.estadoUsuario
        FROM inscripcionCursoCapacitacion a join usuario b on a.idUsuario = b.idUsuario 
             left join profesor c on b.rutProfesor = c.rutProfesor
             left join empleadoKlein d on b.rutEmpleadoKlein = d.rutEmpleadoKlein
        WHERE b.estadoUsuario = 1 AND a.idCursoCapacitacion= ".$idCursoCapacitacion;

//seccion de consulta para que en el listado de participantes se considere a administrativos y coordinadores generales
$sql2 ="SELECT b.rutProfesor,b.idUsuario, c.rbdColegio,b.rutEmpleadoKlein, e.idPerfil, b.tipoUsuario , c.implementaProfesor, b.estadoUsuario
		FROM usuario b join empleadoKlein d on b.rutEmpleadoKlein = d.rutEmpleadoKlein
			 left join profesor c on b.rutProfesor = c.rutProfesor 
    		 left join detalleUsuarioProyectoPerfil e on b.idUsuario = e.idUsuario 
		WHERE b.tipoUsuario = 'Coordinador General' AND b.estadoUsuario = 1 ";
			/*OR (b.tipoUsuario = 'Empleado Klein' 
				AND EXISTS (SELECT tipoCursoCapacitacion 
							FROM cursoCapacitacion 
							WHERE idCursoCapacitacion = 53 AND tipoCursoCapacitacion = 'curso'))";*/
//se agregan los directivos correspondientes.
$sql3 = "SELECT b.rutProfesor,b.idUsuario, c.rbdColegio,b.rutEmpleadoKlein, e.idPerfil, b.tipoUsuario , c.implementaProfesor, b.estadoUsuario
		 FROM usuario b join profesor c on b.rutProfesor = c.rutProfesor 
   	 		  left join detalleUsuarioProyectoPerfil e on b.idUsuario = e.idUsuario 
		 WHERE b.idUsuario in
    						(SELECT a.idUsuario
    						 FROM usuarioColegio a join cursocapacitacioncolegio b on a.rbdColegio = b.rbdColegio
    						 WHERE b.idCursoCapacitacion = ".$idCursoCapacitacion.")";
$sql = "(".$sql.") UNION (".$sql2.") UNION (".$sql3.")";
//echo $sql;
$res = mysql_query($sql);
$i=0;
	while($row = mysql_fetch_array($res)){
			
			if ($row["rutProfesor"]!=""){
				$datosProfe = getNombreFotoUsuarioProfesor($row["idUsuario"]);
				$nombreCompleto = $datosProfe["nombreCompleto"];
				$apellidoPaterno = $datosProfe["apellidoPaterno"];
				$rbdColegio = $row["rbdColegio"];
				$rut = $row["rutProfesor"];
				$implementa = ($row["implementaProfesor"] == 1) ? "Si":"No";
			}
			if ($row["rutEmpleadoKlein"]!=""){
				$datosEmpleadoKlein = getNombreFotoUsuarioEmpleadoKlein($row["idUsuario"]);
				$nombreCompleto = $datosEmpleadoKlein["nombreCompleto"];
				$apellidoPaterno = $datosEmpleadoKlein["apellidoPaterno"];
				$rbdColegio ="";
				$rut = "";
				$implementa = "";
			}
			
			$alumnosCurso[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idPerfil"=> $row["idPerfil"],
			"apellidoPaterno"=> $apellidoPaterno,
			"rbdColegio"=> $rbdColegio,
			"nombreCompleto" => $nombreCompleto	,
			"rutProfesor" => $rut	,
			"nombrePerfil" => getNomPerfil($row['idPerfil']),
			"implementaProfesor" => $implementa,
			"estado" => $row["estadoUsuario"],
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
//$sql .= " AND a.idUsuario <> 1";
$sql .= " AND b.rutProfesor <> ''";
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
	$sql_user = "SELECT * FROM usuario WHERE idUsuario=".$idUsuario;
	$res_user = mysql_query($sql_user);
	$tipoUsuario = mysql_fetch_array($res_user["tipoUsuario"]); //  modificado 22.07
	if($tipoUsuario=="Directivo"){
		$sql = "SELECT idCursoCapacitacion 
				FROM cursoCapacitacion 
				where estadoCursoCapacitacion = 1
				AND tipoCursoCapacitacion = 'directivos'
				AND idCursoCapacitacion in (SELECT idCursoCapacitacion 
					                        FROM cursocapacitacioncolegio a JOIN usuariocolegio b
					                        ON a.rbdColegio = b.rbdColegio
					                        WHERE b.idUsuario = ".$idUsuario."  )
				ORDER BY(nombreCortoCursoCapacitacion)";
	}else{
		if($tipoUsuario=="Empleado Klein" || $tipoUsuario=="Coordinador General"){
			$sql = "SELECT idCursoCapacitacion 
					FROM cursoCapacitacion
					where estadoCursoCapacitacion = 1
					ORDER BY(nombreCortoCursoCapacitacion)";
		}else{
			$sql ="SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where b.estadoCursoCapacitacion > 0 AND idUsuario = ".$idUsuario;
		}
	}
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
function alert($asd){
print_r( "<script language='javascript'>alert('".$asd."'');</script>");
}

function getCursosUsuario($idUsuario){
	$sql = "SELECT * FROM usuario WHERE idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$tipoUsuario = $row["tipoUsuario"];
	if($tipoUsuario =="Coordinador General"){
		$sql = "SELECT * 
				FROM cursoCapacitacion
				where estadoCursoCapacitacion = 1
				ORDER BY(nombreCortoCursoCapacitacion)";
	}
	elseif ($tipoUsuario=="Empleado Klein") {
		$sql = "SELECT * 
				FROM cursoCapacitacion
				where estadoCursoCapacitacion = 1 AND tipoCursoCapacitacion = 'curso'
				ORDER BY(nombreCortoCursoCapacitacion)";
	}
	else{
		if($tipoUsuario == "Directivo"){
			//$sql = todos los cursos directivos registrados para los colegios asociados al usuario.
			$sql = "SELECT * 
				FROM cursoCapacitacion 
				where estadoCursoCapacitacion = 1
				AND tipoCursoCapacitacion = 'directivos'
				AND idCursoCapacitacion in (SELECT idCursoCapacitacion 
					                        FROM cursocapacitacioncolegio a JOIN usuarioColegio b
					                        ON a.rbdColegio = b.rbdColegio
					                        WHERE b.idUsuario = ".$idUsuario."  )
				ORDER BY(nombreCortoCursoCapacitacion)";

		}else{
			$sql = "SELECT * 
				FROM inscripcionCursoCapacitacion a	join cursoCapacitacion b 
				on a.idCursoCapacitacion = b.idCursoCapacitacion 
				where a.idUsuario = ".$idUsuario." 
				AND b.estadoCursoCapacitacion = 1
				ORDER BY(nombreCortoCursoCapacitacion)";
		}	
	}
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$datosCursosUsuario[$i] = array(
			"tipoCursoCapacitacion"=> $row["tipoCursoCapacitacion"],
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