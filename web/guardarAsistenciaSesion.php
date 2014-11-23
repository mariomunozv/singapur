<?php
require("inc/incluidos.php");
require("inc/_asistenciaSesion.php");
$datos = getDatosSesion($_POST["idCurso"], $_POST["numeroSesion"]);


if(!$datos){
	newInformeSesion($_POST);
}else{
	updateInformeSesion($_POST);
}
$datos = getDatosSesion($_POST["idCurso"], $_POST["numeroSesion"]);
foreach ($_POST as $key => $value) {
	if(substr($key,0,11)=="asistencia-"){
		newAsistenciaSesion($datos["idInformeSesion"],substr($key,11),$value);
	}
}
header('Location: ./ingresoAsistenciaSesion.php');

?>

