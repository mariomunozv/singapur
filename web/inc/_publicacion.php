<?php 

function getRecursosJornada($idJornada,$idPerfil){
	$sql ="SELECT * FROM publicacion  WHERE idJornada = ".$idJornada." AND idPerfil >= ".$idPerfil." AND estadoPublicacion = 1";
	//   echo "<br>".$sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$recurso[$i] = getRecurso($row["idRecurso"]);
		$i++;	
	}
	if ($i == 0){
		$recurso[$i] = array();				
	} 
	
	return($recurso);
}



function getTiposRecursosJornada($idJornada,$idPerfil,$idTipo){
	$sql ="SELECT * FROM publicacion a left join recurso b on a.idRecurso = b.idRecurso  WHERE a.idJornada = ".$idJornada." AND a.idPerfil <= ".$idPerfil." AND a.estadoPublicacion = 1 AND b.idTipoRecurso  = ".$idTipo." ORDER BY a.ordenPublicacion,a.idRecurso  ASC";
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$recurso[$i] = getRecurso($row["idRecurso"]);
		$i++;	
	}
	if ($i == 0){
		$recurso = NULL;				
	} 
	
	return($recurso);
}


?>