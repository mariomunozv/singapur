<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();
$idTema = $_REQUEST["idForo"];

?>

    <input type="hidden" name="idTema" class="campos" id="idTema" value="<?php echo @$idTema; ?>">
    Contenido<br />
    <textarea name="contenidoMensajeTema" cols="65" rows="8" id="contenidoMensajeTema" class="campos"></textarea><br />
    <?php
	boton("Enviar","enviarMsj()");
	?>

	