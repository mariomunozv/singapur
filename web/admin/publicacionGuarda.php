<?php 
session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";
include "../inc/_detalleActividadCursoCapacitacion.php";
Conectarse_seg(); 


$idTipoRecurso = $_REQUEST["idTipoRecurso"];
$nombreRecurso = $_REQUEST["nombreRecurso"];
$urlRecurso = $_REQUEST["urlRecurso"];
$idCursoCapacitacion = $_REQUEST["idCursoCapacitacion"];
$jornadas = $_REQUEST["idJornada"];
$idPerfil = $_REQUEST["idPerfil"];


/*$ = $_REQUEST[""];
$ = $_REQUEST[""];*/


$idRecurso = setRecurso($idTipoRecurso, $nombreRecurso, $urlRecurso, '');

if ($idRecurso){
	foreach ($jornadas as $idJornada){
		setPublicacion($idRecurso, $idJornada, $idPerfil, 'NULL');	
	}
	
}

if ($idTipoRecurso == 6){
	// Agregar a detalleActividadCursoCapacitacion
	asignaActividadCurso( $idCursoCapacitacion, $urlRecurso);
}


dirigirse_a("publicacion.php");


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


function setPublicacion($idRecurso,	$idJornada,	$idPerfil, $ordenPublicacion){
	$sql = "INSERT INTO publicacion (
			idRecurso,
			idJornada,
			idPerfil,
			ordenPublicacion,
			estadoPublicacion
			) VALUES (
			$idRecurso,
			$idJornada,
			$idPerfil,
			$ordenPublicacion,
			1
			)";
	$res = mysql_query($sql);
	if (!$res) {
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}else{
		info('Publicacion realizada satisfactoriamente.');
		$idPublicacion = mysql_insert_id();
		return ($idPublicacion);
	}
	
}

?>