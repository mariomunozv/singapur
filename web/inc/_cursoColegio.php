<?php
function getCursosUsuarioBitacora($idUsuario){
	$sql = "SELECT c.* 
		FROM cursoColegio c, usuario u
		WHERE u.rutProfesor = c.rutProfesor
		AND anoCursoColegio = YEAR(NOW())
		AND u.idUsuario =".$idUsuario;
		//echo $sql;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$datosCursosUsuario[] = array(
			"idNivel"=> $row["idNivel"],
			"letraCursoColegio" => $row["letraCursoColegio"],
			"cursoColegio" => $row["idNivel"]."&deg; B&aacute;sico ".$row["letraCursoColegio"],
			"idCursoColegio" => $row["idNivel"].$row["letraCursoColegio"]
			);
	}
	if (count($datosCursosUsuario) > 0){
		return($datosCursosUsuario);
	}else{
		return(array());
	}
}
?>