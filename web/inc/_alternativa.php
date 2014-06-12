<?php


function crearAlternativa($idEnunciado,$idEtiqueta)
{
	$sql = "INSERT INTO `alternativa` ( `idEnunciado` , `idEtiqueta`)
							VALUES ( $idEnunciado, '$idEtiqueta');";
	//echo $sql;						
	$res = mysql_query($sql);
	return $res;
}


function getEtiqueta($idEtiqueta){

	$sql = "SELECT * FROM etiqueta where idEtiqueta = $idEtiqueta";
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
	$etiqueta = array(
			"idEtiqueta" => $row["idEtiqueta"],
			"nombreEtiqueta" => $row["nombreEtiqueta"],
			"esCorrecta " => $row["esCorrecta "]
			);
			
	}
	return ($etiqueta);
		
	
}


?>
