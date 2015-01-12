<?php
require("inc/incluidos.php");
require("inc/_visitaEscuela.php");
//validacion de datos

if(crearVisitaEscuela($_POST) == 8){
	header("Location: llenarVisitaEscuela.php");
}else{
	header("Location: llenarVisitaEscuela.php?er=1");
}

?>

