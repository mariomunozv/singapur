<?php 
function getDatosColegio($rbdColegio){
	$sql = "SELECT * FROM colegio a left join comuna  b on a.idComuna = b.idComuna WHERE rbdColegio = ".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosColegio = array( "rbdColegio" => $row["rbdColegio"],
					  "nombreColegio" => $row["nombreColegio"],
					  "emailColegio" => $row["emailColegio"],
					  "idComuna" => $row["idComuna"],
					  "nombreComuna" => $row["nombreComuna"],
					  "direccionColegio" => $row["direccionColegio"],
					  "telefonoColegio" => $row["telefonoColegio"],
					  "paginaWebColegio" => $row["paginaWebColegio"],
					 "logoColegio" => $row["logoColegio"] );	
	return($datosColegio);
} 

function getRbdUsuario($idUsuario){
	$sql = "SELECT rbdColegio 
		FROM profesor
		WHERE rutProfesor in (
		SELECT rutProfesor
		FROM usuario
		WHERE idUsuario = ".$idUsuario.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return $row[0];
}


?>