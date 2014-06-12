<?php

require("inc/config.php");
include "../inc/_tareaMatematica.php";



/* Inserta */
if ($_REQUEST["modo"] == "nuevo"){
	
	$idCampo = $_REQUEST['idCampo'];
	if ($_REQUEST['idCampo'] == "" ){
		$idCampo = "NULL";
	};
	$nombreTareaMatematica = $_REQUEST['nombreTareaMatematica'];

	setTareaMatematica($idCampo, $nombreTareaMatematica);
}


/* Actualizar */
if ($_REQUEST["modo"] == "editar"){
	

	
}




?>