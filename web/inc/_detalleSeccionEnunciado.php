<?php


function crearSeccionEnunciado($idSeccionFormulario,$idEnunciado)
{
	$sql = "INSERT INTO `detalleSeccionEnunciado` ( `idSeccionFormulario` , `idEnunciado`)
							VALUES ( $idSeccionFormulario, '$idEnunciado');";
	$res = mysql_query($sql);
	return $res;
}

?>
