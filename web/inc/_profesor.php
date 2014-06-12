<?php 

function getDatosProfesor2($idUsuario){
		$sql = "SELECT profesor.rutProfesor,profesor.nombreProfesor,profesor.apellidoPaternoProfesor,colegio.nombreColegio,usuario.imagenUsuario,profesor.implementaProfesor FROM profesor profesor join usuario usuario on usuario.rutProfesor = profesor.rutProfesor join colegio colegio on colegio.rbdColegio = profesor.rbdColegio WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		if($row["implementaProfesor"] == "NO"){
			$marca = "*";
			}else{
			$marca = "";	
			}
		$datosProfesor = array(
			"rut" => $row["rutProfesor"],
			"implementaProfesor" => $row["implementaProfesor"],
			"nombreColegio" => $row["nombreColegio"],
			"nombre" => $row["nombreProfesor"],
			"apellidoPaterno" => $row["apellidoPaternoProfesor"],
			"imagenUsuario" => $row["imagenUsuario"],
			"nombreParaMostrar" => "<div title='".$row["nombreColegio"]."'> ".$marca.$row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]."</div>"
			
		);
		return ($datosProfesor);
}	

function getProfesoresColegio($rbdColegio){
	$sql = "SELECT u.idUsuario, p.*";
	$sql .= " FROM profesor p, usuario u, cursoCapacitacion c, inscripcionCursoCapacitacion i";
	$sql .= " WHERE rbdColegio = ".$rbdColegio;
	$sql .= " AND i.idCursoCapacitacion = c.idCursoCapacitacion";
	$sql .= " AND c.estadoCursoCapacitacion = 1";
	$sql .= " AND i.idUsuario = u.idUsuario";
	$sql .= " AND p.rutProfesor = u.rutProfesor";
	$sql .= " AND c.idCursoCapacitacion > 17";
	$sql .= " AND c.idCursoCapacitacion <> 28";
	$sql .= " AND c.idCursoCapacitacion < 35"; //Toma solo los profesores que no participan en los niveles del año 2013
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$profesores[$i] = array( "idUsuario" => $row["idUsuario"],
				      "nombreProfesor" => $row["nombreProfesor"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					  "sexoProfesor" => $row["sexoProfesor"],
					  "fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
					  "telefonoProfesor" => $row["telefonoProfesor"],
					   "emailProfesor" => $row["emailProfesor"],
					   "anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
					   "asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
					   "coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
					   "rutProfesor" => $row["rutProfesor"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($profesores);
	
	}	
	
function getNombreProfesorPorRut($rutProfe){
	$sql = "SELECT * FROM `profesor` where rutProfesor = '".$rutProfe."'";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];

}

function getNombreProfesor($rutProfesor){
	$sql = "SELECT * FROM profesor WHERE rutProfesor ="." '$rutProfesor'";
	$res = mysql_query($sql);
    $row = mysql_fetch_array($res);
	$nombreProfesor = $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];
	return ($nombreProfesor);
}


function getApellidosNombrePorRutProfe($rutProfe){
	$sql = "SELECT * FROM `profesor` where rutProfesor = '".$rutProfe."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"]." ".$row["nombreProfesor"];

}


/*function getDatosProfesor($idUsuario){
		$sql = "SELECT * FROM profesor profesor join usuario usuario on usuario.rutProfesor = profesor.rutProfesor WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$datosProfesor = array(
			"rut" => $row["rutProfesor"],
			"loginUsuario" => $row["loginUsuario"],
			"passwordUsuario" => $row["passwordUsuario"],
			"nombre" => $row["nombreProfesor"],
			"apellidoPaterno" => $row["apellidoPaternoProfesor"],
			"apellidoMaterno" => $row["apellidoMaternoProfesor"],
			"sexo" => $row["sexoProfesor"],
			"fechaNacimiento" => $row["fechaNacimientoProfesor"],
			"telefono" => $row["telefonoProfesor"],
			"email" => $row["emailProfesor"],
			"anosExperiencia" => $row["anosExperienciaProfesor"],
			"asignaturaACargo" => $row["asignaturaACargoProfesor"],
			"coordinadorEnlace" => $row["coordinadorEnlaceProfesor"],
			"imagenUsuario" => $row["imagenUsuario"],
			"acercaDeUsuario" => $row["acercaDeUsuario"],
			"interesesUsuario" => $row["interesesUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]
		);
		return ($datosProfesor);
}	*/


