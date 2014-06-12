<?php 

function getDatosActividad($idActividad){
	$sql ="SELECT * FROM actividad where idActividad = ".$idActividad;
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosActividad=array(
		"idActividad"=> $row["idActividad"],
		"tituloActividad" => $row["tituloActividad"],
		"estadoActividad" => $row["estadoActividad"],
		"bienvenidaActividad" => $row["bienvenidaActividad"],
		"linkActividad" => $row["linkActividad"],
		"limiteVecesActividad" => $row["limiteVecesActividad"]
		);
	return($datosActividad);
}
?>