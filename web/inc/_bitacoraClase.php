<?php 

function numNuevaClase($idJornada,$idUsuario){
	$sql = "SELECT COUNT(*) FROM bitacoraClase WHERE idJornada = '$idJornada' AND idUsuario = '$idUsuario'";
	$res = mysql_query($sql);
	$ret = mysql_result($res,0);
	return $ret+1;
}

function getClase($idClase){
		$sql = "SELECT * FROM bitacoraClase WHERE idBitacoraClase = ".$idClase;
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		$clase = array(
			"idBitacoraClase" => $row["idBitacoraClase"],
			"idJornada" => $row["idJornada"],
			"idUsuario" => $row["idUsuario"],
			"clase" => $row["nombreBitacoraClase"],
			"fechaClase" => $row["fechaBitacoraClase"],
			"minutos" => $row["minutosBitacoraClase"],
			"libroAlumnoDe" => $row["pgsDesdeLibroAlumnoBitacoraClase"],
			"libroAlumnoHasta" => $row["pgsHastaLibroAlumnoBitacoraClase"],
			"libroProfeDe" => $row["pgsDesdeCuadernoTrabajoBitacoraClase"],
			"libroProfeHasta" => $row["pgsHastaCuadernoTrabajoBitacoraClase"],
			"comentarios" => $row["comentariosBitacoraClase"]);
		return $clase;
}	


function getBitacoraJornadaUsuario($idJornada,$idUsuario){
	$sql ="SELECT * FROM bitacoraClase WHERE idJornada = ".$idJornada." AND idUsuario = ".$idUsuario." ORDER BY fechaCreacionBitacoraClase ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$datosBitacoraJornadaUsuario[$i] = array(
			"idBitacoraClase"=> $row["idBitacoraClase"],
			"nombreBitacoraClase"=> $row["nombreBitacoraClase"],
			"fechaBitacoraClase" => $row["fechaBitacoraClase"],
			"minutosBitacoraClase" => $row["minutosBitacoraClase"],
			"pgsDesdeLibroAlumnoBitacoraClase" => $row["pgsDesdeLibroAlumnoBitacoraClase"],
			"pgsHastaLibroAlumnoBitacoraClase" => $row["pgsHastaLibroAlumnoBitacoraClase"],
			"pgsDesdeCuadernoTrabajoBitacoraClase" => $row["pgsDesdeCuadernoTrabajoBitacoraClase"],
			"pgsHastaCuadernoTrabajoBitacoraClase" => $row["pgsHastaCuadernoTrabajoBitacoraClase"],
			"comentariosBitacoraClase" => $row["comentariosBitacoraClase"]);
			
			$i++;	
	}
	if ($i == 0){
		$datosBitacoraJornadaUsuario[$i] = array();	
	} 
	return($datosBitacoraJornadaUsuario);
}


function guardarClaseBitacora($idJornada,$idUsuario,$nombreBitacoraClase,$fechaBitacoraClase,$minutosBitacoraClase,
							  $pgsDesdeLibroAlumnoBitacoraClase,$pgsHastaLibroAlumnoBitacoraClase,
							  $pgsDesdeCuadernoTrabajoBitacoraClase,$pgsHastaCuadernoTrabajoBitacoraClase,
							  $comentariosBitacoraClase){

	$sql = "INSERT INTO `bitacoraClase` ( `idJornada` , `idUsuario` , `nombreBitacoraClase` , `fechaBitacoraClase` ,
										 `minutosBitacoraClase` , `pgsDesdeLibroAlumnoBitacoraClase` ,
										 `pgsHastaLibroAlumnoBitacoraClase` , `pgsDesdeCuadernoTrabajoBitacoraClase` ,
										 `pgsHastaCuadernoTrabajoBitacoraClase` , `comentariosBitacoraClase` ,
										 `fechaCreacionBitacoraClase` )VALUES ( '".$idJornada."', '".$idUsuario."', '".$nombreBitacoraClase."', '".$fechaBitacoraClase."', '".$minutosBitacoraClase."', '".$pgsDesdeLibroAlumnoBitacoraClase."', '".$pgsHastaLibroAlumnoBitacoraClase."', '".$pgsDesdeCuadernoTrabajoBitacoraClase."', '".$pgsHastaCuadernoTrabajoBitacoraClase."', '".$comentariosBitacoraClase."', NOW( ));";
	//echo $sql;
	$res = mysql_query($sql);
	return true;
}


function actualizarClaseBitacora($fechaClase,$minutosBitacoraClase,$pgsDesdeLibroAlumnoBitacoraClase,
								 $pgsHastaLibroAlumnoBitacoraClase, $pgsDesdeCuadernoTrabajoBitacoraClase,
								 $pgsHastaCuadernoTrabajoBitacoraClase,$comentariosBitacoraClase,$idClase){

	$sql = "UPDATE bitacoraClase SET fechaBitacoraClase='".$fechaClase."' , minutosBitacoraClase =".$minutosBitacoraClase." , pgsDesdeLibroAlumnoBitacoraClase=".$pgsDesdeLibroAlumnoBitacoraClase." , pgsHastaLibroAlumnoBitacoraClase=".$pgsHastaLibroAlumnoBitacoraClase." , pgsDesdeCuadernoTrabajoBitacoraClase=".$pgsDesdeCuadernoTrabajoBitacoraClase." , pgsHastaCuadernoTrabajoBitacoraClase=".$pgsHastaCuadernoTrabajoBitacoraClase." , comentariosBitacoraClase ='".$comentariosBitacoraClase."' WHERE idBitacoraClase = ".$idClase.";";
	//echo $sql;
	$res = mysql_query($sql);
	return true;
}


?>