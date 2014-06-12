<?php 

/* Devuelve el idPerfil de un usuario */	
function getIdPerfilUsuario($idUsuario){
	$sql ="SELECT * FROM `detalleUsuarioProyectoPerfil` WHERE `idUsuario` = '$idUsuario'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
   	return ($row["idPerfil"]);
}



?>