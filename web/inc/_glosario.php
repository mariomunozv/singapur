<?php 

function getGlosarioCurso($idCurso){
	$sql = "SELECT * FROM `glosario` g join palabra p 
		on g.idPalabra = p.idPalabra 
		where g.idCursoCapacitacion = '$idCurso' 
		ORDER BY p.nombrePalabra";
	$ident = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($ident)) {
		$palabrasGlosario[$i] = array(
			"idPalabra" => $row["idPalabra"],
			"nombrePalabra" => $row["nombrePalabra"],
			"definicionPalabra" => $row["definicionPalabra"]
			);	
	$i++;
	}
	if ($i == 0){
		$palabrasGlosario[$i] = array(
			"idPalabra" => 0,
			"nombrePalabra" => "No existen palabras en esta categoría.",
			"definicionPalabra" => ""
			);	
	} 
	return ($palabrasGlosario);
}


function getGlosarioCursoAAA($idCurso){
	$sql = "SELECT * FROM `glosario` g join palabra p on g.idPalabra = p.idPalabra where g.idCursoCapacitacion = '$idCurso'";
	$ident = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($ident)) {
			$palabrasGlosario[$i] = array(
	
			"idPalabra" => $row["idPalabra"],
			"nombrePalabra" => $row["nombrePalabra"],
			"definicionPalabra" => $row["definicionPalabra"]
			);	
		$i++;
		}
	if ($i == 0){
		$palabrasGlosario[$i] = array(
			"idPalabra" => 0,
			"nombrePalabra" => "No existen palabras en esta categoría.",
			"definicionPalabra" => ""
			);	
	} 
	return ($palabrasGlosario);
	
}



?>