function getDatosProfesor($idUsuario){
		$sql = "SELECT * FROM profesor profesor join usuario usuario on usuario.rutProfesor = profesor.rutProfesor WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		$datosProfesor = array(
			"rutProfesor" => $row["rutProfesor"],
			"loginUsuario" => $row["loginUsuario"],
			"passwordUsuario" => $row["passwordUsuario"],
			"nombreProfesor" => $row["nombreProfesor"],
			"apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
			"apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
			"sexoProfesor" => $row["sexoProfesor"],
			"fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
			"telefonoProfesor" => $row["telefonoProfesor"],
			"emailProfesor" => $row["emailProfesor"],
			"anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
			"anosExperienciaEnColegio" => $row["anosExperienciaEnColegio"],
			"asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
			"coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
			"implementaProfesor" => $row["implementaProfesor"],
			"cursoActual" => $row["cursoActual"],
			"especializacion" => $row["especializacion"],
			"experienciaSingapur" => $row["experienciaSingapur"],
			"nivelExperienciaSingapur" => $row["nivelExperienciaSingapur"],
			"imagenUsuario" => $row["imagenUsuario"],
			"acercaDeUsuario" => $row["acercaDeUsuario"],
			"interesesUsuario" => $row["interesesUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
			"nombreParaMostrar" => $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"],
			"cursoCapacitacion" => $row['cursoCapacitacion'],
			"cursosImplementa" => $row['cursosImplementa'],
			"tiempoCapacitando" => $row['tiempoCapacitando'],
			"cursosCapacitando" => $row['cursosCapacitando'],
			"otroSingapur" => $row['otroSingapur'],
		    "otraInsSingapur" => $row['otraInsSingapur'],
			"otroTipoCapacitacion" => $row['otroTipoCapacitacion'],
			"apoyoTecnico" => $row['apoyoTecnico'],
			"titulo" => $row['titulo'],
			"uEspecialiazcion" => $row["uEspecialiazcion"],
			"obtEspecializacion" => $row["obtEspecializacion"],
			"otroPerfeccionamiento" => $row["otroPerfeccionamiento"],
			"rbdColegio" => $row["rbdColegio"]
		);
		return ($datosProfesor);
}	


function actualizaDatosProfesor($rutProfesor,$nombreProfesor,$apellidoPaternoProfesor,
								$apellidoMaternoProfesor,$sexoProfesor,$fechaNacimientoProfesor,
								$telefonoProfesor,$emailProfesor,$anosExperienciaProfesor,
								$anosExperienciaColegioActual,$cursoActual,$especializacion,
								$asignaturaACargoProfesor,$experienciaSingapur,$nivelES,
								$coordinadorEnlaceProfesor ){
	$sql_udateProfe="UPDATE profesor SET nombreProfesor = '$nombreProfesor', 
		apellidoPaternoProfesor = '$apellidoPaternoProfesor', 
		apellidoMaternoProfesor = '$apellidoMaternoProfesor', 
		sexoProfesor = '$sexoProfesor', 
		fechaNacimientoProfesor = '$fechaNacimientoProfesor', 
		telefonoProfesor = '$telefonoProfesor', 
		emailProfesor = '$emailProfesor', 
		anosExperienciaProfesor = '$anosExperienciaProfesor', 
		anosExperienciaEnColegio = '$anosExperienciaColegioActual',
		cursoActual = '$cursoActual',
		especializacion   = '$especializacion',
		asignaturaACargoProfesor = '$asignaturaACargoProfesor',
		experienciaSingapur = '$experienciaSingapur',
		nivelExperienciaSingapur = '$nivelES', 
		coordinadorEnlaceProfesor = '$coordinadorEnlaceProfesor' 
		WHERE rutProfesor  =  '$rutProfesor';";
	//echo $sql_udateProfe;
	$result = mysql_query($sql_udateProfe);
	return $result;
}


