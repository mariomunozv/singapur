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

$programados="[";
$trabajados ="[";
$destacados ="[";
$debiles ="[";
foreach ($_POST as $key => $val) {
	if(substr($key, 0,14)=="numeroCapitulo"){
		$programados.=$val.",";
	}
	if(substr($key, 0,6)=="taller"){
		$trabajados.=$val.",";
	}
	if(substr($key, 0,9)=="destacado"){
		$destacados.=$val.",";
	}
	if(substr($key, 0,5)=="debil"){
		$debiles.=$val.",";
	}
}
$programados=substr($programados,0,strlen($programados)-1)."]";
$trabajados=substr($trabajados,0,strlen($trabajados)-1)."]";
$destacados=substr($destacados,0,strlen($destacados)-1)."]";
$debiles=substr($debiles,0,strlen($debiles)-1)."]";
$_POST["programados"] = $programados;
$_POST["trabajados"] = $trabajados;
$_POST["destacados"] = $destacados;
$_POST["debiles"] = $debiles;
$_POST["idInformeSesion"]=$datos["idInformeSesion"];
$detalle = getDetalleSesion($_POST["idInformeSesion"]);
if(!$detalle){
	newDetalleSesion($_POST);
}else{
	updateDetalleSesion($_POST);
}

$detalle = getDetalleSesion($_POST["idInformeSesion"]);

print_r($_POST);


//header('Location: ./ingresoAsistenciaSesion.php');

?>

