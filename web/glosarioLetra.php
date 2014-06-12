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

$letra = $_GET["letra"];
$glosario = getGlosarioLetra($letra);


foreach ($glosario as $i => $value) {
    echo "<b>".$value["nombrePalabra"]."</b><br>";
	echo $value["definicionPalabra"]."<br><br>";
}
?>
</div>