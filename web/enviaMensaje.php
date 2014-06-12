<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];
Conectarse_seg();


$idPara = $_REQUEST["para_id"];
$asunto = $_REQUEST["asunto"];
$mensaje = $_REQUEST["mensaje2"];
$listaDest = @$_SESSION["listaDestinatarios"];

if (isset($_REQUEST["respuesta"])){
	$respuesta = $_REQUEST["respuesta"];
}
else{
	$respuesta = "NULL";
}

for ($i=0;$i<count($listaDest);$i++){

	$res = 0;
	$resultado = guardaMensaje($idUsuario, $listaDest[$i], $asunto, $mensaje, $respuesta);

	if ($resultado != 0 || $resultado != false){
		$res = 1;
		
		/* Se genera la notificacion para el usuario */
		$idUsuarioNotificado = $listaDest[$i];
		$nombreComentador = getNombreUsuario($idUsuario);
		
		// texto = "Juanito Perez" con link a verPerfil 
		$textoNotificacion = '<a href="verPerfil.php?idUsuario='.$idUsuario.'">'.$nombreComentador.'</a>';
		$textoNotificacion = $textoNotificacion.' te ha enviado un mensaje.';
		$linkNotificacion = 'mensaje.php?idMensaje='.$resultado.'&idNotificacion=@';
		$idImagenNotificacion = $idUsuario;
		
		setNotificacion($idUsuarioNotificado, 1, $textoNotificacion, $linkNotificacion, $idImagenNotificacion);
	}
	
}


if ($res == 1)
{
	/* Registra Envio de mensaje */
	registraAcceso($idUsuario, 5, 'NULL');
	
	info("Su(s) Mensaje(s) se ha(n) enviado correctamente.");
	
	dirigirse_despues("bandeja.php?mostrar=enviados",2000);
	
}
else{
	
	info("Ha ocurrido un error al enviar su mensaje.");
	}


?>




