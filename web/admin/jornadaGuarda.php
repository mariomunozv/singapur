<?php 
session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
include "../inc/_jornada.php";

Conectarse_seg(); 


$nombreJornada = $_REQUEST["nombreJornada"];
$tipoJornada = $_REQUEST["tipoJornada"];
$moduloJornada = $_REQUEST["moduloJornada"];
$idsCursos = $_REQUEST["idsCursos"];
$descripcionJornada = $_REQUEST["descripcionJornada"];

if (isset($_REQUEST["visibleJornada"])){

	$visibleJornada = $_REQUEST["visibleJornada"];
}
else{
	$visibleJornada = 0;
}


foreach ($idsCursos as $idCursoCapacitacion){
	
	setJornada($nombreJornada, $tipoJornada,$idCursoCapacitacion, $descripcionJornada, $moduloJornada, $visibleJornada);
	
}

dirigirse_despues("jornada.php",3);

?>