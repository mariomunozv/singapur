<?php 

function getNombreDirectivoPorRut($rutProfe){
	$sql = "SELECT * FROM `directivo` where rutDirectivo = '".$rutProfe."'";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombreDirectivo"]." ".$row["apellidoPaternoDirectivo"]." ".$row["apellidoMaternoDirectivo"];

}

function getNombreDirectivo($rutDirectivo){
	$sql = "SELECT * FROM profesor WHERE rutDirectivo ="." '$Directivo'";
	$res = mysql_query($sql);
    $row = mysql_fetch_array($res);
	$nombreProfesor = $row["nombreDirectivo"]." ".$row["apellidoPaternoDirectivo"]." ".$row["apellidoMaternoDirectivo"];
	return ($nombreDirectivo);
}


function getApellidosNombrePorRutDirectivo($rutDirectivo){
	$sql = "SELECT * FROM `directivo` where rutDirectivo = '".$rutDirectivo."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["apellidoPaternoDirectivo"]." ".$row["apellidoMaternoDirectivo"]." ".$row["nombreDirectivo"];

}


function getDatosDirectivo($idUsuario){
		$sql = "SELECT * FROM directivo directivo join usuario usuario on usuario.rutDirectivo = directivo.rutDirectivo WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$datosDirectivo = array(
			"rutDirectivo" => $row["rutDirectivo"],
			"loginUsuario" => $row["loginUsuario"],
			"rbdColegio" => $row["rbdColegio"],
			"passwordUsuario" => $row["passwordUsuario"],
			"nombreDirectivo" => $row["nombreDirectivo"],
			"apellidoPaternoDirectivo" => $row["apellidoPaternoDirectivo"],
			"apellidoMaternoDirectivo" => $row["apellidoMaternoDirectivo"],
			"sexoDirectivo" => $row["sexoAdministrativo"],
			"fechaNacimientoDirectivo" => @$row["fechaNacimiento"],
			"telefonoDirectivo" => $row["telefonoDirectivo"],
			"emailDirectivo" => $row["emailDirectivo"],
			"anosExperienciaDirectivo" => @$row["anosExperienciaDirectivo"],
			"asignaturaACargoDirectivo" => @$row["asignaturaACargoDirectivo"],
			"coordinadorEnlaceDirectivo" => @$row["coordinadorEnlaceDirectivo"],
			"imagenUsuario" => $row["imagenUsuario"],
			"acercaDeUsuario" => $row["acercaDeUsuario"],
			"interesesUsuario" => $row["interesesUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]
		);
		return ($datosDirectivo);
}	


function actualizaDatosDirectivo($rutDirectivo,$nombreDirectivo,$apellidoPaternoDirectivo,$apellidoMaternoDirectivo,
								$sexoDirectivo,$fechaNacimientoDirectivo,$telefonoDirectivo,$emailDirectivo ){
	$sql_udateProfe="UPDATE directivo SET nombreDirectivo = '$nombreDirectivo', 
		apellidoPaternoDirectivo = '$apellidoPaternoDirectivo', 
		apellidoMaternoDirectivo = '$apellidoMaternoDirectivo', 
		sexoAdministrativo = '$sexoDirectivo', 
		fechaNacimiento = '$fechaNacimientoDirectivo', 
		telefonoDirectivo = '$telefonoDirectivo', 
		emailDirectivo = '$emailDirectivo'
		
		WHERE rutDirectivo  =  '$rutDirectivo';";
	//echo $sql_udateProfe;
	$result = mysql_query($sql_udateProfe);
	return $result;
}

?>