function actualizaDatosProfesorCl($rutProfesor,$nombreProfesor,$apellidoPaternoProfesor,$apellidoMaternoProfesor,
								$sexoProfesor,$fechaNacimientoProfesor,$telefonoProfesor,$emailProfesor,
								$anosExperienciaProfesor,$anosExperienciaColegioActual,$cursoActual,$apoyoTecnico,
								$titulo,$especializacion,$obtEspecializacion,$uEspecializacion,$otroPerfeccionamiento,
								$asignaturaACargoProfesor,$experienciaSingapur,$nivelES,$cursoCapacitacion,
								$cursosImplementa,$tiempoCapacitando,$cursosCapacitando,$otroSingapur,$otraInsSingapur,
								$otroTipoCapacitacion,$coordinadorEnlaceProfesor ){
	$sql_udateProfe="UPDATE profesor SET nombreProfesor = '$nombreProfesor', 
		apellidoPaternoProfesor = '$apellidoPaternoProfesor', 
		apellidoMaternoProfesor = '$apellidoMaternoProfesor', 
		sexoProfesor = '$sexoProfesor', 
		fechaNacimientoProfesor = '$fechaNacimientoProfesor', 
		telefonoProfesor = '$telefonoProfesor', 
		emailProfesor = '$emailProfesor', 
		anosExperienciaProfesor = '$anosExperienciaProfesor', 
		anosExperienciaEnColegio = '$anosExperienciaColegioActual',
		cursoActual = '$cursoActual',
		apoyoTecnico = '$apoyoTecnico',
		titulo = '$titulo',
		especializacion   = '$especializacion',
		obtEspecializacion = '$obtEspecializacion',
		uEspecialiazcion = '$uEspecializacion',
		otroPerfeccionamiento = '$otroPerfeccionamiento',
		asignaturaACargoProfesor = '$asignaturaACargoProfesor',
		experienciaSingapur = '$experienciaSingapur',
		nivelExperienciaSingapur = '$nivelES', 
		cursoCapacitacion = '$cursoCapacitacion',
		cursosImplementa = '$cursosImplementa',
		tiempoCapacitando = '$tiempoCapacitando',
		cursosCapacitando = '$cursosCapacitando',
		otroSingapur = '$otroSingapur',
		otraInsSingapur = '$otraInsSingapur',
		otroTipoCapacitacion = '$otroTipoCapacitacion',
		coordinadorEnlaceProfesor = '$coordinadorEnlaceProfesor' 
		WHERE rutProfesor  =  '$rutProfesor';";
	//echo $sql_udateProfe;
	$result = mysql_query($sql_udateProfe);
	return $result;
}


/* Funcion que devuelve los profesores participante según su comuna */
function getProfesoresParticipante()
{
	$sql = "SELECT DISTINCT p.nombreProfesor, p.apellidoPaternoProfesor, p.apellidoMaternoProfesor, c.nombreColegio, u.idUsuario, i.idCursoCapacitacion";
	$sql .= " FROM profesor p, colegio c, usuario u, inscripcionCursoCapacitacion i, cursoCapacitacion cc";
	$sql .= " WHERE p.rbdColegio = c.rbdColegio";
	$sql .= " AND p.rutProfesor = u.rutProfesor";
	$sql .= " AND p.estadoProfesor > 0";
	$sql .= " AND u.estadoUsuario > 0";
	$sql .= " AND u.idUsuario = i.idUsuario";
	$sql .= " AND i.idCursoCapacitacion = cc.idCursoCapacitacion";
	$sql .= " AND cc.estadoCursoCapacitacion > 0";
	$sql .= " GROUP BY(p.rutProfesor)";
	$sql .= " ORDER BY(c.nombreColegio)";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$profesores[$i] = array( "nombreProfesor" => $row["nombreProfesor"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					  "nombreColegio" => $row["nombreColegio"],
  					  "idUsuario" => $row["idUsuario"],
					  "idCursoCapacitacion" => $row["idCursoCapacitacion"]
						);	
		$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($profesores);
}

/* Método que verifica si el profesor pertenece a los colegios Chilenos que participan en FONDEF 
@Param $idUsuario = "ID del usuario por el que se está consultando"
*/ 
function esClProfesor($idUsuario){
	$sql = " SELECT c.idComuna
	FROM colegio c, profesor p, usuario u
	WHERE c.rbdColegio = p.rbdColegio
	AND p.rutProfesor = u.rutProfesor
	AND u.idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if($row['idComuna']=="5751"){
		return false;
	}else{
		return true;
	}
}



?>