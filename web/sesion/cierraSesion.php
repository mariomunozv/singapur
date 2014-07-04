<?php 
include "../inc/funciones.php"; 
	alerta("Ud. a cerrado su sesión. Gracias por Visitarnos!.");
	session_start();
	session_destroy();
dirigirse_a("../index.php");

?>