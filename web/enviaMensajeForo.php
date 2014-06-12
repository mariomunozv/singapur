<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();

$idTema = $_REQUEST["idTema"];
$contenidoMensajeTema = $_REQUEST["contenidoMensajeTema"];


$resultado = guardaMensajeForo($idTema, $idUsuario, $contenidoMensajeTema);



if ($resultado == true)
{
	/* Registra Participación en un Foro */
	registraAcceso($idUsuario, 12, $idTema);
	info("Su Mensaje se ha enviado correctamente.");
	dirigirse_despues("temaDetalle.php?idForo=".$idTema."&flag=1",1000);

}
else{
	info("Ha ocurrido un error al enviar su mensaje.");
}
?>




