<div id="glosario" align="justify">
<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];
Conectarse_seg(); 

/* Se registra el acceso al glosario */
	registraAcceso($idUsuario, 6, 'NULL'); 


$idPalabra = $_GET["idPalabra"];

$palabra = getPalabra($idPalabra);

    echo "<b>".$palabra["nombrePalabra"]."</b><br>";
	echo $palabra["definicionPalabra"]."<br><br>";

?>
</div>