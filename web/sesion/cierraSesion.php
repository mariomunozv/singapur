<?php 
include "../inc/funciones.php"; 
	alerta("Ud. a cerrado su sesi�n. Gracias por Visitarnos!.");
	session_start();
	session_destroy();
dirigirse_a("../index.php");

?>