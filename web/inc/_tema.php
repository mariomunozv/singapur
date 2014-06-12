<?php 

function getTema($idTema){
	$sql = "SELECT * FROM tema WHERE idTema = ".$idTema;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
   	return ($row);
}	

function getFechaTerminoTema($idTema){
	$sql = "SELECT fechaTerminoTema FROM tema WHERE idTema = ".$idTema;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
   	return ($row[0]);
}


function cuentaTemasCategoria($idCategoria,$idCurso){
	$sql = "SELECT COUNT(*) as cuenta FROM tema WHERE idTemaCategoria = ".$idCategoria." AND estadoTema = 1 and idCursoCapacitacion= ".$idCurso;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
   	return ($row["cuenta"]);
}	



function getTemaCurso($idCategoria,$idCurso){
	$sql = "SELECT * FROM tema WHERE idTemaCategoria =".$idCategoria." and estadoTema = 1 and idCursoCapacitacion= ".$idCurso." ORDER BY fechaTema DESC";
	$res = mysql_query($sql);
	//echo $sql;
	while($row = mysql_fetch_array($res)){
		$tema[] = array (
			"idTema" => $row["idTema"],
			"idTemaCategoria" => $row["idTemaCategoria"],
			"idUsuario" => $row["idUsuario"],
			"idCursoCapacitacion" => $row["idCursoCapacitacion"],
			"idProyectoKlein" => $row["idProyectoKlein"],
			"tituloTema" => $row["tituloTema"],
			"mensajeInicialTema" => $row["mensajeInicialTema"],
			"fechaTema" => $row["fechaTema"],
			"fechaInicioTema" => $row["fechaInicioTema"],
			"fechaTerminoTema" => $row["fechaTerminoTema"],
			"estadoTema" => $row["estadoTema"]
			);
	}
   	return ($tema);
}

function getNombreCategoria($idCategoria){
	$sql = "SELECT * FROM temaCategoria WHERE idTemaCategoria =".$idCategoria;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return ($row["nombreTemaCategoria"]);
	
	}

function getCategoriaCurso($idCurso){
	$sql = "SELECT * FROM temaCategoria WHERE idCursoCapacitacion =".$idCurso;
	$res = mysql_query($sql);
   	return ($res);
}

function guardarTema($idCurso, $idUsuario, $idProyecto, $idCategoria, $tituloTema,$mensajeInicialTema,$estadoTema){
	$sql_ = "INSERT INTO tema ( idCursoCapacitacion , idUsuario , idProyectoKlein , idTemaCategoria , tituloTema , mensajeInicialTema , fechaTema , fechaInicioTema , fechaTerminoTema , estadoTema ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idCurso', '$idUsuario', '$idProyecto', '$idCategoria', '$tituloTema','$mensajeInicialTema',NOW(),NOW(),NOW(),'$estadoTema' ";
    $sql_.=")";
	$res = mysql_query($sql_);
	//echo $sql;
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}
	return($res);
}

function getDatosCategoria($idCategoria){
	$sql = "SELECT * FROM temaCategoria WHERE idTemaCategoria =".$idCategoria." and estadoTemaCategoria = 1 ";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	//echo $sql."<br/><br/>";
	$datos = array('idTemaCategoria' => $row['idTemaCategoria'],
		'idCursoCapacitacion' => $row['idCursoCapacitacion'],
		'tem_idTemaCategoria' => $row['tem_idTemaCategoria'],
		'nombreTemaCategoria' => $row['nombreTemaCategoria'],
		'descripcionTemaCategoria' => $row['descripcionTemaCategoria'],
		'estadoTemaCategoria' => $row['estadoTemaCategoria']);
	return ($datos);
}






?>