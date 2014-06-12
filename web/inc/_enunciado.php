<?php

function crearEnunciado($textoEnunciado,$respuestaCorrectaEnunciado,$esAbiertaEnunciado, $tipoInputEnunciado)
{
	$sql = "INSERT INTO `enunciado` (`textoEnunciado`, `respuestaCorrectaEnunciado`, `esAbiertaEnunciado`, tipoInputEnunciado)
							VALUES ('$textoEnunciado', '$respuestaCorrectaEnunciado', $esAbiertaEnunciado, '$tipoInputEnunciado');";
	
	//echo $sql;
	$res = mysql_query($sql);
	return $res;
}


/*** Método que lista los enuciados segun la condición que recibe
$condicion int 
1 = enunciados no relacionados
2 = enunciados relacionados
***/
function getEnunciados($condicion){
	if($condicion == 1)
	{
		$sql = "SELECT * FROM enunciado WHERE idEnunciado NOT IN (SELECT idEnunciado FROM detalleSeccionEnunciado) order by (enunciado.idEnunciado) desc";
	}
	else if ($condicion == 2)
	{
		$sql = "SELECT * FROM enunciado WHERE idEnunciado IN (SELECT idEnunciado FROM detalleSeccionEnunciado) order by (enunciado.idEnunciado) desc";
	}
	else 
	{
		$sql = "SELECT * FROM enunciado order by idEnunciado DESC";
	}
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$enunciado[$i] = array(
				"idEnunciado" => $row["idEnunciado"],
				"textoEnunciado" => $row["textoEnunciado"],
				"respuestaCorrectaEnunciado" => $row["respuestaCorrectaEnunciado"],
				"esAbiertaEnunciado" => $row["esAbiertaEnunciado"]);
				$i++;
	}
	return ($enunciado);
}	

/** Trae los enunciados cerrados "no asociados" de un formulario en particular 
reciboe $idFormulario = Al que se le desea poner alternativas
**/
function getEnunciadosCerrados($idFormulario){

		$sql = "SELECT * FROM enunciado WHERE esAbiertaEnunciado <> 1 AND idEnunciado IN (";
		$sql .= "SELECT idEnunciado FROM detalleSeccionEnunciado WHERE idSeccionFormulario IN (";
		$sql .= "SELECT idSeccionFormulario FROM seccionFormulario WHERE idFormulario = $idFormulario))";
		$sql .= "AND idEnunciado NOT IN(select idEnunciado FROM alternativa)";	
		//echo $sql;
		$res = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_array($res))
		{
		$enunciado[$i] = array(
				"idEnunciado" => $row["idEnunciado"],
				"textoEnunciado" => $row["textoEnunciado"],
				"respuestaCorrectaEnunciado" => $row["respuestaCorrectaEnunciado"],
				"esAbiertaEnunciado" => $row["esAbiertaEnunciado"]);
				$i++;
	}
	return ($enunciado);
}	


?>